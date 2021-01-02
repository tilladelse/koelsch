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

//alter search query to resources only
function koelsch_query_filters($query) {
  if ($query->is_search && !is_admin() ) {
      $query->set('post_type',array('resources'));
      $query->set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
      $query->set('posts_per_page',9);
  }
  if ($query->is_tax && !is_admin() ){
    $query->set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
    $query->set('posts_per_page',8);
  }
  return $query;
}
add_filter('pre_get_posts','koelsch_query_filters');
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

function get_resource_excerpt($length = '50', $id = null){
  global $post;
  $id = $id == null ? $post->ID : $id;
  if (has_excerpt($id)){
    $excerpt = wp_trim_words(get_the_excerpt($id), $length);
  }else{
    $p = get_post($id);
    $excerpt = wp_trim_words($p->post_content, $length);
  }
  return $excerpt;
}

function display_resource_author($id = null){
  global $post;
  $id = $id == null ? $post->ID : $id;
  $author = get_post_meta($id, 'author_name', true);
  $authorTitle = get_post_meta($id, 'author_title', true);
  $imgID = get_post_meta($id, 'author_image_id', true);
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

function display_resource_search_form(){
  ?>
  <div class="search-form-block">
    <a class="search-opener" href="#">
      <ion-icon name="search"></ion-icon>
    </a>
    <?php display_koelsch_search_form();?>
  </div>
  <?php
}

function display_koelsch_search_form(){
  ?>
  <form action="<?php echo site_url();?>" class="search-form" method="get">
    <fieldset>
      <input type="search" name="s" id="s">
      <button type="submit" value="Search"><ion-icon name="search"></ion-icon></button>
    </fieldset>
  </form>
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

function sanitize_phone_number($ph, $format = false){
  $numbers_only = preg_replace("/[^0-9]/", "", $ph );
  if (!$format) return $numbers_only;
  $phone = preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~',
                '($1) $2-$3'." \n", $numbers_only);

  return $phone;
}

function get_community_logo($communityID){
  $communityTitle = get_the_title($communityID);
  $communityLogo = get_post_meta($communityID, 'logo', true);
  $chpID = get_post_meta($communityID, 'community_home_page_id', true);

  $return ='<a class="logo-holder" href="';
  $return .= $chpID ? get_the_permalink($chpID) : '';
  $return .='">';

  $return .= $communityLogo ? '<img class="community-logo" src="'.$communityLogo.'" alt="'.$communityTitle.'">' : '<p class="community-name">'.$communityTitle.'</p>';

  $return .='</a>';

  return $return;
}

// add_filter( 'wp_nav_menu_objects', 'koelsch_sub_menu', 10, 2 );
// // filter_hook function to react on sub_menu flag
// function koelsch_sub_menu( $sorted_menu_items, $args ) {
//   if ( isset( $args->sub_menu ) ) {
//     $sorted_menu_items = get_sub_menu_items($sorted_menu_items);
//     return $sorted_menu_items;
//   } else {
//     return $sorted_menu_items;
//   }
// }
function koelsch_get_page_sub_menu($menuID){
  // var_dump($menuID);
  $items = wp_get_nav_menu_items($menuID);
  // var_dump($items);
  _wp_menu_item_classes_by_context( $items );

  $rootID = $topParentID = $currentID = 0;
  $title = '';
  $curr = false;
  $currentTree = array();
  $itemsArr = array();
  if ($items){
    foreach($items as $item){
      $itemsArr[] = array(
        'id'=>$item->ID,
        'parent'=>$item->menu_item_parent,
        'is_current'=>$item->current,
        'is_ancestor'=>$item->current_item_ancestor,
        'type'=>$item->type,
        'item'=>$item
      );
      if ($item->current == true){
        $curr = true;
      }
    }
  }

  $items = array();

  $h = build_menu_hierarchy($itemsArr);

  if ($h){
    foreach($h as $k=>$menuItemArr){
      if($menuItemArr['is_ancestor'] || $menuItemArr['is_current']){
        $currentTree = $menuItemArr;
        break;
      }
    }
  }

  //get second level on down children
  // echo '<pre>';var_dump($currentTree);echo '</pre>';

  if ($curr){
    $level2 = false;
    $depth = get_menu_depth($h);
    // var_dump($depth);

    if (isset($currentTree['children'])){

      if ($depth == 3){
        foreach ($currentTree['children'] as $main){
          // var_dump($main['is_current']);
          if (($main['is_current'] || $main['is_ancestor'] )&& isset($currentTree['children'])){
            $level2 = $main;
            break;
          }
        }
        $level3 = ($level2 && isset($level2['children'])) ? $level2['children'] : false;

        $title = $level2 ? $level2['item']->title : '';

        if ($level3){
          foreach($level3 as $item){
            $items[] = $item['item'];
          }
        }

      }

      if ($depth == 2){
        $title = $currentTree['item']->title;
        foreach($currentTree['children'] as $item){
          $items[] = $item['item'];
        }
      }
    }

  }else{

    $menuID = get_main_nav_id();
    if (is_in_menu($menuID, get_the_id())){
      //if page is outside the community menu structure yet in the main menu, get the main menu and try again
      //current page is not in the menu
      $menuID = get_main_nav_id();
      // var_dump($menuID);
      koelsch_get_page_sub_menu($menuID);
    }else{
      //if page is not in the community or the main menu just stop already
      return;
    }

  }

  display_page_sub_menu($items, $title);

}
function get_menu_depth($menuArray){
  $max_depth = 1;
  foreach ($menuArray as $item) {
      if (isset($item['children'])) {
          $depth = get_menu_depth($item['children']) + 1;

          if ($depth > $max_depth) {
              $max_depth = $depth;
          }
      }
  }
  return $max_depth;
}
/**
 * Check if post is in a menu
 *
 * @param $menu menu name, id, or slug
 * @param $object_id int post object id of page
 * @return bool true if object is in menu
 */
function is_in_menu( $menu = null, $object_id = null ) {

    // get menu object
    $menu_object = wp_get_nav_menu_items( esc_attr( $menu ) );

    // stop if there isn't a menu
    if( ! $menu_object )
        return false;

    // get the object_id field out of the menu object
    $menu_items = wp_list_pluck( $menu_object, 'object_id' );

    // use the current post if object_id is not specified
    if( !$object_id ) {
        global $post;
        $object_id = get_queried_object_id();
    }

    // test if the specified page is in the menu or not. return true or false.
    return in_array( (int) $object_id, $menu_items );

}

function build_menu_hierarchy($elements, $parentID = 0){
  $branch = array();
  foreach ($elements as $element) {
        if ($element['parent'] == $parentID) {
            $children = build_menu_hierarchy($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

  return $branch;
}
function display_page_sub_menu($items, $title){
  if ($items){
    ob_start();?>
    <div class="sub-navigation" id="sub-nav">
      <h2 class="sub-title"><?php echo $title;?></h2>
      <nav class="sub-holder">
        <div class="sub-nav">
          <?php foreach ($items as $item){
            $classes = implode(' ',$item->classes);
            // var_dump($item);
            echo '<li class="'.$classes.'"><a href="'.$item->url.'">'.$item->title.'</a></li>';
          }?>
        </div>
      </nav>
    </div>
    <?php echo ob_get_clean();
  }
}
function get_main_nav_id(){
  $theme_locations = get_nav_menu_locations();
  $menu_obj = get_term( $theme_locations['main-nav'], 'nav_menu' );
  $menuID = $menu_obj->term_id;
  return $menuID;
}

function get_image_srcset($imageID, $imageSize, $retinaImageSize){

  if ($imageID){
    $url = wp_get_attachment_image_url($imageID, $imageSize);
    $ret_url = wp_get_attachment_image_url($imageID, $retinaImageSize);
    $srcSet = $url.', '.$ret_url.' 2x';
    $image_alt = get_post_meta($imageID, '_wp_attachment_image_alt', TRUE);
    $image = '<img src="'.$url.'" srcset="'.$srcSet.'" alt="'.$image_alt.'">';
    return $image;
  }
  return false;
}
function is_community_home_page(){
  global $post;
  if (get_post_meta($post->ID, 'community_post_id', true)){
    return true;
  }
  return false;
}
function get_living_type_seal(){
  global $community_context;
  $community_context->getCurrentLivingTypes();
  if ($community_context->livingType && isset($community_context->livingType['seal'])){
    return $community_context->livingType['seal'];
  }
  return false;
}

function retina_image($img, $img_size, $img_size_2x, $img_size_sm, $img_size_sm_2x, $id = ''){
	if($img){
		$image = $img ? wp_get_attachment_image_url($img, $img_size) : '';
		$image_2x = $img ? wp_get_attachment_image_url($img, $img_size_2x) : '';
		$image_sm = $img ? wp_get_attachment_image_url($img, $img_size_sm) : '';
		$image_sm_2x = $img ? wp_get_attachment_image_url($img, $img_size_sm_2x) : ''; ?>
		<picture>
			<source srcset="<?php echo $image_sm; ?>, <?php echo $image_sm_2x; ?> 2x" media="(max-width: 767px)">
			<source srcset="<?php echo $image; ?>, <?php echo $image_2x; ?> 2x">
			<img<?php echo $id ? ' id="'.$id.'"' : '';?> src="<?php echo $image; ?>" alt="image">
		</picture>
    <?php
	}
}

// function koelsch_get_community_sub_menu($menuID){
//   $items = wp_get_nav_menu_items($menuID);
//   _wp_menu_item_classes_by_context( $items );
//
//   $root_id = 0;
//   $title = '';
//
//   // find the current menu item
//   foreach ( $items as $menu_item ) {
//
//     if ( $menu_item->current ) {
//       // set the root id based on whether the current menu item has a parent or not
//       $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
//       break;
//     }
//   }
//
//   foreach ($items as $menu_item ) {
//     if($root_id == $menu_item->ID){
//       $title = $menu_item->title;
//       break;
//     }
//   }
//
//   $menu_item_parents = array();
//   foreach ( $items as $key => $item ) {
//
//     // init menu_item_parents
//     if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
//
//     if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
//       // part of sub-tree: keep!
//       $menu_item_parents[] = $item->ID;
//     } else if ( ! in_array( $item->ID, $menu_item_parents ) || $root_id == $item->ID) {
//       // not part of sub-tree: away with it!
//       unset( $items[$key] );
//     }
//
//   }
//
//   display_page_sub_menu($items, $title);
//
// }
?>
