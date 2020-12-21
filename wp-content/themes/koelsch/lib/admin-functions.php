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
    add_meta_box(
  		'community-menu',
  		__( 'Community Menu', 'koelsch' ),
  		'community_menu_mb_callback',
  		'community',
  		'side',
  		'default'
  	);
  }
  function community_menu_mb_callback($post) {
    	wp_nonce_field( '_community_menu', 'community_menu' );
     $menu_id = get_post_meta($post->ID,'menu_id', true);
     if ($menu_id):
       $menu = wp_get_nav_menu_object($menu_id);
     ?>
    	<p>
    		<p><?php _e( 'Associated community menu: <br><b>'.$menu->name.'</b>', 'koelsch' ); ?></p>
        <a class="button-secondary" href="<?php echo admin_url().'nav-menus.php?action=edit&menu='.$menu_id;?>">Edit Menu</a>
    	</p>
     <p><em>Menu ID: <?php echo $menu->term_id;?></em></p>
     <?php
     else:?>
     <p>No menu is associated with this community.</p>
     <?php endif;
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

 add_action('save_post_community', 'community_info_mb_save', 99);
 function community_info_mb_save( $post_id ) {
   	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
   	if ( ! isset( $_POST['community_info'] ) || ! wp_verify_nonce( $_POST['community_info'], '_community_info' ) ) return;
   	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $livingType = isset($_POST['living_type']) ? $_POST['living_type'] : '';
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

    //set wp cron to update json file after meta data has been saved
    wp_schedule_single_event( time() + 30, 'write_community_json' );

 }

 add_action('write_community_json', 'write_community_json_file');

 /**
  * Gets all communities and re-creates json file used to populate community finder and map
  * @since 1.0.0
  * @return null
  */
 function write_community_json_file(){

   $fileName = 'map-data.json';
   $fileLocation = get_theme_root() . '/koelsch/assets/data';

   if (!file_exists($fileLocation)) {
     mkdir($fileLocation, 0755, true);
   }

   $file = $fileLocation.'/'.$fileName;

   $data = array('markers'=>array());

   //get Communities
   $communities = get_posts(array(
     'post_type'=>'community',
     'numberposts'=>-1,
   ));

   if ($communities){
     foreach($communities as $c){

       $street1 = get_post_meta($c->ID, 'street', true);
       $street2 = get_post_meta($c->ID, 'street_2', true);
       $city = get_post_meta($c->ID, 'city', true);
       $state = get_post_meta($c->ID, 'state', true);
       $zip = get_post_meta($c->ID, 'zipcode', true);
       $stateName = $state && isset(STATES_LIST[$state]) ? STATES_LIST[$state] : '';

       //setup address
       $address = $street1 ? $street1.', ': '';
       $address .= $street2 ? $street2.', ': '';
       $address .= $city ? $city.', ':'';
       $address .= $state.' '.$zip;

       //get coordinates
       $coords = '';
       $result = false;


       $coords = get_map_coordinates($address);

       //get living type Info
       $ltID = get_post_meta($c->ID, 'living_type', true);
       $lts = get_koelsch_setting('living_types');
       $lt = false;
       if ($lts){
         foreach ($lts as $arr){
           if ($ltID == $arr['id']){
             $lt = $arr;
             break;
           }
         }
       }

       $ltAbbrs = '';
       if ($lt && is_array($lt['living_types'])){
         $ltAbbrs = implode('/', $lt['living_types']);
       }

       $ltDesc = $lt ? $lt['name'] : '';

       //get url
       $commHomeID = get_post_meta($c->ID, 'community_home_page_id',true);
       $url = $commHomeID ? get_permalink($commHomeID) : '';

       //get listing image
       $imgID = get_post_thumbnail_id($c->ID);
       $image = $imgID ?  wp_get_attachment_image_src( $imgID, 'community-listing') : '';

       $cdata = array(
         'community'=>$c->post_title,
         'coordinates'=>$coords,
         'address'=>$address,
         'state'=>$stateName,
         'shortStateName'=>$state,
         'city'=>$city,
         'zipcode'=>$zip,
         'careLevel'=>$ltAbbrs,
         'description'=>$ltDesc,
         'url'=>$url,
         'image'=>$image ? $image[0] : '',
       );
       $data['markers'][] = $cdata;
     }
   }

   $json = json_encode($data, JSON_PRETTY_PRINT);
   file_put_contents($file, $json);

 }

 function get_map_coordinates($address){

   $address = str_replace(',', '', $address);
   $requestString = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'.urlencode($address).'.json?limit=1&country=US&access_token='.MAPBOX_TOKEN;

   $result = file_get_contents($requestString);
   if ($result){
     $result = json_decode($result, true);
     $coords = isset($result['features'][0]['center']) ? $result['features'][0]['center'] : '';
     return $coords;
   }
   return '';
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
         $livingTypes = get_community_living_type_options();
         $ltName = $livingTypes[$arr['living_type']];
         $ltPageID = create_page($ltName, $cityPageID, $arr['living_type']);
         if ($ltPageID){
           //set page template
           set_page_template($ltPageID, 'living-type');
           $homePageID = create_page($arr['community_name'], $ltPageID);
           if ($homePageID){
             //create a menu for the community
             create_community_menu($homePageID, $arr['community_post_id']);

             set_page_template($homePageID, 'community');
             update_post_meta($homePageID, 'community_post_id', $arr['community_post_id']);
             update_post_meta($arr['community_post_id'], 'community_home_page_id', $homePageID);
           }
         }
       }
     }
   }
 }
 function create_community_menu($homePageID, $post_id){
   $page = get_page($homePageID);
   $menuExists = wp_get_nav_menu_object($page->post_title);
   if (!$menuExists){
     $menu_id = wp_create_nav_menu($page->post_title);
     update_post_meta($post_id, 'menu_id', $menu_id);
   }else{
     $menu_id = $menuExists->term_id;
   }
   $res = update_post_meta($post_id, 'menu_id', $menu_id);
   update_post_meta($post_id, 'phone', '123456789');
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
  /**
   * Wrapper function around cmb2_get_option
   * @since  0.1.0
   * @param  string $key     Options array key
   * @param  mixed  $default Optional default value
   * @return mixed           Option value
   */
  function get_koelsch_setting( $key = '', $default = false ) {
  	if ( function_exists( 'cmb2_get_option' ) ) {
  		// Use cmb2_get_option as it passes through some key filters.
  		return cmb2_get_option( 'koelsch_settings', $key, $default );
  	}

  	// Fallback to get_option if CMB2 is not loaded yet.
  	$opts = get_option( 'koelsch_settings', $default );

  	$val = $default;

  	if ( 'all' == $key ) {
  		$val = $opts;
  	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
  		$val = $opts[ $key ];
  	}
  	return $val;
  }

  function get_community_living_type_options(){
    $livingTypes = get_koelsch_setting('living_types');
    $ltOpts = array();
    if ($livingTypes){
      foreach($livingTypes as $lt){
        $ltOpts[$lt['id']] = $lt['name'];
      }
    }
    return $ltOpts;
  }

  function koelsch_pages_list(){
    $return = array();
    $pages = get_pages();
    if ($pages){
      foreach($pages as $page){
        $return[$page->ID] = display_page_title_depth($page);
      }
    }
    return $return;
  }
  function display_page_title_depth($page){
    $depth = get_page_depth($page);
    $spacer = '';

    for($i = 1; $i <= $depth; $i++){
      $spacer .= '&nbsp;&nbsp;&nbsp;';
    }

    return $spacer.$page->post_title;

  }
  function get_page_depth($page){
    $parent_id  = $page->post_parent;
    $depth = 0;

    while($parent_id > 0){
        $page = get_page($parent_id);
        $parent_id = $page->post_parent;
        $depth++;
    }

    return $depth;
  }

  function acf_load_floorplan_field_choices( $field ) {

      $floorplans = get_posts(array(
        'post_type'=>'floorplans',
        'posts_per_page'=>-1,
      ));
     if ($floorplans){
       $choices[0] = 'Choose One';
       foreach($floorplans as $floorplan){
         $choices[$floorplan->ID] = $floorplan->post_title;
       }
     }else{
       $choices = array('No Floor Plans Available');
     }

     $field['choices'] = $choices;

      // return the field
      return $field;

  }

  add_filter('acf/load_field/name=floorplan_id', 'acf_load_floorplan_field_choices');


/**
 * modify the Insert/edit Link screen to provide better context for
 * like-named pages
 * @var $results array
 * @var $query $
 * @link https://developer.wordpress.org/reference/classes/_wp_editors/wp_link_query/
 */

  function modify_wp_link_query($results, $query){
    $modified = array();
    if ($results){
      foreach($results as $result){

        $url = get_the_permalink($result['ID']);
        // $pageTpl = get_post_meta($result['ID'], '_wp_page_template', true);
        $perm = preg_replace ('/^(http)?s?:?\/\/[^\/]*(\/?.*)$/i', '$2', '' . $url);

        $title = $result['title']. '<span style="display:block;color:#999;">'.substr($perm, 1, -1).'</span>';//.$pageTpl;

        $result['title'] = $title;
        $modified[] = $result;
      }
    }
    return $modified;
  }
  add_filter('wp_link_query', 'modify_wp_link_query', 10, 2);

?>
