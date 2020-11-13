<?php
/**
 * Koelsch front end layout & functions.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
 add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);
 function filter_wpseo_breadcrumb_separator($sep) {
   return '<ion-icon name="chevron-forward-sharp"></ion-icon>';
 };
 add_filter('wpseo_breadcrumb_links', 'wpseo_remove_home_breadcrumb');
 function wpseo_remove_home_breadcrumb($links){
	 if (trailingslashit($links[0]['url']) == trailingslashit(get_home_url())) { array_shift($links); }
	 return $links;
 }
 add_filter( 'get_the_archive_title', function ( $title ){
    if( is_tax() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});
function koelsch_breadcrumb(){
  global $post;
  ?><ol class="breadcrumbs"><?php
  // $resID = get_koelsch_setting('resources_page');
  // display_breadcrumb_link('Resources', get_the_permalink($resID));
  if (is_singular('resources')){
    $taxonomy = 'resource-category';
    $t = wp_get_post_terms($post->ID, $taxonomy);
    if ($t){
      $term = $t[0];
      $parents = get_ancestors($term->term_id, $taxonomy, 'taxonomy');
      if ($parents){
        array_reverse($parents);
        foreach($parents as $parent){
          $parentTerm = get_term($parent, $taxonomy);
          display_breadcrumb_link($parentTerm->name, get_term_link($parent));
        }
      }
      display_breadcrumb_link($term->name, get_term_link($term->term_id));
    }
    display_breadcrumb_link(get_the_title());
  }
  ?></ol><?php
}
function display_breadcrumb_link($name, $link = ''){
  $ret = '<li>';
  $ret .= $link ? '<a href="'.$link.'">' : '';
  $ret .= $name;
  $ret .= $link ? '</a>' : '';
  $ret .= '<ion-icon name="chevron-forward-sharp"></ion-icon>';
  $ret .= '</li>';
  echo $ret;
}
function display_resource_author(){
    $author = get_post_meta(get_the_id(), 'author_name', true);
    $authorTitle = get_post_meta(get_the_id(), 'author_title', true);
    $imgID = get_post_meta(get_the_id(), 'author_image_id', true);
    $imgArr = $imgID ? wp_get_attachment_image_src($imgID, 'author-2x') : false;
    $imgSrc = $imgArr ? $imgArr[0] : false;
  ?>
  <div class="author-box">
    <?php echo $imgSrc ? '<img class="author-img" src="'.$imgSrc.'" alt="'.$author.' image">' : '';?>
    <div class="holder">
      <?php
        echo $author ? '<strong class="name">'.$author.'</strong>' : '';
        echo $authorTitle ? '<em class="position">'.$authorTitle.'</em>' : '';
      ?>
    </div>
  </div>
  <?php
}

/**
 * Recursively get taxonomy and its children
 *
 * @param string $taxonomy
 * @param int $parent - parent term id
 * @return array
 */
function get_taxonomy_hierarchy( $taxonomy, $parent = 0) {

	// get all direct decendants of the $parent
	$terms = get_taxonomy_terms($taxonomy, $parent);

	// prepare a new array.  these are the children of $parent
	// we'll ultimately copy all the $terms into this new array, but only after they
	// find their own children
	$children = array();

	// go through all the direct decendants of $parent, and gather their children
	foreach ( $terms as $term ){
		// recurse to get the direct decendants of "this" term
		$term->children = get_taxonomy_hierarchy( $taxonomy, $term->term_id );

		// add the term to our new array
		$children[ $term->term_id ] = $term;
	}

	// send the results back to the caller
	return $children;
}

function get_taxonomy_terms($taxonomy, $parent, $xtra_args = array()){

  $args = array(
    'order_by'=>'name',
    'order'=>'ASC',
    'hide_empty'=>false,
  );
  if ($parent !== false){
    $args['parent'] = $parent;
  }
  if($args){
    $args = array_merge($args, $xtra_args);
  }
  $terms = get_terms($taxonomy,$args);
  return $terms;
}

function get_taxonomy_reverse_hierarchy($taxonomy, $term){
  $args = array(

  );
  $terms = get_taxonomy_terms($taxonomy, false, $args);
  if ($terms)
  var_dump($terms);
}


?>
