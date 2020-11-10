<?php
/**
 * Koelsch theme metaboxes.
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */
  add_action( 'cmb2_admin_init', 'koelsch_register_community_metaboxes' );
  function koelsch_register_community_metaboxes() {
    $cd = new_cmb2_box( array(
   		'id'            => 'details',
   		'title'         => __( 'Community Details', 'koelsch' ),
   		'object_types'  => array( 'community', ), // Post type
   		'context'       => 'normal',
   		'priority'      => 'high',
   		'show_names'    => true, // Show field names on the left
   		// 'cmb_styles' => false, // false to disable the CMB stylesheet
   		// 'closed'     => true, // Keep the metabox closed by default
   	) );
    $cd->add_field( array(
      'name'       => __( 'Phone Number', 'koelsch' ),
      'desc'       => __( 'Community main contact number', 'koelsch' ),
      'id'         => 'phone',
      'type'       => 'text_medium',
    ) );
    $cd->add_field( array(
      'name'       => __( 'Email Adress', 'koelsch' ),
      'desc'       => __( 'Community main email address. Form subissions and contact requests will be delivered here.', 'koelsch' ),
      'id'         => 'email',
      'type'       => 'text_email',
    ) );

    $cd->add_field( array(
      'name'       => __( 'Living Type', 'koelsch' ),
      // 'desc'       => __( '', 'koelsch' ),
      'id'         => 'living_type',
      'type'       => 'select',
      'show_option_none' => true,
      'options'   => get_community_living_type_options(),
    ) );
    $cd->add_field( array(
      'name'       => __( 'Community Logo', 'koelsch' ),
      // 'desc'       => __( 'Street Address', 'koelsch' ),
      'id'         => 'logo',
      'type'       => 'file',
    ) );


    /*
    Community Address
     */
   $ci = new_cmb2_box( array(
  		'id'            => 'address',
  		'title'         => __( 'Community Address', 'koelsch' ),
  		'object_types'  => array( 'community', ), // Post type
  		'context'       => 'normal',
  		'priority'      => 'high',
  		'show_names'    => true, // Show field names on the left
  		// 'cmb_styles' => false, // false to disable the CMB stylesheet
  		// 'closed'     => true, // Keep the metabox closed by default
  	) );
    $ci->add_field( array(
        'name' => 'Important',
        'desc' => 'Take care to make sure the city and state are correct before saving. The community\'s URL structure is generated using the state, city and living type.',
        'type' => 'title',
        'id'   => 'address_warning'
    ) );
  	// Street Address
  	$ci->add_field( array(
  		'name'       => __( 'Street Address', 'koelsch' ),
  		// 'desc'       => __( 'Street Address 2', 'koelsch' ),
  		'id'         => 'street',
  		'type'       => 'text',
  	) );

    // Street Address 2
  	$ci->add_field( array(
  		'name'       => __( 'Street Address 2', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'street_2',
  		'type'       => 'text',
  	) );

    // Street Address 2
  	$ci->add_field( array(
  		'name'       => __( 'City', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'city',
  		'type'       => 'text_medium',
  	) );

    $ci->add_field( array(
  		'name'       => __( 'State', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'state',
  		'type'       => 'select',
      'options'   => STATES_LIST,
      'show_option_none' => true,
  	) );

    $ci->add_field( array(
  		'name'       => __( 'Zipcode', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'zipcode',
  		'type'       => 'text_small',
  	) );

    /*
    Contact Person
     */
   $cp = new_cmb2_box( array(
  		'id'            => 'contact-person',
  		'title'         => __( 'Contact Person', 'koelsch' ),
  		'object_types'  => array( 'community', ), // Post type
  		'context'       => 'normal',
  		'priority'      => 'high',
  		'show_names'    => true, // Show field names on the left
  		// 'cmb_styles' => false, // false to disable the CMB stylesheet
  		// 'closed'     => true, // Keep the metabox closed by default
  	) );

    $cp->add_field( array(
  		'name'       => __( 'Full Name', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'contact_name',
  		'type'       => 'text',
  	) );
    $cp->add_field( array(
  		'name'       => __( 'Title', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'contact_title',
  		'type'       => 'text',
  	) );
    $cp->add_field( array(
  		'name'       => __( 'Email', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'comtact_email',
  		'type'       => 'text_email',
  	) );
    $cp->add_field( array(
      'name'       => __( 'Profile Image', 'koelsch' ),
      // 'desc'       => __( 'Street Address', 'koelsch' ),
      'id'         => 'contact_image',
      'type'       => 'file',
    ) );

    /*
    Community Menu
     */
   $cm = new_cmb2_box( array(
  		'id'            => 'menu',
  		'title'         => __( 'Community Menu', 'koelsch' ),
  		'object_types'  => array( 'community', ), // Post type
  		'context'       => 'normal',
  		'priority'      => 'high',
  		'show_names'    => true, // Show field names on the left
  		// 'cmb_styles' => false, // false to disable the CMB stylesheet
  		// 'closed'     => true, // Keep the metabox closed by default
  	) );

    $cm->add_field( array(
  		'name'       => __( 'Choose Menu', 'koelsch' ),
  		// 'desc'       => __( 'Street Address', 'koelsch' ),
  		'id'         => 'menu',
  		'type'       => 'select',
      'options'   => menu_select_options(),
      'show_option_none' => true,
  	) );
  }
  /*
  * Resources metabox
   */
  add_action( 'cmb2_init', 'koelsch_register_resource_metaboxes' );
  function koelsch_register_resource_metaboxes() {
    $auth = new_cmb2_box( array(
      'id'            => 'author',
      'title'         => __( 'Resource Author', 'koelsch' ),
      'object_types'  => array( 'resources', ), // Post type
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true, // Show field names on the left
      // 'cmb_styles' => false, // false to disable the CMB stylesheet
      // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $auth->add_field( array(
      'name'       => __( 'Author Name', 'koelsch' ),
      // 'desc'       => __( 'Community main contact number', 'koelsch' ),
      'id'         => 'author_name',
      'type'       => 'text',
    ) );
    $auth->add_field( array(
      'name'       => __( 'Author Title', 'koelsch' ),
      // 'desc'       => __( 'Community main contact number', 'koelsch' ),
      'id'         => 'author_title',
      'type'       => 'text',
    ) );
    $auth->add_field( array(
      'name'       => __( 'Author Image', 'koelsch' ),
      // 'desc'       => __( 'Street Address', 'koelsch' ),
      'id'         => 'author_image',
      'type'       => 'file',
    ) );
  }

add_action( 'cmb2_admin_init', 'koelsch_register_theme_settings_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function koelsch_register_theme_settings_metabox() {

	/**
	 * Registers options page menu item and form.
	 */
	$k_settings = new_cmb2_box( array(
		'id'           => 'koelsch_settings_metabox',
		'title'        => esc_html__( 'Koelsch Settings', 'koelsch' ),
		'object_types' => array( 'options-page' ),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'koelsch_settings', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'myprefix' ), // Falls back to 'title' (above).
		// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'myprefix' ), // The text for the options-page save button. Defaults to 'Save'.
	) );

  /*
  * Options fields ids only need
  * to be unique within this box.
  * Prefix is not needed.
  */
  $group_field_id = $k_settings->add_field( array(
     'id'          => 'living_types',
     'type'        => 'group',
     'description' => __( 'Koelsch living types', 'koelsch' ),
     // 'repeatable'  => false, // use false if you want non-repeatable group
     'options'     => array(
         'group_title'       => __( 'Living Type {#}', 'koelsch' ), // since version 1.1.4, {#} gets replaced by row number
         'add_button'        => __( 'Add Living Type', 'koelsch' ),
         'remove_button'     => __( 'Remove Living Type', 'koelsch' ),
         'sortable'          => false,
         'closed'         => true, // true to have the groups closed by default
         // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
     ),
  ) );
  $k_settings->add_group_field( $group_field_id, array(
    'name' => 'Name',
    'id'   => 'name',
    'type' => 'text',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
  ) );
  $k_settings->add_group_field( $group_field_id, array(
    'name' => 'Slug/ID',
    'id'   => 'id',
    'type' => 'text',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
  ) );
  $k_settings->add_group_field( $group_field_id, array(
    'name'    => 'Individual Living Types',
    'desc'    => 'Check all the the living types that apply',
    'id'      => 'living_types',
    'type'    => 'multicheck',
    'select_all_button' => false,
    'options' => array(
        'IL' => 'Independent Living',
        'AL' => 'Assisted Living',
        'MC' => 'Memory Care',
    ),
) );
  $k_settings->add_group_field( $group_field_id, array(
    'name' => 'Seal',
    'id'   => 'seal',
    'type' => 'file',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
  ) );
  $k_settings->add_group_field( $group_field_id, array(
    'name'       => 'Living Type Footer Menu',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'menu',
    'type'       => 'select',
    'options'   => menu_select_options(),
    'show_option_none' => true,
  ) );
}
  ?>
