<?php //get page background
  $bg = get_post_meta(get_the_id(), 'background_image', true);
  $bg = isset($bg[0]) ? $bg[0] : false;
  $src = $bg && isset($bg['image']) ? $bg['image'] : '';
  $color = $bg && isset($bg['color']) ? ' '.$bg['color'] : '';
  $hzAlign = $bg && isset($bg['horiz_align']) ? $bg['horiz_align'] : '';
  $vtAlign = $bg && isset($bg['vert_align']) ? $bg['vert_align'] : '';
  $rule = $src ? ' style="background: url('.$src.') no-repeat;' : '';
  $rule .= $src ? ' background-position: '.$hzAlign.' '.$vtAlign.';"' : '';
  $containerClass = apply_filters('koelsch_container_class', 'container-md');
?>
<div class="page-content<?php echo $color;?>"<?php echo $rule;?> id="page_content">
<section class="section">
  <div class="<?php echo $containerClass;?>">
    <?php the_content(); ?>
  </div>
</section>
</div>
