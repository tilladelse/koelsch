<?php
/**
 * Koelsch custom post types.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
  //remove post
  // Remove side menu
  add_action( 'admin_menu', 'remove_default_post_type' );

  function remove_default_post_type() {
      remove_menu_page( 'edit.php' );
  }

  // Remove +New post in top Admin Menu Bar
  add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

  function remove_default_post_type_menu_bar( $wp_admin_bar ) {
      $wp_admin_bar->remove_node( 'new-post' );
  }

  // Remove Quick Draft Dashboard Widget
  add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

  function remove_draft_widget(){
      remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  }

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
  //
  //Resources CPT
  $r = new CPT(array(
    'post_type_name' => 'resources',
    'singular' => 'Resource',
    'plural' => 'Resources',
    'slug' => 'resource'
  ),
  array(
    'supports'=>array(
      'title','thumbnail','editor','excerpt'
    ),
    'public'=>true,
    'show_in_rest'=>true,
    'has_archive'=>true,
  ));
  $r->menu_icon("dashicons-media-text");

  $r->register_taxonomy(array(
    'taxonomy_name' => 'resource-category',
    'singular' => 'Resource Category',
    'plural' => 'Resource Categories',
    'slug' => 'resource-content',
  ),
  array(
    'show_in_rest'=>true,
    // 'show_ui'=>false,
    // 'show_in_menu'=>false,
    'hierarchical'=>true,
    // 'show_in_nav_menus'=>false,
  ));
  flush_rewrite_rules();

  add_action('init', 'koelsch_add_excerpt');
  function koelsch_add_excerpt(){
     add_post_type_support( 'resources', 'excerpt' );
  }

?>
