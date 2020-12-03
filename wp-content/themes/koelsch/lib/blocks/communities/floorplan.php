<?php
$fpID = get_field( 'floorplan_id' );
if ($fpID){
  echo 'show floorplan: '.get_field( 'floorplan_id' );
  $title = get_post_meta($fpID, 'display_name', true);
  $beds = get_post_meta($fpID, 'bedrooms', true);
  $baths = get_post_meta($fpID, 'bathrooms', true);
  $sf = get_post_meta($fpID, 'sf', true);
}
?>
