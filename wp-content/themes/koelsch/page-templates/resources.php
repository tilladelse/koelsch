<?php
/**
 *
 * Template Name: Resources
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

// add_filter('koelsch_main_wrapper_class', function($attr){return 'main-holder';});
add_action('koelsch_before_loop', 'koelsch_resource_content');
function koelsch_resource_content(){ ?>
  <div class="main-holder">
    <div id="content">
      <div class="content-heading">
        <div class="text-holder">
          <h1>Resources <br>to enrich.</h1>
          <img class="divider" src="<?php echo get_template_directory_uri() ?>/images/divider.jpg" alt="divider">
          <p>Search our library of articles and find life-enriching content from a myriad of expert voices.</p>
        </div>
      </div>
      <?php display_resource_search_form();
}
add_action('koelsch_after_loop', 'koelsch_resource_content_close');
function koelsch_resource_content_close(){?>
  </div>
<?php get_template_part( 'template-parts/sidebar', 'resources' );?>
</div>
<?php
}
koelsch();
