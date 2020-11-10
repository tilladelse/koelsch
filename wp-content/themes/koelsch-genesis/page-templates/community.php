<?php
/**
 *
 * Template Name: Community
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
 add_filter('genesis_attr_site-header', 'add_community_header_class'); 
 add_action('genesis_after_header', 'koelsch_page_intro');
 genesis();
?>
