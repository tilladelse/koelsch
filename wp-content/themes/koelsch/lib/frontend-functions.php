<?php
/**
 * Koelsch front end layout & functions.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */



 function koelsch_header_markup_open(){
   echo '<div class="container"><div class="holder">';
 }
 function koelsch_header_markup_close(){
   echo '</div></div>';
 }
 function koelsch_do_header(){
   //genesis_markup( array('html5'   => '<main %s>','context' => 'site-main') );
   ob_start(); ?>
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
      <?php echo ob_get_clean();
    //  genesis_markup( array('close'   => '</main>','context' => 'site-main') );
 }

 function koelsch_footer_markup_open(){
   echo '<div class="container">';
 }
 function koelsch_footer_markup_close(){
   echo '</div>';
 }
 function koelsch_do_footer(){
   ob_start();?>
       <div class="footer-top">
         <div class="flex-row">
           <div class="col col-26">
             <div class="info-block">
               <img class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/divider.jpg" alt="image description">
               <div class="text-block main-item">
                 <p>We’re ladies and gentlemen serving ladies and gentlemen.</p>
               </div>
               <div class="logo-block community-item">
                 <a href="#">
                   <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/the-park.png" alt="The Park at laguna springs">
                 </a>
               </div>
             </div>
           </div>
           <div class="col col-50 col-community">
             <a class="community-link" href="#">Find a Community <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" alt="image description"></a>
           </div>
           <div class="col col-12 col-nav">
             <h4>Resources</h4>
             <ul class="second-menu main-item">
               <li><a href="#">All Resources</a></li>
               <li><a href="#">Cost Comparision</a></li>
               <li><a href="#">Dealing With Guilt</a></li>
               <li><a href="#">Impact Of Loneliness on Health</a></li>
             </ul>
             <ul class="second-menu community-item">
               <li><a href="#">IL Resources</a></li>
               <li><a href="#">Cost Comparision</a></li>
               <li><a href="#">IL Focused Resource Article</a></li>
             </ul>
           </div>
           <div class="col col-12 col-nav">
             <h4>Living Choices</h4>
             <ul class="second-menu main-item">
               <li><a href="#">Independent Living</a></li>
               <li><a href="#">Assisted Living</a></li>
               <li><a href="#">Memory Care</a></li>
             </ul>
             <ul class="second-menu community-item">
               <li><a href="#">Independent Living</a></li>
             </ul>
           </div>
         </div>
       </div>
       <div class="contacts-block">
         <div class="flex-row">
           <div class="col">
             <ul class="contact-list decor-line">
               <li>
                 <ion-icon name="location-outline"></ion-icon>
                 <address class="main-item">
                   Koelsch Communities<br>
                   111 Market Street NE #200<br>
                   Olympia, Wa 98502
                 </address>
                 <address class="community-item">
                   The Park At Laguna Springs<br>
                   Laguna Springs Drive<br>
                   Elk Grove, Ca 95757
                 </address>
               </li>
               <li>
                 <ion-icon name="call-outline"></ion-icon>
                 <a href="tel:3608671900">(360) 867-1900</a>
               </li>
             </ul>
           </div>
           <div class="col">
             <ul class="contact-list">
               <li>
                 <ion-icon name="people-circle"></ion-icon>
                 <a href="#">Careers At Koelsch</a>
               </li>
               <li>
                 <ion-icon name="chatbox-outline"></ion-icon>
                 <a href="#">Contact</a>
               </li>
             </ul>
           </div>
         </div>
       </div>
       <div class="footer-bottom">
         <div class="flex-row">
           <div class="col">
             <strong class="logo">
               <a href="#">
                 <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="K/Koelsch Communities">
               </a>
             </strong>
             <span class="copyright">&copy; Copyright 2021 <a href="#">Koelsch Communities</a>. All Rights Reserved.</span>
             <ul class="add-menu">
               <li><a href="#">Privacy Policy</a></li>
             </ul>
           </div>
           <div class="col">
             <span class="by">Website by <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tilla-delse.png" alt="Tilla delse"></a></span>
           </div>
         </div>
       </div>
   <?php echo ob_get_clean();
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

 function koelsch_resource_category_loop(){
   ob_start();
   ?>
   <div class="main-holder">
     <div id="content">
       <div class="content-topbar">
         <div class="text-holder">
           <ol class="breadcrumbs">
             <li>
               <a href="#">Independent Living</a>
               <ion-icon name="chevron-forward-sharp"></ion-icon>
             </li>
             <li>Financial
               <ion-icon name="chevron-forward-sharp"></ion-icon>
             </li>
           </ol>
           <h1>Financial</h1>
         </div>
         <div class="search-form-block">
           <a class="search-opener" href="#">
             <ion-icon name="search"></ion-icon>
           </a>
           <form action="#" class="search-form" method="get">
             <fieldset>
               <input type="search">
               <button type="submit" value="Search"><ion-icon name="search"></ion-icon></button>
             </fieldset>
           </form>
         </div>
       </div>
       <div class="row category-row">
         <div class="col">
           <article class="card">
             <div class="card-img">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02.jpg" srcset="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02@2x.jpg 2x" alt="image description">
             </div>
             <h4><a href="#">Can I afford Senior Housing?</a></h4>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. <a class="btn-more" href="#">Read</a></p>
             <div class="author-box">
               <img class="author-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/author-img.jpg" alt="image description">
               <div class="holder">
                 <strong class="name">Jim Standusky</strong>
                 <em class="position">VP Investing, Forbes</em>
               </div>
             </div>
           </article>
         </div>
         <div class="col">
           <article class="card">
             <div class="card-img">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02.jpg" srcset="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02@2x.jpg 2x" alt="image description">
             </div>
             <h4><a href="#">This Is The Title</a></h4>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. <a class="btn-more" href="#">Read</a></p>
             <div class="author-box">
               <img class="author-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/author-img.jpg" alt="image description">
               <div class="holder">
                 <strong class="name">Jim Standusky</strong>
                 <em class="position">VP Investing, Forbes</em>
               </div>
             </div>
           </article>
         </div>
         <div class="col">
           <article class="card">
             <div class="card-img">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02.jpg" srcset="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02@2x.jpg 2x" alt="image description">
             </div>
             <h4><a href="#">Article Title</a></h4>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra... <a class="btn-more" href="#">Read</a></p>
             <div class="author-box">
               <img class="author-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/author-img.jpg" alt="image description">
               <div class="holder">
                 <strong class="name">Jim Standusky</strong>
                 <em class="position">VP Investing, Forbes</em>
               </div>
             </div>
           </article>
         </div>
         <div class="col">
           <article class="card">
             <div class="card-img">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02.jpg" srcset="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02@2x.jpg 2x" alt="image description">
             </div>
             <h4><a href="#">Article Title</a></h4>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra... <a class="btn-more" href="#">Read</a></p>
             <div class="author-box">
               <img class="author-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/author-img.jpg" alt="image description">
               <div class="holder">
                 <strong class="name">Jim Standusky</strong>
                 <em class="position">VP Investing, Forbes</em>
               </div>
             </div>
           </article>
         </div>
         <div class="col">
           <article class="card">
             <div class="card-img">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02.jpg" srcset="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/img-02@2x.jpg 2x" alt="image description">
             </div>
             <h4><a href="#">Article Title</a></h4>
             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra... <a class="btn-more" href="#">Read</a></p>
             <div class="author-box">
               <img class="author-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/author-img.jpg" alt="image description">
               <div class="holder">
                 <strong class="name">Jim Standusky</strong>
                 <em class="position">VP Investing, Forbes</em>
               </div>
             </div>
           </article>
         </div>
       </div>
     </div>
     <aside id="sidebar">
       <div class="aside-topbar">
         <div id="search-container">
           <!-- Clone search block -->
         </div>
         <h3>Resources</h3>
         <a class="btn-back" href="#">
           <ion-icon name="arrow-back-sharp"></ion-icon>
           All Resources
         </a>
         <div id="breadcrumbs-container">
           <!-- Clone breadcrumbs -->
         </div>
       </div>
       <div class="aside-holder">
         <a class="aside-opener" href="#">Browse Resource Topics<ion-icon name="chevron-down"></ion-icon></a>
         <div class="aside-slide">
           <ul class="aside-menu">
             <li class="active">
               <span class="abbr">il</span>
               <a class="menu-opener" href="#">Financial
               <ion-icon name="chevron-down"></ion-icon></a>
               <div class="menu-slide">
                 <ul>
                   <li><a href="#">Calculators</a></li>
                   <li><a href="#">Tips & Advice</a></li>
                   <li><a href="#">Financial Health</a></li>
                 </ul>
               </div>
             </li>
           </ul>
         </div>
       </div>
     </aside>
   </div>
   <?php echo ob_get_clean();
 }


?>
