<?php
add_action('koelsch_header', 'koelsch_header');
function koelsch_header(){
  ob_start(); ?>
  <header id="header">
    <div class="container">
      <div class="holder">
         <strong class="logo">
           <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="Koelsch"></a>
         </strong>
         <nav class="menu-wrap">
           <div class="menu-holder">
             <a class="community-link main-item" href="#">Find a Community <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" alt="image description"></a>
             <ul id="nav">
               <li>
                 <a href="#">Living At Koelsch<ion-icon name="chevron-down-sharp"></ion-icon></a>
                 <ul class="drop">
                   <li class="active"><a href="#">Independent Living</a></li>
                   <li><a href="#">Assisted Living</a></li>
                   <li><a href="#">Memory Care</a></li>
                 </ul>
               </li>
               <li><a href="#">Resources<ion-icon name="chevron-down-sharp"></ion-icon></a></li>
               <li>
                 <a href="#">About<ion-icon name="chevron-down-sharp"></ion-icon></a>
                 <ul class="drop">
                   <li><a href="#">About Koelsch</a></li>
                   <li><a href="#">History</a></li>
                   <li><a href="#">Family Values</a></li>
                   <li><a href="#">Community Involvement</a></li>
                   <li><a href="#">Awards</a></li>
                 </ul>
               </li>
               <li><a href="#">Communities<ion-icon name="chevron-down-sharp"></ion-icon></a></li>
             </ul>
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
