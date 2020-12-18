<?php
$fpID = get_field( 'floorplan_id' );
if ($fpID){
  $title = get_post_meta($fpID, 'display_name', true);
  $beds = get_post_meta($fpID, 'bedrooms', true);
  $baths = get_post_meta($fpID, 'bathrooms', true);
  $sf = get_post_meta($fpID, 'sf', true);
  $desc = get_post_meta($fpID, 'desc', true);

  $featImgID = get_post_thumbnail_id($fpID);
  $img = get_image_srcset($featImgID, 'floorplan', 'floorplan-2x');

  ?>
  <div class="floorplan">
    <?php if ($img):?>
    <figure>
      <div class="enlarge"><ion-icon name="expand-outline"></ion-icon></div>
      <?php echo $img;?>
    </figure>
  <?php endif;?>
  <div class="info-wrap">
    <div class="title"><?php echo $title;?></div>
    <ul class="details">
      <?php echo $beds ? '<li>'.$beds.' <span>BR</span></li>' : '';?>
      <?php echo $baths ? '<li>'.$baths.' <span>BA</span></li>' : '';?>
      <?php echo $sf ? '<li>'.$sf.' <span>SF</span></li>' : '';?>
    </ul>
    <?php echo $desc ? '<p>'.$desc.'</p>' : '';?>
    </div>
  </div>
  <?php
}
?>
