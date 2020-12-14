<?php 
/**
 * Image & Content Set Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
$classes = 'content-section-double';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
    $classes .= sprintf( ' align-%s', $block['align'] );
}
$set = array(
	array('core/heading', array(
		'level' => 2,
		'content' => 'This is Image & Content Set',
	))
);

$styles = ' style="';
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
	<div class="container-md">
		<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $set ) ) . '" />'; ?>
	</div>
</section>