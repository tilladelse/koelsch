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
<div class="main-holder">
<div id="content">
  <div class="content-topbar">
    <div class="text-holder">
      <?php if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="breadcrumbs" id="breadcrumbs">','</div>' );
      }?>
      <h1><?php echo $archive_title;?></h1>
    </div>
    <?php display_resource_search_form();?>
  </div>
  <?php if (have_posts()):?>
  <div class="row category-row">
    <?php
    while (have_posts()){
      the_post();
      get_template_part('template-parts/listing', 'resource');
    }
    ?>
  </div>
  <?php global $wp_query;
  $big = 99999;?>
  <nav class="navigation pagination align-center" role="navigation">
    <div class="nav-links">
      <?php
        echo paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total' => $wp_query->max_num_pages,
          'prev_next'    => true,
          'prev_text' => '<ion-icon name="chevron-back-sharp"></ion-icon>',
          'next_text' => ' <ion-icon name="chevron-forward-sharp"></ion-icon>'
      ) );?>
    </div>
  </nav>
<?php endif;?>
</div>
<?php get_template_part( 'template-parts/sidebar', 'resources' );?>
</div>
