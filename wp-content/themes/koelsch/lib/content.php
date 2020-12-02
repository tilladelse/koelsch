<?php
function koelsch(){

  global $community_context;
  $community_context->getCommunityContext();

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
add_action('koelsch_before_content', 'second_level_page_menu');
function second_level_page_menu(){
  global $community_context;

  if ($community_context->inCommunityContext){

    $menuID = $community_context->menuID;
    // koelsch_get_community_sub_menu($menuID);

  }else{

    $theme_locations = get_nav_menu_locations();
    $menu_obj = get_term( $theme_locations['main-nav'], 'nav_menu' );
    $menuID = $menu_obj->term_id;
    // koelsch_get_page_sub_menu($menuID);

  }
  koelsch_get_page_sub_menu($menuID);
  //if in community context, get submenu for the community. Else, get submenu items of the main page
  //koelsch_get_page_sub_menu($menuID, $context);


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
