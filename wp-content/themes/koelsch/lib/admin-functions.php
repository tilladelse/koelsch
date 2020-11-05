<?php
/**
 * Koelsch theme admin functions. Callbacks, hooks & such.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
 add_action( 'add_meta_boxes', 'add_community_info_mb' );
  function add_community_info_mb() {
  	add_meta_box(
  		'community-info',
  		__( 'Community Info', 'koelsch' ),
  		'community_info_mb_callback',
  		'community',
  		'side',
  		'default'
  	);
  }
 function community_info_mb_callback($post) {
   	wp_nonce_field( '_community_info', 'community_info' );
    $chp = get_post_meta($post->ID,'community_home_page_id', true);
    if ($chp):
    ?>
   	<p>
   		<label for="community_home_page_id"><?php _e( 'Home page ID: '.$chp, 'koelsch' ); ?></label><br>
      <a href="<?php echo get_edit_post_link($chp);?>" target="_blank">Edit Homepage</a>
   		<input type="hidden" name="community_home_page_id" id="community_home_page_id" value="<?php echo $chp; ?>">
   	</p>
    <p><a class="button-secondary reset-homepage" href="#">Re-create Community Homepage</a></p>
    <?php
    else:?>
    <input type="hidden" name="_create_homepage" value="1"/>
    <p>No homepage ID is associated with this community.</p>
    <?php endif;
 }

 add_action('save_post_community', 'community_info_mb_save');
 function community_info_mb_save( $post_id ) {
   	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
   	if ( ! isset( $_POST['community_info'] ) || ! wp_verify_nonce( $_POST['community_info'], '_community_info' ) ) return;
   	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $livingType = isset($_POST['living-type']) ? $_POST['living-type'] : '';
    $communityName = isset($_POST['post_title']) ? $_POST['post_title'] : '';

   	if ( isset( $_POST['community_home_page_id'] ) ){
      update_post_meta( $post_id, 'community_home_page_id', esc_attr( $_POST['community_home_page_id'] ) );
    }
    if (isset($_POST['_create_homepage'])&&
    $state && $city && $livingType && $communityName){

      $arr = array(
        'community_name'=> $communityName,
        'community_post_id'=>$post_id,
        'state'=>$state,
        'city'=>$city,
        'living_type'=>$livingType,
      );
      create_community_home_page($arr);
    }
 }

 function create_community_home_page($arr){
   //first check if 'senior-living' exists
   $base = get_page_by_path('senior-living');
   if ($base){
     $baseID = $base->ID;
   }else{
     $baseID = create_page('Senior Living', '0');
   }
   if ($baseID){
     //set page template
     set_page_template($baseID,'base');
     $states = STATES_LIST;
     $statePageID = create_page($states[$arr['state']], $baseID, $arr['state']);
     if ($statePageID){
       //set page template
       set_page_template($statePageID, 'state');
       //create city page
       $cityPageID = create_page($arr['city'], $statePageID);
       if ($cityPageID){
         //set page template
         set_page_template($cityPageID, 'city');
         //create living type page
         $livingTypes = LIVING_TYPES;
         $ltPageID = create_page($livingTypes[$arr['living_type']], $cityPageID, $arr['living_type']);
         if ($ltPageID){
           //set page template
           set_page_template($ltPageID, 'living-type');
           $homePageID = create_page($arr['community_name'], $ltPageID);
           if ($homePageID){
             set_page_template($homePageID, 'community');
             update_post_meta($homePageID, 'community_post_id', $arr['community_post_id']);
             update_post_meta($arr['community_post_id'], 'community_home_page_id', $homePageID);
           }
         }
       }
     }
   }
 }
 function set_page_template($id, $templateType){
   update_post_meta( $id, '_wp_page_template', 'page-templates/'.$templateType.'.php' );
 }
 function create_page($title, $parent, $slug =''){
   //check if page exists under parent
   $childPages = get_pages(array('parent'=>$parent));
   foreach($childPages as $cp){
     if ($cp->post_title == $title)
      //if so, return that page id
      return $cp->ID;
   }

   //if not create new page
   $postArr = array(
    'post_title'   => $title,
    'post_type'   => 'page',
    'post_status'  => 'publish',
    'post_author'  => get_current_user_id(),
    'post_parent'  => $parent
  );
  if ($slug) $postArr['post_name'] = $slug;
   $p = wp_insert_post($postArr);
  return $p;
 }

  function menu_select_options(){
    $navMenus = wp_get_nav_menus();
    $options = array();
    if ($navMenus){
      foreach($navMenus as $menu){
        $options[$menu->term_id] = $menu->name;
      }
    }
    return $options;
  }
?>
