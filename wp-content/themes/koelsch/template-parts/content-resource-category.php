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
<?php endif;?>
</div>
<?php get_template_part( 'template-parts/sidebar', 'resources' );?>
