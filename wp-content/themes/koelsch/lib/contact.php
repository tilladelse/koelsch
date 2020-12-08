<?php
/**
 * Contains all logic & functionality regarding contact forms & methodology
 *
 */
 add_action('koelsch_contact_footer_link', 'display_contact_link');
 function display_contact_link(){
   global $page_settings;
   #TODO: setup contact functionality logic.
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

 add_filter( 'gform_notification_1', 'set_contact_form_email_to_address', 10, 3 );
 function set_contact_form_email_to_address( $notification, $form, $entry ) {

    //get notifiction - Admin Notification Only
    if ( $notification['name'] == '__dynamic_admin_notification' ) {
        //get email address value
        $to = $notification['to'];
        global $community_context;
        if ($community_context->inCommunityContext()){
          $comPostID = $community_context->communityID;
          $cto = $comPostID ? get_post_meta($comPostID, 'contact_email', true) : '';
          $to = $cto ? $cto : $to;
        }else{
          $settings = get_koelsch_setting('address');
          $to = $settings && isset($settings['email']) ? $settings['email'] : $to;
        }

        //set email address
        $notification['to'] = $to;
    }

    //return altered notification object
    return $notification;
 }

 //replace form button with our style
 add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
 function form_submit_button( $button, $form ) {
     return "<button class='btn btn-blue' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
 }

 add_action('koelsch_after_content', 'add_contact_prompt');
 function add_contact_prompt(){

  /**
   * TODO:
   * Logic
   * Show if community type is IL or AL (not MC)
   * If contact person info exists show direct contact info, if not, button will link to contact form.
   *
   * Contact opener button is hidden until contact panel is first displayed. Once contact prompt is dismissed, contact opener should be shown.
   * On click of opener button will show contact prompt if contact info for community is present. If not, it will link to the contact form.
   *
   */

   ob_start();?>
   <div class="contact-prompt">
     <div class="closer-wrap"><a href="#" class="closer"><ion-icon name="arrow-forward-outline"></ion-icon></a></div>
     <div class="prompt-wrapper">
       <div class="contact-card">
         <div class="image">
           <img src="http://localhost:8888/koelsch/wp-content/uploads/2020/11/jim-gaffigan.jpg">
         </div>
         <div class="name">
           Edith Gratner <span>Executive Director</span>
         </div>
       </div>
       <div class="contact-message">
         Hi I'm Edith, I'd love to talk with you about living at Park At Modesto!
       </div>
       <div class="contact-actions">
         <ion-icon name="mail-outline"></ion-icon><a class="btn-outline" href="#">Message Edith</a>
       </div>
     </div>
   </div>
   <div class="contact-opener">
     <ion-icon name="chatbox-outline"></ion-icon>
     <span>Contact</span>
   </div>
   <?php echo ob_get_clean();
 }
?>
