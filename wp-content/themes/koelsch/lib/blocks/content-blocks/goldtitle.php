<?php
/**
 * Gold Title Block Template.
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

if( !empty($block['align']) ) {
    $classes .= sprintf( ' text-%s', $block['align'] );
}
if($title = get_field('title')){
  $type = get_field('type');?>
	<div class="<?php echo esc_attr($classes); ?>"<?php echo isset($block['anchor']) ? ' id="'.$block['anchor'].'"' : '';?>>
    <strong class="<?php echo $type;?>"><?php echo esc_attr($title)?></strong>
  </div>
<?php } ?>
