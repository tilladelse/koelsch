<?php
/**
 *
 * Resource Single Article
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
$taxonomy = 'resource-category';
?>
<div id="content">
  <div class="content-topbar single-bar">
    <div class="text-holder">
      <?php koelsch_breadcrumb();?>
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
  <article class="article">
    <header class="heading">
      <h1><?php the_title();?></h1>
      <?php
        if (has_excerpt()){
          echo '<p>'.get_the_excerpt().'</p>';
        }
        display_resource_author();
      ?>
      <div class="category-info">
        <?php
        $t = wp_get_post_terms($post->ID, $taxonomy);
        if ($t){
          foreach ($t as $term){
            echo '<span class="text">'.$term->name.'</span>';
          }
        }
        ?>
        <img class="icon-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-dark-sm.png" alt="Koelsch Since 1958">
      </div>
    </header>
    <?php if (has_post_thumbnail()):
      $featImgID = get_post_thumbnail_id();
      $featImgSrc = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-single') : false;
      $featImgSrcSm = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-single-sm') : false;
      $featImgSrc2X = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-single-2x') : false;
      $featImgSrcsetSm = $featImgSrcSm.', '.$featImgSrc.' 2x';
      $featImgSrcset = $featImgSrc.', '.$featImgSrc2X.' 2x';
      ?>
    <div class="img-box">
      <picture>
        <source srcset="<?php echo $featImgSrcsetSm;?>" media="(max-width: 767px)">
        <source srcset="<?php echo $featImgSrcset;?>">
        <img src="<?php echo $featImgSrc;?>" alt="<?php echo get_the_title();?> image">
      </picture>
    </div>
  <?php endif;
        the_content();
  ?>
  </article>
  <?php
    //get other articles 
  ?>
  <img class="divider center" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/divider.jpg" alt="divider">
  <section class="articles-wrapp">
    <h3 class="title">Related Articles</h3>
    <div class="row row-sm">
      <div class="col">
        <article class="card-horizontal">
          <div class="img-box">
            <img src="images/img-08.jpg" srcset="images/img-08@2x.jpg 2x" alt="image description">
          </div>
          <div class="text-block">
            <h4><a href="#">Article Title</a></h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a class="btn-more" href="#">Read</a>
          </div>
        </article>
      </div>
      <div class="col">
        <article class="card-horizontal">
          <div class="img-box">
            <img src="images/img-08.jpg" srcset="images/img-08@2x.jpg 2x" alt="image description">
          </div>
          <div class="text-block">
            <h4><a href="#">Article Title</a></h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a class="btn-more" href="#">Read</a>
          </div>
        </article>
      </div>
      <div class="col">
        <article class="card-horizontal">
          <div class="img-box">
            <img src="images/img-08.jpg" srcset="images/img-08@2x.jpg 2x" alt="image description">
          </div>
          <div class="text-block">
            <h4><a href="#">Article Title</a></h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a class="btn-more" href="#">Read</a>
          </div>
        </article>
      </div>
      <div class="col">
        <article class="card-horizontal">
          <div class="img-box">
            <img src="images/img-08.jpg" srcset="images/img-08@2x.jpg 2x" alt="image description">
          </div>
          <div class="text-block">
            <h4><a href="#">Article Title</a></h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a class="btn-more" href="#">Read</a>
          </div>
        </article>
      </div>
    </div>
  </section>
</div>
<?php get_template_part('template-parts/sidebar', 'resources');
