<?php
/**
 * Koelsch theme appearance settings.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

$koelsch_default_colors = [
	'link'   => '#0073e5',
	'accent' => '#0073e5',
];

$koelsch_link_color = get_theme_mod(
	'koelsch_link_color',
	$koelsch_default_colors['link']
);

$koelsch_accent_color = get_theme_mod(
	'koelsch_accent_color',
	$koelsch_default_colors['accent']
);

$koelsch_link_color_contrast   = genesis_sample_color_contrast( $koelsch_link_color );
$koelsch_link_color_brightness = genesis_sample_color_brightness( $koelsch_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $koelsch_link_color,
	'button-color'         => $koelsch_link_color_contrast,
	'button-outline-hover' => $koelsch_link_color_brightness,
	'link-color'           => $koelsch_link_color,
	'default-colors'       => $koelsch_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'koelsch' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $koelsch_link_color,
		],
		[
			'name'  => __( 'Accent color', 'koelsch' ),
			'slug'  => 'theme-secondary',
			'color' => $koelsch_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'koelsch' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'koelsch' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'koelsch' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'koelsch' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];
