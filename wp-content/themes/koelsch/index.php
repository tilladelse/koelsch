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
      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="header">
          <h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
        </header>
        <div class="entry-content">
          <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
          <?php the_content(); ?>
          <div class="entry-links"><?php wp_link_pages(); ?></div>
        </div>
      </article>
      <?php endwhile; endif;
     }?>
  </div>
</main>
<?php get_footer();?>
