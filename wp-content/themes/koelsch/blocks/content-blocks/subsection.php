<?php 
/**
 * Subsection Block Template.
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

$temp = array(
	array('core/heading', array(
		'level' => 2,
		'content' => 'Title Goes Here',
	))
);
$border_color = get_field('border_color');
$image = get_field('image') ? wp_get_attachment_image_url(get_field('image'), 'subsection_image') : '';
$image_2x = get_field('image_2x') ? wp_get_attachment_image_url(get_field('image_2x'), 'subsection_image_2x') : '';
$image_sm = get_field('image_small') ? wp_get_attachment_image_url(get_field('image_small'), 'subsection_image_small') : ''; ?>

<section class="resource-block <?php echo esc_attr($classes); ?>">
	<div class="img-box">
		<?php if($image && $image_2x && $image_sm){ ?>
			<picture>
				<source srcset="<?php echo $image_sm; ?>, <?php echo $image; ?> 2x" media="(max-width: 767px)">
				<source srcset="<?php echo $image; ?>, <?php echo $image_2x; ?> 2x">
				<img src="<?php echo $image; ?>" alt="image description">
			</picture>
		<?php } ?>
		<div class="category-info">
			<?php if($block_title = get_field('block_title')){ ?><span class="text"><?php echo esc_attr($block_title) ?></span><?php } ?>
			<img class="icon-logo" src="<?php echo get_template_directory_uri() ?>/images/logo-dark-sm.png" alt="K 1958">
		</div>
	</div>
	<div class="body" <?php if($border_color) echo 'style="border-color: '.$border_color.' !important;"'; ?>>
		<div class="head">
			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $temp ) ) . '" />'; ?>
		</div>		
	</div>
</section>