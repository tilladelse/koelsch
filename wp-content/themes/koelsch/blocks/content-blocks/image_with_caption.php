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
if($has_margins = get_field('has_margins')) $classes .= ' margins'; 
$container_classes_before = '<div class="container-md">';
$container_classes_after = '</div>';

$image = get_field('image') ? wp_get_attachment_image_url(get_field('image'), 'single_image_'.$layout) : '';
$image_2x = get_field('image_2x') ? wp_get_attachment_image_url(get_field('image_2x'), 'single_image_'.$layout) : '';
$image_sm = get_field('image_small') ? wp_get_attachment_image_url(get_field('image_small'), 'single_image_'.$layout) : ''; ?>

<section class="content-section-100 <?php echo esc_attr($classes); ?>">
	<?php echo $container_classes_before; ?>
	<div class="row">
		<?php if($image && $image_2x && $image_sm){ ?>
			<div class="col img-col">
				<picture>
					<source srcset="<?php echo $image_sm; ?>, <?php echo $image; ?> 2x" media="(max-width: 767px)">
					<source srcset="<?php echo $image; ?>, <?php echo $image_2x; ?> 2x">
					<img src="<?php echo $image; ?>" alt="image description">
				</picture>
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