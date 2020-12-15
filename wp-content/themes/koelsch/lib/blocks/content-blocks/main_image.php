<?php 
/**
 * Image & Content Set Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}

$temp1 = array(
	array('core/heading', array(
		'level' => 2,
		'content' => 'This is main section',
	))
); ?>
<div class="row top-row <?php echo esc_attr($classes); ?>">
	<?php 
	$img = get_field('image');
	if($img){ ?>
	<div class="col img-col">
		<?php retina_image($img, 'image_set', 'image_set_2x', 'image_set_small', 'image_set'); ?>
	</div>
	<?php } ?>
	<div class="col text-col">
		<div class="text-box">
			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $temp1 ) ) . '" />'; ?>
			<img class="divider divider-vertical" src="<?php echo get_template_directory_uri() ?>/images/divider-vertical.jpg" alt="divider">
		</div>
	</div>
</div>