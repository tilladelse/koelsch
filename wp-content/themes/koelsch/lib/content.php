<?php
function koelsch(){
  global $community_context;
  $community_context->getCommunityContext();

  global $page_settings;
  $page_settings = get_koelsch_setting('page_settings');

  get_header();

  if (is_archive()){

    do_action('koelsch_before_content',10);

    $taxonomy = get_query_var('taxonomy');
    get_template_part( 'template-parts/content', $taxonomy );

    do_action('koelsch_after_content',10);

  }else{

    do_action('koelsch_before_content',10);

    do_action('koelsch_loop');

    do_action('koelsch_after_content',10);

   }

   get_footer();
}
add_filter('koelsch_header_show_h1', 'koelsch_header_show_h1');
function koelsch_header_show_h1(){
  $id = get_the_id();
  $showH1 = get_post_meta($id, 'show_header_h1', true);
  if (is_single($id) || is_archive($id)) $showH1 = 'hide';
  return $showH1 == 'hide' ? false : true;
}

add_action('koelsch_before_content', 'second_level_page_menu');
function second_level_page_menu(){
  global $community_context;

  if ($community_context->inCommunityContext){

    $menuID = $community_context->menuID;

  }else{

    $menuID = get_main_nav_id();

  }

  koelsch_get_page_sub_menu($menuID);

}

add_action('koelsch_loop', 'koelsch_loop');
function koelsch_loop(){

  if ( have_posts() ) {

    do_action('koelsch_before_loop');

    while ( have_posts() ) {

      the_post();
      do_action('koelsch_get_template_part');

    }

    do_action('koelsch_after_loop');

  }else{

    do_action('koelsch_no_posts');

  }
}

add_action('koelsch_get_template_part', 'koelsch_get_template_part');
function koelsch_get_template_part(){
  if (is_search()){
    get_template_part( 'template-parts/listing', 'search' );
  }else{
    get_template_part( 'template-parts/content', get_post_type() );
  }
}


?>
