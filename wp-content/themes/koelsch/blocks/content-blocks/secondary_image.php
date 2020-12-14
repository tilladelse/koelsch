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
	<?php $sec_image = get_field('sec_image') ? wp_get_attachment_image_url(get_field('sec_image'), 'sec_image_set') : '';
	$sec_image_2x = get_field('sec_image_2x') ? wp_get_attachment_image_url(get_field('sec_image_2x'), 'sec_image_set_2x') : '';
	$sec_image_sm = get_field('sec_image_sm') ? wp_get_attachment_image_url(get_field('sec_image_sm'), 'sec_image_set_small') : ''; ?>
	<div class="col img-col">
		<picture>
			<source srcset="<?php echo $sec_image_sm; ?>, <?php echo $sec_image; ?> 2x" media="(max-width: 767px)">
			<source srcset="<?php echo $sec_image; ?>, <?php echo $sec_image_2x; ?> 2x">
			<img src="<?php echo $sec_image; ?>" alt="image description">
		</picture>
	</div>
	<div class="col text-col">
		<div class="text-box">
			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $temp2 ) ) . '" />'; ?>
		</div>
	</div>
</div>