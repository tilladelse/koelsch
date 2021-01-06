<?php
/**
 *
 * Template Name: Community
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

add_action('wp_head', function(){
  $localSchema = get_post_meta(get_the_id(),'local_schema', true);
  if ($localSchema){
    echo '<script id="localSchema" type="application/ld+json">'.$localSchema.'</script>';
  }

});
koelsch();
?>
