<?php
/**
 * Koelsch.
 *
 * This file adds functions to the Koelsch Theme.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

 //include vendor files
 require_once __DIR__ . '/vendor/autoload.php';

 // Init Genesis Core
 require_once get_template_directory() . '/lib/init.php';
 //include custom metaboxes
 require_once __DIR__ . '/lib/admin-functions.php';
 //consants
 require_once __DIR__ . '/lib/constants.php';
 //custom post types
 require_once __DIR__ . '/lib/post-types.php';
 //include custom metaboxes
 require_once __DIR__ . '/lib/metaboxes.php';

 add_action( 'after_setup_theme', 'koelsch_localization_setup' );
 /**
  * Sets localization (do not remove).
  *
  * @since 1.0.0
  */
 function koelsch_localization_setup() {

 	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

 }

 add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
 /**
  * Adds Gutenberg opt-in features and styling.
  *
  * @since 1.1.0
  */
 function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
 	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
 }
 add_action('admin_enqueue_scripts', 'koelsch_enqueue_admin_scripts');
 function koelsch_enqueue_admin_scripts(){
   wp_enqueue_script(
     genesis_get_theme_handle() . '-admin-scripts',
     get_stylesheet_directory_uri() . '/assets/js/admin.min.js',
     genesis_get_theme_version()
   );
 }

 add_action( 'wp_enqueue_scripts', 'koelsch_enqueue_scripts_styles' );
 /**
  * Enqueues scripts and styles.
  *
  * @since 1.0.0
  */
 function koelsch_enqueue_scripts_styles() {

 	$appearance = genesis_get_config( 'appearance' );

 	wp_enqueue_style(
 		genesis_get_theme_handle() . '-fonts',
 		$appearance['fonts-url'],
 		[],
 		genesis_get_theme_version()
 	);

 	wp_enqueue_style( 'dashicons' );

 	// if ( genesis_is_amp() ) {
 	// 	wp_enqueue_style(
 	// 		genesis_get_theme_handle() . '-amp',
 	// 		get_stylesheet_directory_uri() . '/lib/amp/amp.css',
 	// 		[ genesis_get_theme_handle() ],
 	// 		genesis_get_theme_version()
 	// 	);
 	// }

 }

 add_action( 'after_setup_theme', 'koelsch_theme_support', 9 );
 /**
  * Add desired theme supports.
  *
  * See config file at `config/theme-supports.php`.
  *
  * @since 3.0.0
  */
 function koelsch_theme_support() {

 	$theme_supports = genesis_get_config( 'theme-supports' );

 	foreach ( $theme_supports as $feature => $args ) {
 		add_theme_support( $feature, $args );
 	}

 }

 add_action( 'after_setup_theme', 'koelsch_post_type_support', 9 );
 /**
  * Add desired post type supports.
  *
  * See config file at `config/post-type-supports.php`.
  *
  * @since 3.0.0
  */
 function koelsch_post_type_support() {

 	$post_type_supports = genesis_get_config( 'post-type-supports' );

 	foreach ( $post_type_supports as $post_type => $args ) {
 		add_post_type_support( $post_type, $args );
 	}

 }

 // Add image sizes.
 add_image_size( 'koelsch-singular-images', 702, 526, true );

 add_filter( 'wp_nav_menu_args', 'koelsch_secondary_menu_args' );
 /**
  * Reduces secondary navigation menu to one level depth.
  *
  * @since 2.2.3
  *
  * @param array $args Original menu options.
  * @return array Menu options with depth set to 1.
  */
 function koelsch_secondary_menu_args( $args ) {

 	if ( 'secondary' === $args['theme_location'] ) {
 		$args['depth'] = 1;
 	}

 	return $args;

 }

?>
