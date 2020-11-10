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
define('THEME_VERSION', '1.0.0');

 //include vendor files
 require_once __DIR__ . '/vendor/autoload.php';
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
 //header hooks
 require_once __DIR__ . '/lib/header.php';
 //footer hooks
 require_once __DIR__ . '/lib/footer.php';

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
  wp_enqueue_style('koelsch-css',get_stylesheet_directory_uri() .'/style.css',[],THEME_VERSION);
	wp_enqueue_script(
		'koelsch' . '-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.min.js',
		[],
		THEME_VERSION
	);
  wp_enqueue_script('ion-icons','https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js',[],THEME_VERSION);
  wp_enqueue_style('adobe-fonts','https://use.typekit.net/sfc3cfe.css',[],THEME_VERSION);
 	wp_enqueue_style( 'dashicons' );
 }

 // Add image sizes.
 add_image_size( 'koelsch-singular-images', 702, 526, true );


?>
