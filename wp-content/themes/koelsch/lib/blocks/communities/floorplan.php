<?php
$fpID = get_field( 'floorplan_id' );
if ($fpID){
  $title = get_post_meta($fpID, 'display_name', true);
  $beds = get_post_meta($fpID, 'bedrooms', true);
  $baths = get_post_meta($fpID, 'bathrooms', true);
  $sf = get_post_meta($fpID, 'sf', true);
  $desc = get_post_meta($fpID, 'desc', true);

  $featImgID = get_post_thumbnail_id($fpID);
  $featImgSrc = $featImgID ? get_the_post_thumbnail_url($fpID, 'resource-listing') : false;
  $featImgSrc2X = $featImgID ? get_the_post_thumbnail_url($fpID, 'resource-listing-2x') : false;
  $featImgSrcset = $featImgSrc ? $featImgSrc.', '.$featImgSrc2X.' 2x' : '';

  ?>
  <div class="floorplan">
    <?php if ($featImgSrcset):?>
    <figure>
      <div class="enlarge"><i class=""></i></div>
      <img src="<?php echo $featImgSrc;?>" srcset="<?php echo $featImgSrcset;?>"/>
    </figure>
  <?php endif;?>
  <div class="title"><?php echo $title;?></div>
  <ul class="details">
    <?php echo $beds ? '<li>'.$beds.' <span>BR</span></li>' : '';?>
    <?php echo $baths ? '<li>'.$baths.' <span>BA</span></li>' : '';?>
    <?php echo $sf ? '<li>'.$sf.' <span>SF</span></li>' : '';?>
  </ul>
  <?php echo $desc ? '<p>'.$desc.'</p>' : '';?>
  </div>
  <?php
}
?>
