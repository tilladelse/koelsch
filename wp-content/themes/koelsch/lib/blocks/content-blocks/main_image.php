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
		<?php
    $pos = get_field('horizontal_image_position');
    $mobileStyle = $pos && $pos['mobile'] ? ' @media (max-width:480px){img#'. $block['id'] .'{object-position:'.$pos['mobile'].'!important;}}' : '';
    $tabletStyle = $pos && $pos['tablet'] ? ' @media (min-width:481px) and (max-width:768px){img#'. $block['id'] .'{object-position:'.$pos['tablet'].'!important;}' : '';
    echo $mobileStyle || $tabletStyle ? '<style type="text/css" scoped>'.$mobileStyle.$tabletStyle.'</style>' : '';

      retina_image($img, 'image_set', 'image_set_2x', 'image_set_small', 'image_set', $block['id']); ?>
	</div>
	<?php } ?>
	<div class="col text-col">
		<div class="text-box">
			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $temp1 ) ) . '" />'; ?>
			<img class="divider divider-vertical" src="<?php echo get_template_directory_uri() ?>/images/divider-vertical.jpg" alt="divider">
		</div>
	</div>
</div>
