<?php
add_action('koelsch_header', 'koelsch_header');
function koelsch_header(){

  global $community_context;

  $communityClass = $community_context ? 'community': '';
  $headerClass = apply_filters('koelsch_header_class', $communityClass );
  $hc = $headerClass ? 'class="'.$headerClass.'"' : '';

  $wrapperClass = apply_filters('koelsch_main_wrapper_class', 'page-holder');

  $mainID = apply_filters('koelsch_main_element_id','main');
  $mainClass = apply_filters('koelsch_main_element_class','');

  ob_start();
  ?>
  <header id="header"<?php echo $hc;?>>
    <div class="container">
      <div class="holder">
         <strong class="logo">
           <a href="<?php echo site_url();?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="Koelsch"></a>
         </strong>
         <nav class="menu-wrap">
           <div class="menu-holder">
             <?php $communityPageID = get_koelsch_setting('find_community_page');?>
             <a class="community-link main-item" href="<?php echo $communityPageID ? get_the_permalink($communityPageID) : '#';?>">Find a Community <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" alt="image description"></a>
             <?php wp_nav_menu(array(
               'theme_location'=>'main-nav',
               'menu_id'=>'nav',
               'container'=>false,
               'depth'=>2,
               'walker'=> new Koelsch_Walker_Nav_Menu,
             ));?>
             <span class="decor-logo">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-menu.png" alt="K 1958">
             </span>
           </div>
         </nav>
         <a class="nav-opener" href="#"><span></span></a>
         <?php do_action('koelsch_community_phone_button');?>
       </div>
     </div>
   </header>
   <main<?php echo $mainID ? ' id="'.$mainID.'"': '';?><?php echo $mainClass ? ' class="'.$mainClass.'"': '';?>>
     <div<?php echo $wrapperClass ? ' class="'.$wrapperClass.'"': '';?>>
      <div class="community-menu-wrapper">
         <?php //if is single don't grab featured image
               //else grab featured image or video. video has priority
               //if featured image or video should not show,
               if (is_single() || is_archive()){
                 do_action('koelsch_community_menu');
               }else{
                 $postID = get_the_id();
                 $imageArr = array(
                   'image_url'=>'',
                   'video_url'=> get_post_meta($postID, 'featured_video', true)
                 );

                 if (!$imageArr['video_url'] && has_post_thumbnail()){
                   $featImgSrc = get_the_post_thumbnail_url($postID, 'page-header');
                   $imageArr['image_url'] = $featImgSrc;
                 }
                 do_action('koelsch_before_community_menu', $imageArr);
                 do_action('koelsch_community_menu');
                 do_action('koelsch_after_community_menu', $imageArr);
               }
          ?>
       </div>
   <?php echo ob_get_clean();
}

add_action('koelsch_before_community_menu', 'koelsch_before_community_menu',10);
function koelsch_before_community_menu($imageArr){
  global $community_context;
  $communityClass = $community_context ? ' community': '';
  if ($imageArr['image_url'] || $imageArr['video_url']){
    ob_start();?>
    <div class="visual-section bg-video-holder<?php echo $communityClass;?>"<?php echo $imageArr['image_url'] ? ' style="background-image: url('.$imageArr['image_url'].')"' : '';?>>
      <?php if ($imageArr['video_url']):?>
      <video class="bg-video" width="640" height="360" loop autoplay muted playsinline>
        <source type="video/mp4" src="<?php echo $imageArr['video_url']; ?>" />
      </video>
    <?php endif; echo ob_get_clean();
  }
}

add_action('koelsch_community_menu', 'koelsch_community_menu');
function koelsch_community_menu(){
  global $community_context;
  $community_context->getCommunityContext();
  ob_start();?>
  <div class="holder community">
    <?php if ($community_context):
      $communityTitle = get_the_title($community_context->communityID);
      $communityLogo = get_post_meta($community_context->communityID, 'logo', true);
      $chpID = get_post_meta($community_context->communityID, 'community_home_page_id', true);
      ?>
    <div class="community-block community-item">
      <div class="container">
        <div class="community-holder">
          <a class="logo-holder" href="<?php echo $chpID ? get_the_permalink($chpID) : '';?>">
            <?php
              if ($communityLogo){
                echo '<img class="community-logo" src="'.$communityLogo.'" alt="'.$communityTitle.'">';
              }else{
                echo '<p class="community-name">'.$communityTitle.'</p>';
              }
            ?>
          </a>
          <nav class="community-nav">
          <?php
            if (wp_get_nav_menu_object($community_context->menuID)){
              wp_nav_menu(array(
                'menu'=> $community_context->menuID,
                'menu_id'=>'',
                'container'=>false,
                'depth'=>1,
                'walker'=> new Koelsch_Community_Walker_Nav_Menu,
                'fallback_cb'=>'__return_false'
              ));
            }?>
          </nav>
        </div>
      </div>
    </div>
  <?php else:?>
    <div class="text-block align-center">
      <h1><?php echo get_the_title();?></h1>
    </div>
  <?php endif;?>
  </div>
  <?php echo ob_get_clean();
}

add_action('koelsch_after_community_menu', 'koelsch_after_community_menu',10);
function koelsch_after_community_menu($imageArr){
  if ($imageArr['image_url'] || $imageArr['video_url']){
    ob_start();?>
    <a href="#page_content" class="btn-circle anchor-link">
      <ion-icon name="arrow-down"></ion-icon>
      <svg class="top">
        <circle class="circle-top" cx="33" cy="33" r="31" stroke-width="1" fill-opacity="0">
      </svg>
      <svg>
        <circle class="circle-bottom" cx="33" cy="33" r="31" stroke-width="1" fill-opacity="0">
      </svg>
    </a>
    <div class="logo-box">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/independent-logo.png" alt="image description">
    </div>
  </div>
  <?php echo ob_get_clean();
  }
}

add_action('koelsch_community_phone_button', 'koelsch_community_phone_button');
function koelsch_community_phone_button(){
  ob_start();?>
  <a class="phone-link community-item" href="tel:9162090778">
    <span>(916) 209-0778</span>
    <ion-icon name="call-outline"></ion-icon>
  </a>
  <?php echo ob_get_clean();
}
?>
