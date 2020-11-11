<?php
/**
 * Koelsch front end layout & functions.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
 add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);
 function filter_wpseo_breadcrumb_separator($sep) {
   return '<ion-icon name="chevron-forward-sharp"></ion-icon>';
 };
 add_filter('wpseo_breadcrumb_links', 'wpseo_remove_home_breadcrumb');
 function wpseo_remove_home_breadcrumb($links){
	 if (trailingslashit($links[0]['url']) == trailingslashit(get_home_url())) { array_shift($links); }
	 return $links;
 }
 add_filter( 'get_the_archive_title', function ( $title ){
    if( is_tax() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});
function koelsch_breadcrumb(){
  global $post;
  ?><ol class="breadcrumbs"><?php
  if (is_single()){
    $terms = wp_get_post_terms($post->ID, 'resource-category');
    var_dump($terms);?>
      <li>
        <a href="#">Independent Living</a>
        <ion-icon name="chevron-forward-sharp"></ion-icon>
      </li>
      <li>
        <a href="#">Financial</a>
        <ion-icon name="chevron-forward-sharp"></ion-icon>
      </li>
      <li>Can I Afford Senior Housing?
        <ion-icon name="chevron-forward-sharp"></ion-icon>
      </li>

  <?php }?>
  </ol><?php

}
 function koelsch_page_intro(){
   ob_start();?>
     <div class="visual-section bg-video-holder community" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/video-placeholder.jpg);">
       <video class="bg-video" width="640" height="360" loop autoplay muted playsinline>
         <source type="video/mp4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/Park-Snippet.mp4" />
       </video>
       <div class="holder">
         <div class="community-block community-item">
           <div class="container">
             <div class="community-holder">
               <div class="logo-holder">
                 <img class="community-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/the-park.png" alt="image description">
               </div>
               <nav class="community-nav">
                 <ul>
                   <li><a href="#">Independent Living</a></li>
                   <li><a href="#">Explore</a></li>
                   <li><a href="#">Activities & Adventures</a></li>
                   <li><a href="#">Resources</a></li>
                 </ul>
               </nav>
             </div>
           </div>
         </div>
         <!-- <div class="text-block align-center">
           <h1><?php echo get_the_title();?></h1>
         </div> -->
       </div>
       <a href="#" class="btn-circle anchor-link">
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


?>
