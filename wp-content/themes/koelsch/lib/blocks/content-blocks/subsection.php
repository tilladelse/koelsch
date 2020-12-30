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
		'content' => 'Hi I\'m a title',
	))
);
$border_color = get_field('border_color');

$img = get_field('image'); ?>
<div class="container-md">
  <section class="resource-block <?php echo esc_attr($classes); ?>">
  	<div class="img-box">
  		<?php if($img){
        $pos = get_field('horizontal_image_position');
        $mobileStyle = $pos && $pos['mobile'] ? ' @media (max-width:480px){img{object-position:'.$pos['mobile'].'!important;}}' : '';
        $tabletStyle = $pos && $pos['tablet'] ? ' @media (min-width:481px) and (max-width:768px){img{object-position:'.$pos['tablet'].'!important;}' : '';
        echo $mobileStyle || $tabletStyle ? '<style type="text/css" scoped>'.$mobileStyle.$tabletStyle.'</style>' : '';

        retina_image($img, 'subsection_image', 'subsection_image_2x', 'subsection_image_small', 'subsection_image');
      } ?>
  		<div class="category-info">
  			<?php if($block_title = get_field('block_title')){ ?><span class="text"><?php echo esc_attr($block_title) ?></span><?php } ?>
  			<img class="icon-logo" src="<?php echo get_template_directory_uri() ?>/assets/images/svg/circle_k.svg" alt="K 1958">
  		</div>
  	</div>
  	<div class="body" <?php if($border_color) echo 'style="border-color: '.$border_color.' !important;"'; ?>>
  		<div class="head">
  			<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $temp ) ) . '" />'; ?>
  		</div>
  	</div>
  </section>
</div>
