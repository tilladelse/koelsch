<?php
$image = get_field('image');
$desc = get_field('description');
$btnTitle = get_field('button_title');
$link = get_field('link');
?>
<div class="visual-link">
  <a href="<?php echo $link;?>">
    <?php echo get_image_srcset($image, 'resource-listing', 'resource-listing-2x');?>
    <?php echo $desc ? '<div class="description">'.$desc.'</div>' : '';?>
    <?php echo $btnTitle ? '<div class="btn-outline">'.$btnTitle.'</div>' : '';?>
  </a>
</div>
<?php
?>
