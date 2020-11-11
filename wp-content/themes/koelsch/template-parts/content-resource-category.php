<?php
/**
 *
 * Resource Category Archive
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

$archive_title    = get_the_archive_title();
$archive_subtitle = get_the_archive_description();
global $wp_query;
?>
<div id="content">
  <div class="content-topbar">
    <div class="text-holder">
      <?php if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
      }?>
      <h1><?php echo $archive_title;?></h1>
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
  <?php if (have_posts()):?>
  <div class="row category-row">
    <?php while (have_posts()): the_post();?>
    <div class="col">
      <article class="card">
        <?php $featImgID = get_post_thumbnail_id();
        $featImgSrc = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-listing') : false;
        $featImgSrc2X = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-listing-2x') : false;
        $featImgSrcset = $featImgSrc ? $featImgSrc.', '.$featImgSrc2X.' 2x' : '';?>
        <a href="<?php echo get_the_permalink();?>" class="card-img">
          <?php if ($featImgID):?>
            <img src="<?php echo $featImgSrc;?>" srcset="<?php echo $featImgSrcset; ?>" alt="<?php the_title();?> listing image">
          <?php endif;?>
        </a>
        <h4><a href="<?php echo get_the_permalink();?>"><?php the_title();?></a></h4>
        <?php $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), '50');?>
        <p><?php echo $excerpt;?> <a class="btn-more" href="<?php echo get_the_permalink();?>">Read</a></p>
        <?php display_resource_author();?>
      </article>
    </div>
  <?php endwhile;?>
  </div>
<?php endif;?>
</div>
<?php get_template_part( 'template-parts/sidebar', 'resources' );?>
