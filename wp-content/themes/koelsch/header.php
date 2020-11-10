<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
  </head>
  <?php $headerClass = get_post_meta(get_the_id(), 'header_type', true);
  ?>
  <body <?php body_class(); ?>>
    <div id="wrapper">
    <?php do_action('do_koelsch_header');
