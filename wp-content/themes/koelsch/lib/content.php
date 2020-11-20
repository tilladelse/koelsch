<?php
function koelsch(){
  //check and see if in community context

  get_header();

  if (is_archive()){

    do_action('koelsch_before_content');

    $taxonomy = get_query_var('taxonomy');
    get_template_part( 'template-parts/content', $taxonomy );

    do_action('koelsch_after_content');

  }else{

    do_action('koelsch_before_content');

    do_action('koelsch_loop');

    do_action('koelsch_after_content');

   }

   get_footer();
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

//add_action('koelsch_before_content', 'koelsch_before_content');
function koelsch_before_content(){

}


?>
