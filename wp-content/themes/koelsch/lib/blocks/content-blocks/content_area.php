<?php
/**
 * Content Area Block Template.
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
    $classes .= sprintf( ' h-align-%s', $block['align'] );
}

if( !empty($block['align_content']) ) {
    $classes .= sprintf( ' v-align-%s', $block['align_content'] );
}

$template = array(
	array('core/heading', array(
		'level' => 2,
		'content' => 'Title Goes Here',
	)),
    array( 'core/paragraph', array(
        'content' => 'Add something here',
    ) )
); ?>

<div class="col text-col <?php echo esc_attr($classes); ?>"<?php echo isset($block['anchor']) ? ' id="'.$block['anchor'].'"' : '';?>>
	<div class="text-box" <?php if($bg_color = get_field('background_color')) echo 'style="background-color: '.$bg_color.' !important;"'; ?>>
		<?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
	</div>
</div>
