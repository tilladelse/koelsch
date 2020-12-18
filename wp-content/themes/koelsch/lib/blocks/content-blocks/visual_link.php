<?php
$image = get_field('image');
$desc = get_field('description');
$btnTitle = get_field('button_title');
$link = get_field('link');
$descPos = get_field('description_position');
?>
<div class="visual-link<?php echo ' '.$descPos;?>">
  <a href="<?php echo $link;?>">
    <picture>
      <?php echo get_image_srcset($image, 'resource-listing', 'resource-listing-2x');?>
      <?php echo $btnTitle ? '<div class="btn-outline">'.$btnTitle.'</div>' : '';?>
    </picture>
    <?php echo $desc ? '<div class="description">'.$desc.'</div>' : '';?>    
  </a>
</div>
<?php
?>
