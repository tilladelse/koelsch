<?php
function koelsch(){
  get_header();
  //filter main element
  $mainID = apply_filters('koelsch_main_element_id','main');
  $mainClass = apply_filters('koelsch_main_element_class','');
  $wrapperClass = apply_filters('koelsch_main_wrapper_class', 'main-holder');
  ?>
  <main<?php echo $mainID ? ' id="'.$mainID.'"': '';?><?php echo $mainClass ? ' class="'.$mainClass.'"': '';?>>
    <div<?php echo $wrapperClass ? ' class="'.$wrapperClass.'"': '';?>>
      <?php
      if (is_archive()){
        $taxonomy = get_query_var('taxonomy');
        get_template_part( 'template-parts/content', $taxonomy );
      }else{
        do_action('koelsch_before_content');
        do_action('koelsch_loop');
        do_action('koelsch_after_content');
       }?>
    </div>
  </main>
  <?php get_footer();
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

add_action('koelsch_before_content', 'koelsch_before_content');
function koelsch_before_content(){
  if (is_page()){
  ?>
  <div class="visual-section bg-video-holder community" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/video-placeholder.jpg);">
    <video class="bg-video" width="640" height="360" loop autoplay muted playsinline>
      <source type="video/mp4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/media/Park-Snippet.mp4" />
    </video>
    <div class="holder">
      <div class="community-block community-item">
        <div class="container">
          <div class="community-holder">
            <div class="logo-holder">
              <img class="community-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/the-park.png" alt="image description">
            </div>
            <nav class="community-nav">
              <ul>
                <li><a href="#">Independent Living</a></li>
                <li><a href="#">Explore</a></li>
                <li><a href="#">Activities & Adventures</a></li>
                <li><a href="#">Resources</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <!-- <div class="text-block align-center">
        <h1><?php echo get_the_title();?></h1>
      </div> -->
    </div>
    <a href="#" class="btn-circle anchor-link">
      <ion-icon name="arrow-down"></ion-icon>
      <svg class="top">
        <circle class="circle-top" cx="33" cy="33" r="31" stroke-width="1" fill-opacity="0">
      </svg>
      <svg>
        <circle class="circle-bottom" cx="33" cy="33" r="31" stroke-width="1" fill-opacity="0">
      </svg>
    </a>
    <div class="logo-box">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/independent-logo.png" alt="image description">
    </div>
  </div>
  <?php
  }
}
?>
