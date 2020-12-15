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
	<?php $image = get_field('image') ? wp_get_attachment_image_url(get_field('image'), 'image_set') : '';
	$image_2x = get_field('image_2x') ? wp_get_attachment_image_url(get_field('image_2x'), 'image_set_2x') : '';
	$image_sm = get_field('image_small') ? wp_get_attachment_image_url(get_field('image_small'), 'image_set_small') : ''; ?>
	<div class="col img-col">
		<picture>
			<source srcset="<?php echo $image_sm; ?>, <?php echo $image; ?> 2x" media="(max-width: 767px)">
			<source srcset="<?php echo $image; ?>, <?php echo $image_2x; ?> 2x">
			<img src="<?php echo $image; ?>" alt="image description">
		</picture>
	</div>
	<div class="col text-col">
		<div class="text-box">
			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $temp1 ) ) . '" />'; ?>
			<img class="divider divider-vertical" src="<?php echo get_template_directory_uri() ?>/images/divider-vertical.jpg" alt="divider">
		</div>
	</div>
</div>