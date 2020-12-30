<?php
add_action('koelsch_header', 'koelsch_header');
function koelsch_header(){

  global $community_context;
  global $page_settings;

  $communityClass = $community_context->inCommunityContext() ? 'community': '';
  $headerClass = apply_filters('koelsch_header_class', $communityClass );
  $hc = $headerClass ? 'class="'.$headerClass.'"' : '';

  $wrapperClass = apply_filters('koelsch_main_wrapper_class', 'page-holder');
  $mainClass = apply_filters('koelsch_main_element_class', $communityClass);

  $mainID = apply_filters('koelsch_main_element_id','main');

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
             <?php
             $communityPageID = isset($page_settings[0]['find_community_page']) ? $page_settings[0]['find_community_page'] : false;?>
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
  $communityClass = $community_context->inCommunityContext() ? ' community': '';
  if ($imageArr['image_url'] || $imageArr['video_url']){

    $style = $imageArr['image_url'] ? ' style="background-image: url('.$imageArr['image_url'].');"' : '';

    $p = get_post_meta(get_the_id(), 'featured_image_position', true);
    $pos = isset($p[0]) ? $p[0] : false;
    $mobilePos = $pos && isset($pos['mobile']) ? $pos['mobile'] : '';
    $tabletPos = $pos && isset($pos['tablet']) ? $pos['tablet'] : '';

    $mobileStyle = $mobilePos ? ' @media (max-width:480px){.visual-section{background-position-x:'.$mobilePos.'!important;}}' : '';
    $tabletStyle = $tabletPos ? ' @media (min-width:481px) and (max-width:768px){.visual-section{background-position-x:'.$tabletPos.'!important;}' : '';
    echo $mobileStyle || $tabletStyle ? '<style type="text/css" scoped>'.$mobileStyle.$tabletStyle.'</style>' : '';
    
    ob_start();?>
    <div class="visual-section bg-video-holder<?php echo $communityClass;?>"<?php echo $style;?>>
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

  $id = get_the_id();
  $headerCopy = get_post_meta($id, 'header_copy', true);
  $h1 = get_post_meta($id, 'h1', true);
  $h1 = $h1 ? $h1 : get_the_title();
  $showH1 = apply_filters('koelsch_header_show_h1', true);

  ob_start();?>

  <?php if ($community_context->inCommunityContext()):?>
    <div class="holder community">
      <div class="community-block community-item">
        <div class="container">
          <div class="community-holder">
            <?php echo get_community_logo($community_context->communityID);?>
            <nav id="commNav" class="community-nav">
            <?php wp_nav_menu(array(
                    'menu'=> $community_context->menuID,
                    'menu_id'=>'',
                    'container'=>false,
                    'depth'=>2,
                    'walker'=> new Koelsch_Walker_Nav_Menu,
                    'fallback_cb'=>'__return_false'
                  ));?>
            </nav>
          </div>
        </div>
      </div>
      <?php echo $headerCopy ? '<div class="title-area header-copy"><p>'.$headerCopy.'</p></div>' : '';?>
    </div>
    <?php $hcClass = $headerCopy ? ' class="header-copy"' : '';
    echo $showH1 ? '<h1'.$hcClass.'>'.$h1.'</h1>' : '';?>

  <?php else:
    if ($showH1):?>
    <div class="title-area <?php echo $headerCopy ? 'header-copy' : 'align-center';?>">
      <?php echo $headerCopy ? '<p>'.$headerCopy.'</p>' : '';?>
      <h1><?php echo $h1;?></h1>
    </div>
    <?php endif;
  endif;?>

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
      <?php $lts = get_living_type_seal();
        if ($lts){
          echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/svg/'.$lts.'" alt="Koelsch senior living seal">';
        }
      ?>
    </div>
  </div>
  <?php echo ob_get_clean();
  }
}

add_action('koelsch_community_phone_button', 'koelsch_community_phone_button');
function koelsch_community_phone_button(){
  global $community_context;
  if ($community_context->inCommunityContext()){
    $phone = get_post_meta($community_context->communityID, 'phone', true);
    if ($phone){
      ob_start();?>
      <a class="phone-link community-item" href="tel:<?php echo sanitize_phone_number($phone);?>">
        <span><?php echo sanitize_phone_number($phone, true);?></span>
        <ion-icon name="call-outline"></ion-icon>
      </a>
      <?php echo ob_get_clean();
    }
  }
}

add_filter( 'body_class', function( $classes ) {

  global $community_context;
    return array_merge( $classes, array( $community_context->livingTypeID ) );
} );
?>
