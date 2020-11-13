<?php
/**
 *
 * Search Page
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
add_action('koelsch_before_content', 'koelsch_search_content_before');
add_action('koelsch_after_content', 'koelsch_search_content_after');
add_action('koelsch_no_posts', 'search_no_results');
function search_no_results(){
  ?><article class="article no-results">
    <heading class="heading">
      <p>We're sorry we could not find any resources that match your search.</p>
    </heading>
  </article><?php
}
function koelsch_search_content_before(){
  $searchTerm = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';
  ?>
  <div id="content">
    <div class="content-heading">
      <div class="text-holder">
        <h1>Resources <br>Search Results</h1>
        <img class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/divider.jpg" alt="divider">
        <p>Search our library of articles and find life-enriching content from a myriad of expert voices.</p>
      </div>
    </div>
    <div class="search-wrapp">
      <?php
        display_koelsch_search_form();
        if ($searchTerm){?>
        <div class="result-block">
          <p>Showing search results for...</p>
          <h3 class="search-title"><?php echo $searchTerm;?></h3>
        </div>
      <?php }?>
    </div>
    <?php ?>
    <div class="row search-row">
  <?php
}
function koelsch_search_content_after(){
    ?>
    </div>
    <nav class="navigation pagination align-center" role="navigation">
      <div class="nav-links">
        <a class="prev page-numbers disabled" href="#">
          <ion-icon name="chevron-back-sharp"></ion-icon>
        </a>
        <span class="page-numbers current">1</span>
        <a class="page-numbers" href="#">2</a>
        <a class="page-numbers" href="#">3</a>
        <a class="page-numbers" href="#">4</a>
        <a class="next page-numbers" href="#">
          <ion-icon name="chevron-forward-sharp"></ion-icon>
        </a>
      </div>
    </nav>
  </div>
  <?php get_template_part( 'template-parts/sidebar', 'resources' );
}
koelsch();
?>
