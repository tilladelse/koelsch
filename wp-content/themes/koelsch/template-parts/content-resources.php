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
$t = wp_get_post_terms($post->ID, $taxonomy);
$term = $t ? $t[0] : false;
?>
<div class="main-holder">
<div id="content">
  <div class="content-topbar single-bar">
    <div class="text-holder">
      <?php koelsch_breadcrumb();?>
    </div>
    <?php display_resource_search_form();?>
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
        <?php echo $term ? '<span class="text">'.$term->name.'</span>' : '';?>
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
  if ($term){
    $related = get_posts(array(
      'post_type'=>'resources',
      'post__not_in'=>array(get_the_id()),
      'numberposts'=> 4,
      'tax_query'=>array(
        array(
          'taxonomy'=>$taxonomy,
          'field'=>'term_id',
          'terms'=>array($term->term_id),
        )
      )
    ));
    if ($related){
      ?>
      <img class="divider center" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/divider.jpg" alt="divider">
      <section class="articles-wrapp">
        <h3 class="title">Related Articles</h3>
        <div class="row row-sm">
          <?php
            foreach($related as $post){
              setup_postdata($post);
              get_template_part('template-parts/listing', 'resource-small');
            }
          ?>
        </div>
      </section>
    <?php
    }
  }
  ?>
</div>
<?php get_template_part('template-parts/sidebar', 'resources');?>
</div>
