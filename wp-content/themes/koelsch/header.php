<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    <?php //prevent flash of unhidden submenus on load ?>
    #nav .drop,#nav .submenu{display: none;}
    </style>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php do_action('koelsch_inside_body');?>
    <div id="wrapper">
    <?php do_action('koelsch_header');
