<?php
/**
 * Image With Caption Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Create class attribute allowing for custom "className" and "align" values.
$classes = '';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}

if( !empty($block['align']) ) {
    $classes .= sprintf( ' align-%s', $block['align'] );
}

if( $size = get_field('size') ) {
	$classes .= sprintf( ' %s', $size );
}

if( $cta = get_field('cta_type') ) {
  $classes .= ' '.$cta;
}

if($has_margins = get_field('margins')) $classes .= ' margins';
$container_classes_before = '<div class="container-md">';
$container_classes_after = '</div>';

$img = get_field('image');?>

<section class="content-section-100 <?php echo esc_attr($classes); ?>"<?php echo isset($block['anchor']) ? ' id="'.$block['anchor'].'"' : '';?>>
	<?php echo $container_classes_before; ?>
	<div class="row">
		<?php if($img){ ?>
			<div class="col img-col">
				<?php
        $pos = get_field('horizontal_image_position');
        $mobileStyle = $pos && $pos['mobile'] ? ' @media (max-width:480px){img#'. $block['id'] .'{object-position:'.$pos['mobile'].'!important;}}' : '';
        $tabletStyle = $pos && $pos['tablet'] ? ' @media (min-width:481px) and (max-width:768px){img#'. $block['id'] .'{object-position:'.$pos['tablet'].'!important;}' : '';
        echo $mobileStyle || $tabletStyle ? '<style type="text/css" scoped>'.$mobileStyle.$tabletStyle.'</style>' : '';

          retina_image($img, 'image_and_caption', 'image_and_caption_2x', 'image_and_caption_small', 'image_and_caption', $block['id']);
        ?>
			</div>
		<?php } ?>
		<?php $btn_name = get_field('name');
		$btn_url = get_field('url');
		$caption_text = get_field('caption_text');
		if($caption_text || ($btn_name && $btn_url)){ ?>
		<div class="col text-col">
			<div class="text-box">
				<?php if($caption_text) echo '<h2>'.$caption_text.'</h2>'; ?>
				<?php if($btn_name && $btn_url) echo '<a class="btn-outline" href="'.esc_url($btn_url).'">'.esc_attr($btn_name).'</a>'; ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php echo $container_classes_after; ?>
</section>
