<?php 
/**
 * Gold Line Block Template.
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
} ?>
<div class="<?php echo esc_attr($classes); ?>"><img class="divider" src="<?php echo get_template_directory_uri() ?>/images/divider.jpg" alt="divider"></div>