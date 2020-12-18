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

 // include( get_template_directory() . '/lib/classes/class.BaseACFLinkHelper.php' );

 //setup community context global
 global $community_context;
 $community_context = new Community_Context;

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

	wp_enqueue_script('turf','https://unpkg.com/@turf/turf/turf.min.js',[],THEME_VERSION);
	wp_enqueue_script('mapbox','https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js',[],THEME_VERSION);
	wp_enqueue_script('ion-icons','https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js',[],THEME_VERSION);

	wp_enqueue_script(
		'koelsch-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.min.js',
		[],
		THEME_VERSION
	);

  wp_localize_script('koelsch-theme', 'koelsch', array(
	'ajaxurl'=>admin_url('admin-ajax.php')
	));

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
add_image_size( 'community-listing', 750, 454, true );
add_image_size( 'contact-image', 150, 150, true );
add_image_size( 'contact-image-2x', 300, 300, true );
add_image_size( 'floorplan', 532, 350, true );
add_image_size( 'floorplan-2x', 1064, 700, true );
// add_image_size( 'page-header-2x', 2000, 1200, true );

/* Update from 05.12.2020 */
add_image_size( 'single_image_50', 1000, 750, true );
add_image_size( 'single_image_2x_50', 2000, 1500, true );
add_image_size( 'single_image_small_50', 500, 375, true );

add_image_size( 'single_image_33', 1383, 739, true );
add_image_size( 'single_image_2x_33', 2766, 1477, true );
add_image_size( 'single_image_small_33', 692, 370, true );

add_image_size( 'single_image_25', 1383, 739, true );
add_image_size( 'single_image_2x_25', 2766, 1477, true );
add_image_size( 'single_image_small_25', 692, 370, true );

add_image_size( 'image_set', 1000, 1000, true );
add_image_size( 'image_set_2x', 2000, 2000, true );
add_image_size( 'image_set_small', 500, 500, true );

add_image_size( 'image_and_caption', 1868, 888, true );
add_image_size( 'image_and_caption_2x', 2560, 1270, true );
add_image_size( 'image_and_caption_small', 934, 444, true );

add_image_size( 'sec_image_set', 788, 610, true );
add_image_size( 'sec_image_set_2x', 1575, 1220, true );
add_image_size( 'sec_image_set_small', 394, 305, true );

add_image_size( 'subsection_image', 1000, 500, true );
add_image_size( 'subsection_image_2x', 2000, 1000, true );
add_image_size( 'subsection_image_small', 500, 250, true );

add_image_size( 'slideshow_image', 1200, 645, true );
add_image_size( 'slideshow_image_2x', 2399, 1290, true );
add_image_size( 'slideshow_image_small', 300, 162, true );
add_image_size( 'slideshow_image_small_2x', 600, 323, true );

add_image_size( 'masonry_image', 503, 491, true );
/*add_image_size( 'masonry_image_2x', 2399, 1290, true );
add_image_size( 'masonry_image_small', 300, 162, true );
add_image_size( 'masonry_image_small_2x', 600, 323, true );*/

 add_action('init', 'register_koelsch_menus');
 function register_koelsch_menus(){
   register_nav_menus(array(
     'main-nav'=> __('Main Navigation', 'koelsch'),
     'privacy-menu'=>__('Privacy Menu', 'koelsch')
   ));
 }

add_action( 'after_setup_theme', 'add_editor_css' );
function add_editor_css(){

	add_theme_support( 'editor-styles' );
	add_editor_style( '/assets/css/editor.css' );

}

function retina_image($img, $img_size, $img_size_2x, $img_size_sm, $img_size_sm_2x){
	if($img){
		$image = $img ? wp_get_attachment_image_url($img, $img_size) : '';
		$image_2x = $img ? wp_get_attachment_image_url($img, $img_size_2x) : '';
		$image_sm = $img ? wp_get_attachment_image_url($img, $img_size_sm) : '';
		$image_sm_2x = $img ? wp_get_attachment_image_url($img, $img_size_sm_2x) : ''; ?>
		<picture>
			<source srcset="<?php echo $image_sm; ?>, <?php echo $image_sm_2x; ?> 2x" media="(max-width: 767px)">
			<source srcset="<?php echo $image; ?>, <?php echo $image_2x; ?> 2x">
			<img src="<?php echo $image; ?>" alt="image description">
		</picture> <?php
	}
}
?>
