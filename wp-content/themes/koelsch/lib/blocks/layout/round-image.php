<?php
$imgID = get_field('image');
// $width = get_field('image_width');
// $height = get_field('image_height');
$align = get_field('align');
if ($imgID){
  $imageAlt = get_post_meta($imgID, '_wp_attachment_image_alt', TRUE);
  $image = wp_get_attachment_image_src( $imgID, 'contact-image' );
  $image2x = wp_get_attachment_image_src( $imgID, 'contact-image-2x' );
  $imgSrcset = $image && $image2x ? $image[0].', '.$image2x[0].' 2x' : '';
}
?>
<div class="round-image<?php echo $align ? ' align-'.$align : '';?>"<?php echo isset($block['anchor']) ? ' id="'.$block['anchor'].'"' : '';?>>
  <img src="<?php echo $image[0];?>" srcset="<?php echo $imgSrcset;?>" alt="<?php echo $imageAlt;?>"/>
</div>
