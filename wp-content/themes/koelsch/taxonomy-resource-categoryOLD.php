<?php
/**
 * Resource category template.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
 get_header();?>
 <main id="main">
   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
             <h1><?php the_title();?></h1>
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
   <?php endwhile; endif; ?>
 </main>
 <?php get_footer();?>
