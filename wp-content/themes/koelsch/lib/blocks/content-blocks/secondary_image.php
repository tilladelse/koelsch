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

$temp2 = array(
	array('core/heading', array(
		'level' => 2,
		'content' => 'THis is secondary section',
	))
); ?>
<div class="row bottom-row <?php echo esc_attr($classes); ?>">
	<?php 
	$img = get_field('sec_image');
	if($img){ ?>
	<div class="col img-col">
		<?php retina_image($img, 'sec_image_set', 'sec_image_set_2x', 'sec_image_set_small', 'sec_image_set'); ?>
	</div>
	<?php } ?>
	<div class="col text-col">
		<div class="text-box">
			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $temp2 ) ) . '" />'; ?>
		</div>
	</div>
</div>