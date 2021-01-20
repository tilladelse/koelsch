<?php
/**
 * Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
 $classes = 'accordion-wrapper';
 if( !empty($block['className']) ) {
     $classes .= sprintf( ' %s', $block['className'] );
 }
?>
<div class="<?php echo $classes;?>"<?php echo isset($block['anchor']) ? ' id="'.$block['anchor'].'"' : '';?>>
  <a href="#<?php echo $block['id'];?>" class="open-close"><h4><?php echo get_field('title');?></h4><ion-icon name="add-outline"></ion-icon></a>
  <div id="<?php echo $block['id'];?>" class="accordion-content"><?php echo get_field('content');?></div>
</div>
