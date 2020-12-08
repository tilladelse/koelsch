<?php
/**
 * Koelsch.
 * This file adds functions to the Koelsch Theme.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

define('THEME_VERSION', '1.0.0');

 //include vendor files
 require_once __DIR__ . '/vendor/autoload.php';
 //include class files
 require_once __DIR__ . '/lib/classes/autoload.php';
 //Custom post type creation class
 require_once __DIR__ . '/lib/CPT.php';
 //consants
 require_once __DIR__ . '/lib/constants.php';
 //include custom metaboxes
 require_once __DIR__ . '/lib/admin-functions.php';
 //include custom metaboxes
 require_once __DIR__ . '/lib/metaboxes.php';
 //custom post types
 require_once __DIR__ . '/lib/post-types.php';
 //include custom metaboxes
 require_once __DIR__ . '/lib/frontend-functions.php';
 //contact core functionality
 require_once __DIR__ . '/lib/contact.php';
 //header hooks
 require_once __DIR__ . '/lib/header.php';
 //footer hooks
 require_once __DIR__ . '/lib/footer.php';
 //content core functionality
 require_once __DIR__ . '/lib/content.php';

 require_once __DIR__ . '/lib/blocks/init.php';

 require_once __DIR__ . '/lib/blocks/block-fields.php';

 //setup community context global
 global $community_context;
 $community_context = new Community_Context; 
 $community_context->getCommunityContext();

 add_action( 'after_setup_theme', 'koelsch_localization_setup' );
 /**
  * Sets localization (do not remove).
  *
  * @since 1.0.0
  */
 function koelsch_localization_setup() {

 	load_child_theme_textdomain( 'koelsch', get_stylesheet_directory() . '/languages' );

 }
 add_action('admin_enqueue_scripts', 'koelsch_enqueue_admin_scripts');
 function koelsch_enqueue_admin_scripts(){
   wp_enqueue_script(
     'koelsch' . '-admin-scripts',
     get_stylesheet_directory_uri() . '/assets/js/admin.min.js',
     [],
     THEME_VERSION
   );
 }

 add_action( 'wp_enqueue_scripts', 'koelsch_enqueue_scripts_styles' );
 /**
  * Enqueues scripts and styles.
  *
  * @since 1.0.0
  */
 function koelsch_enqueue_scripts_styles() {
  wp_enqueue_script('jquery');
	wp_enqueue_script(
		'koelsch-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.min.js',
		[],
		THEME_VERSION
	);
  wp_localize_script('koelsch-theme', 'koelsch', array(
    'ajaxurl'=>admin_url('admin-ajax.php')
  ));

  wp_enqueue_script('turf','https://unpkg.com/@turf/turf/turf.min.js',[],THEME_VERSION);
  wp_enqueue_script('mapbox','https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js',[],THEME_VERSION);
  wp_enqueue_script('ion-icons','https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js',[],THEME_VERSION);

  wp_register_style('mapbox-css','https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css',[],THEME_VERSION);
  wp_enqueue_style('koelsch-css',get_stylesheet_directory_uri() .'/style.css',[],THEME_VERSION);
  wp_enqueue_style('adobe-fonts','https://use.typekit.net/sfc3cfe.css',[],THEME_VERSION);
 	wp_enqueue_style( 'dashicons' );

  if (is_page_template('page-templates/community-search.php')){
    wp_enqueue_style('mapbox-css');
  }
 }

 add_theme_support( 'post-thumbnails' );
 add_theme_support('align-wide');
 // Add image sizes.
 add_image_size( 'author-2x', 90, 90, true );
 add_image_size( 'author', 45, 45, true );
 add_image_size( 'resource-listing-sm', 130, 130, true );
 add_image_size( 'resource-listing-sm-2x', 260, 260, true );
 add_image_size( 'resource-listing', 605, 400, true );
 add_image_size( 'resource-listing-2x', 1210, 800, true );
 add_image_size( 'resource-single', 1124, 600, true );
 add_image_size( 'resource-single-sm', 562, 300, true );
 add_image_size( 'resource-single-2x', 2248, 1200, true );
 add_image_size( 'page-header', 1200, 650, true );
 add_image_size( 'community_listing', 750, 454, true );
 // add_image_size( 'page-header-2x', 2000, 1200, true );

 add_action('init', 'register_koelsch_menus');
 function register_koelsch_menus(){
   register_nav_menus(array(
     'main-nav'=> __('Main Navigation', 'koelsch'),
     'privacy-menu'=>__('Privacy Menu', 'koelsch')
   ));
 }
?>
