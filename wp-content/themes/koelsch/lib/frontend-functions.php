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

function get_resource_excerpt($length = '50'){
  $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), $length);
  return $excerpt;
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
  $items = wp_get_nav_menu_items($menuID);
  _wp_menu_item_classes_by_context( $items );

  $rootID = $topParentID = $currentID = 0;
  $title = '';
  $currentTree = array();
// var_dump($items);
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
    }
  }

  $items = array();

  $h = build_menu_hierarchy($itemsArr);

  if ($h){
    foreach($h as $k=>$menuItemArr){
      if($menuItemArr['is_ancestor']){
        $currentTree = $menuItemArr;
        break;
      }
    }


  }

  //get second level on down children
  // echo '<pre>';var_dump($currentTree);echo '</pre>';
  $level2 = false;
  if (isset($currentTree['children'])){
    foreach ($currentTree['children'] as $main){
      // var_dump($main['is_current']);
      if (($main['is_current'] || $main['is_ancestor'] )&& isset($currentTree['children'])){
        $level2 = $main;
        break;
      }
    }
  }

  if (!$level2){

  }

  $level3 = ($level2 && isset($level2['children'])) ? $level2['children'] : false;

  $title = $level2 ? $level2['item']->title : '';
  if ($level3){
    foreach($level3 as $item){
      $items[] = $item['item'];
    }
  }

  display_page_sub_menu($items, $title);

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

function acf_load_floorplan_field_choices( $field ) {

    $floorplans = get_posts(array(
      'post_type'=>'floorplans',
      'posts_per_page'=>-1,
    ));
   if ($floorplans){
     $choices[0] = 'Choose One';
     foreach($floorplans as $floorplan){
       $choices[$floorplan->ID] = $floorplan->post_title;
     }
   }else{
     $choices = array('No Floor Plans Available');
   }

   $field['choices'] = $choices;

    // return the field
    return $field;

}

add_filter('acf/load_field/name=floorplan_id', 'acf_load_floorplan_field_choices');

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
