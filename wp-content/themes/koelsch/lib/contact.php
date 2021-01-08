<?php
/**
 * Contains all logic & functionality regarding contact forms & methodology
 *
 */

 add_filter('gform_field_value_community_name', 'gform_set_community_name');
 function gform_set_community_name(){
   global $community_context;
   return $community_context->communityName;
 }
 
 add_filter('gform_field_value_community_email', 'gform_set_community_email');
 function gform_set_community_email(){

   global $community_context;
   //default to admin email
   $email = get_option('admin_email');
   if ($community_context->inCommunityContext()){
     $comEmail = get_post_meta($community_context->communityID, 'contact_email', true);
     $email = $comEmail ? $comEmail : $email;
   }else{
     $settings = get_koelsch_setting('address');
     $email = $settings && isset($settings[0]['email']) ? $settings[0]['email'] : $email;
   }

   return $email;
 }
 /**
  * Filters the next, previous and submit buttons.
  * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
  *
  * @param string $button Contains the <input> tag to be filtered.
  * @param object $form Contains all the properties of the current form.
  *
  * @return string The filtered button.
  */
 add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
 add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
 add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
 function input_to_button( $button, $form ) {
     $dom = new DOMDocument();
     $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
     $input = $dom->getElementsByTagName( 'input' )->item(0);
     $new_button = $dom->createElement( 'button' );
     $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
     $input->removeAttribute( 'value' );
     foreach( $input->attributes as $attribute ) {
         $new_button->setAttribute( $attribute->name, $attribute->value );
     }
     $input->parentNode->replaceChild( $new_button, $input );

     return $dom->saveHtml( $new_button );
 }

 add_action('koelsch_contact_footer_link', 'display_contact_link');
 function display_contact_link(){
   global $page_settings;
   $contactPageID = isset($page_settings[0]['contact_page']) ? $page_settings[0]['contact_page'] : false;
   $cpURL = $contactPageID ? get_permalink($contactPageID) : '#';
   ob_start();
   ?>
   <li>
     <ion-icon name="chatbox-outline"></ion-icon>
     <a href="<?php echo $cpURL;?>">Contact</a>
   </li>
   <?php echo ob_get_clean();
 }

 // add_filter( 'gform_notification_1', 'set_contact_form_email_to_address', 10, 3 );
 // function set_contact_form_email_to_address( $notification, $form, $entry ) {
 //
 //    //get notifiction - Admin Notification Only
 //    if ( $notification['name'] == '__dynamic_admin_notification' ) {
 //
 //        //get email address value
 //        $to = $notification['to'];
 //        global $community_context;
 //        if ($community_context->inCommunityContext()){
 //          $cto = $community_context->communityID ? get_post_meta($community_context->communityID, 'contact_email', true) : '';
 //          $to = $cto ? $cto : $to;
 //        }else{
 //          $settings = get_koelsch_setting('address');
 //          $to = $settings && isset($settings[0]['email']) ? $settings[0]['email'] : $to;
 //        }
 //        // $to = $community_context->inCommunityContext() ? 'true@testshk.com' : 'false@testshk.com';
 //
 //        //set email address
 //        $notification['to'] = $to;
 //    }
 //
 //    //return altered notification object
 //    return $notification;
 // }

 //replace form button with our style
 add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
 function form_submit_button( $button, $form ) {
     return "<button class='btn btn-blue' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
 }

 add_action('koelsch_after_content', 'add_contact_prompt');
 function add_contact_prompt(){
   global $community_context;
   global $page_settings;
   $contactPageID = $page_settings && isset($page_settings[0]['contact_page']) ? $page_settings[0]['contact_page'] : 0;
   //don't show on the contact page
   if (get_the_id() != $contactPageID){
     /**
      * TODO:
      * Logic
      * Show if community type is IL or AL (not MC)
      * Show on page after visitor has scrolled past #page_content div
      * If contact person info exists show direct contact info, if not, button will link to contact form.
      *
      * Contact opener button is hidden until contact panel is first displayed.
      * Once contact prompt is dismissed, contact opener should be shown.
      * On click of opener button will show contact prompt if contact info for community is present.
      * If not, it will link to the contact form.
      *
      */
      $context = 'page';
     $lt = $community_context->getCurrentLivingTypes();
     if (isset($lt['living_types']) && !in_array('MC', $lt['living_types'])){
       $fn = get_post_meta($community_context->communityID, 'contact_first_name', true);
       $ln = get_post_meta($community_context->communityID, 'contact_last_name', true);
       $title = get_post_meta($community_context->communityID, 'contact_title', true);
       $email = get_post_meta($community_context->communityID, 'contact_email', true);
       $imageID = get_post_meta($community_context->communityID, 'contact_image_id', true);
       $src1x = $imageID ? wp_get_attachment_image_url($imageID, 'contact-image') : '';
       $src2x = $imageID ? wp_get_attachment_image_url($imageID, 'contact-image-2x') : '';
       $imgSrc = $imageID ? '<div class="image"><img src="'.$src1x.'" srcset="'.$src1x.' 1x, '.$src2x.' 2x"></div>' : '';

       if ($fn && $ln && $email){
         $context = 'prompt';
         ob_start();?>
         <div class="contact-prompt">
           <div class="closer-wrap"><a href="#" class="closer"><ion-icon name="arrow-forward-outline"></ion-icon></a></div>
           <div class="prompt-wrapper<?php echo !$imgSrc ? ' no-image': '';?>">
             <?php if ($imgSrc):?>
             <div class="contact-card">
               <?php echo $imgSrc;?>
               <div class="name">
                 <?php echo $fn.' '.$ln;?> <span><?php echo $title;?></span>
               </div>
             </div>
           <?php endif;?>
             <div class="contact-message">
               Hi I'm <?php echo $fn;?>, I'd love to talk with you about living at <?php echo get_the_title($community_context->communityID);?>!
             </div>
             <?php if(!$imgSrc):?>
               <div class="name">
                 <?php echo $fn.' '.$ln;?> <span><?php echo $title;?></span>
               </div>
             <?php endif;?>
             <div class="contact-actions">
               <ion-icon name="mail-outline"></ion-icon>
               <a class="btn-outline email-cta" href="mailto:<?php echo $email;?>">Message <?php echo $fn;?></a>
               <a class="tour secondary-action schedule-tour-cta" href="<?php echo get_the_permalink($contactPageID);?>?r=tour">
                 <ion-icon name="walk-outline"></ion-icon> Request A Tour
               </a>
               <a class="brochure secondary-action get-brochure-cta" href="<?php echo get_the_permalink($contactPageID);?>?r=brochure">
                 <ion-icon name="book-outline"></ion-icon>Request A Brochure
               </a>
             </div>
           </div>
         </div>
         <?php echo ob_get_clean();
       }
     }
     // var_dump($page_settings);
     $contactPageURL = $contactPageID ? get_permalink($contactPageID) : '#';
     ?>
     <div class="contact-opener">
       <ion-icon name="chatbox-outline"></ion-icon>
       <a class="open-contact<?php echo $context == 'page' ? ' gen-contact-cta' : '';?>" data-context="<?php echo $context;?>" href="<?php echo $context == 'page' ? $contactPageURL : '#';?>">Contact</a>
     </div>
     <?php
   }

 }
?>
