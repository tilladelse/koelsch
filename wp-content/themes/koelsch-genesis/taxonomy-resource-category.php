<?php
/**
 * Resource category template.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
// add_filter('genesis_do_breadcrumbs', false);
//* Reposition Breadcrumbs
// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
//remove_action ('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'koelsch_resource_category_loop');
genesis();
?>
