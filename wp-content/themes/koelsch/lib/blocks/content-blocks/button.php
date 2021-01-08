<?php
/**
 * Button Block Template.
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

if( $style = get_field('style') ) {
	if($style != 'outline') $classes .= ' btn ';
    $classes .= sprintf( ' btn-%s', $style );
}

if( $cta = get_field('cta_type') ) {
  $classes .= ' '.$cta;
}

$name = get_field('name');
$url = get_field('url');



if($name && $url){
  if( !empty($block['align']) ) {
      echo '<div class="'.sprintf( 'align-%s', $block['align'] ).' button-wrapper">';
  }
  ?>
	<a class="koelsch-button <?php echo esc_attr($classes); ?>" href="<?php echo esc_url($url) ?>"><?php echo esc_attr($name) ?></a>
<?php if( !empty($block['align']) ) echo '</div>';
} ?>
