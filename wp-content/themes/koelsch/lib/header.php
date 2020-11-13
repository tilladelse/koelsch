<?php
add_action('koelsch_header', 'koelsch_header');
function koelsch_header(){
  ob_start(); ?>
  <header id="header">
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
         <a class="phone-link community-item" href="tel:9162090778">
           <span>(916) 209-0778</span>
           <ion-icon name="call-outline"></ion-icon>
         </a>
       </div>
     </div>
   </header>
   <?php echo ob_get_clean();
}
?>
