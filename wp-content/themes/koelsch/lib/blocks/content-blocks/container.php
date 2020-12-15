<?php 
/**
 * Single Image & Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
 
$template = array(
    array( 'core/paragraph', array(
        'content' => 'Add something here',
    ) )
);
 
 // Create class attribute allowing for custom "className" and "align" values.
$classes = 'content-section-double';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}

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
	<?php echo $bg_img; ?>	
	<div class="container-md">
		<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>		
	</div>
</section>