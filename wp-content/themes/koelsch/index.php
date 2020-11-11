<?php
/**
 *
 * Koelsch
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
get_header();?>
<main id="main">

  <div class="main-holder">
    <?php if (is_search()){

    }else if (is_archive()){
      $taxonomy = get_query_var('taxonomy');
      get_template_part( 'template-parts/content', $taxonomy );
    }else{
      if ( have_posts() ) {
        while ( have_posts() ) {
          the_post();
          get_template_part( 'template-parts/content', get_post_type() );
        }
       }
     }?>
  </div>
</main>
<?php get_footer();?>
