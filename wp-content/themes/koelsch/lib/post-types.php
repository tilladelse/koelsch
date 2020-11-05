<?php
/**
 * Koelsch custom post types.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

  //community CPT
  $c = new CPT(array(
    'post_type_name' => 'community',
    'singular' => 'Community',
    'plural' => 'Communities',
    'slug' => 'communities'
  ),
  array(
    'supports'=>array(
      'title','thumbnail'
    ),
    'public'=>false,
    'show_ui'=>true,
    // 'show_in_rest'=>true
  ));
  $c->menu_icon("dashicons-location");
  // $c->register_taxonomy(array(
  //   'taxonomy_name' => 'location',
  //   'singular' => 'Location',
  //   'plural' => 'Locations',
  //   'slug' => 'senior-living',
  // ),
  // array(
  //   // 'show_ui'=>false,
  //   // 'show_in_menu'=>false,
  //   'hierarchical'=>true,
  //   'show_in_nav_menus'=>false,
  // ));

  flush_rewrite_rules();

?>
