<?php /*
SL_seal : Finest Senior Living Badge
IL_seal : Signature IL Badge
AL_seal : Distinctive AL Badge
MC_seal : Distinctive MC Badge
logo : Koelsch Logo
k : "K" Icon Only
circle_k : Circle K 1958 Mark
*/
$icon = get_field('icon');
$color = get_field('color');
$align = get_field('align');
$wd = get_field('width_unit');
$ht = get_field('height_unit');
$wdVal = $wd && $wd != 'auto' ? 'width:'.get_field('width').$wd.';' : '';
$htVal = $ht && $ht != 'auto' ? 'height:'.get_field('height').$ht.';' : '';
$style = $wdVal || $htVal ? 'style="'.$wdVal.$htVal.'"' : '';

if ($icon){
  $src = get_stylesheet_directory_uri() . '/assets/images/svg/'.$icon['value'].'.svg';
  ?>
  <div class="koelsch-icon<?php echo $align ? ' align-'.$align : '';echo ' '.$color;?>">
    <div class="svg-wrap"<?php echo $style;?>><?php echo file_get_contents($src);?></div>
  </div>
  <?php
}
