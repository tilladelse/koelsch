<?php
/**
 * Single Image & Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$templ_content = array(
    array('core/heading', array(
		'level' => 2,
		'content' => 'Add Content Area Here',
	))
);

 // Create class attribute allowing for custom "className" and "align" values.
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
    $classes .= sprintf( ' align-%s', $block['align'] );
}

if( $layout = get_field('layout') ) {
    $classes .= sprintf( ' content-section-%s', $layout );
}

if( $text_overlapping = get_field('text_overlapping'))
	$classes .= sprintf( ' overlapping', $text_overlapping );

if( $size = get_field('size') ) {
	$classes .= sprintf( ' %s', $size );
}
if($has_margins = get_field('has_margins')) $classes .= ' margins';
$container_classes_before = '<div class="container-md">';
$container_classes_after = '</div>';

/* background image & position */

$styles = ' style="';
if($bg_color = get_field('bg_color')) $styles .= 'background-color: '.$bg_color.';';
if($bg_image = get_field('bgimage')) $styles .= ' background-image: url('.$bg_image.');';
$styles .= '"';

$v_position = get_field('v_position');
if( $bg_image && $v_position ) {
	$classes .= sprintf( ' %s', $v_position );
}
$h_position = get_field('h_position');
if( $bg_image &&  $h_position) {
	$classes .= sprintf( ' %s', $h_position );
} ?>
<section class="<?php echo esc_attr($classes); ?>" <?php echo $styles ?>>
	<?php echo $container_classes_before; ?>
		<div class="row">
			<?php
			$img = get_field('image');
			if($img){ ?>
				<div class="col img-col">
					<?php retina_image($img, 'single_image_'.$layout, 'single_image_2x_'.$layout, 'single_image_small_'.$layout, 'single_image_'.$layout); ?>
				</div>
			<?php } ?>
			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $templ_content ) ) . '" />'; ?>
		</div>
	<?php echo $container_classes_after; ?>
</section>
