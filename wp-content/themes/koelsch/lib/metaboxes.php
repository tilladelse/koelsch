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
      'desc'       => __( 'Recommended image size is 120px high', 'koelsch' ),
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

  /*
  * Floorplans Metabox
   */
  add_action( 'cmb2_init', 'koelsch_register_floorplans_metaboxes' );

  function koelsch_register_floorplans_metaboxes() {
    $fp = new_cmb2_box( array(
      'id'            => 'floorplan_details',
      'title'         => __( 'Floor Plan Details', 'koelsch' ),
      'object_types'  => array( 'floorplans'), // Post type
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true, // Show field names on the left
      // 'cmb_styles' => false, // false to disable the CMB stylesheet
      // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $fp->add_field( array(
      'name'       => __( 'Floor Plan Display Name', 'koelsch' ),
      'desc'       => __( 'This is the name that will display on the front end of the website', 'koelsch' ),
      'id'         => 'display_name',
      'type'       => 'text',
    ) );
    $fp->add_field( array(
      'name'       => __( 'Number Of Bedrooms', 'koelsch' ),
      // 'desc'       => __( 'Community main contact number', 'koelsch' ),
      'id'         => 'bedrooms',
      'type'       => 'select',
      'options'   => array('Studio','1','2','3','4'),
      'show_option_none' => true,
    ) );
    $fp->add_field( array(
      'name'       => __( 'Number Of Bathrooms', 'koelsch' ),
      // 'desc'       => __( 'Community main contact number', 'koelsch' ),
      'id'         => 'bathrooms',
      'type'       => 'select',
      'options'   => array('1','1.5','2','2.5'),
      'show_option_none' => true,
    ) );
    $fp->add_field( array(
      'name'       => __( 'Square Feet', 'koelsch' ),
      // 'desc'       => __( 'Street Address', 'koelsch' ),
      'id'         => 'sf',
      'type'       => 'text_small',
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

  //Koelsch address
  $address = $k_settings->add_field( array(
     'id'          => 'address',
     'type'        => 'group',
     'description' => __( 'Koelsch home office info', 'koelsch' ),
     'repeatable'  => false, // use false if you want non-repeatable group
     'options'     => array(
         'closed'  => false,
     ),
  ) );
  $k_settings->add_group_field( $address, array(
    'name'       => 'Company Name',
    'default'       => __( 'Koelsch Communities', 'koelsch' ),
    'id'         => 'company_name',
    'type'       => 'text',
  ) );
  $k_settings->add_group_field( $address, array(
    'name'       => 'Street Address',
    //'desc'       => __( 'Home office Street Address', 'koelsch' ),
    'id'         => 'street',
    'type'       => 'text',
  ) );
  $k_settings->add_group_field( $address, array(
    'name'       => 'Street Address 2',
    //'desc'       => __( 'Home office Street Address', 'koelsch' ),
    'id'         => 'street_2',
    'type'       => 'text',
  ) );
  $k_settings->add_group_field( $address, array(
    'name'       => __( 'City', 'koelsch' ),
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'city',
    'type'       => 'text_medium',
  ) );

  $k_settings->add_group_field( $address, array(
    'name'       => __( 'State', 'koelsch' ),
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'state',
    'type'       => 'select',
    'options'   => STATES_LIST,
    'show_option_none' => true,
  ) );

  $k_settings->add_group_field( $address, array(
    'name'       => __( 'Zipcode', 'koelsch' ),
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'zipcode',
    'type'       => 'text_small',
  ) );

  $k_settings->add_group_field( $address, array(
    'name'       => __( 'Phone', 'koelsch' ),
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'phone',
    'type'       => 'text_medium',
  ) );

  $k_settings->add_group_field( $address, array(
    'name'       => __( 'Contact Email', 'koelsch' ),
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'email',
    'type'       => 'text_email',
  ) );

  /*
  * Options fields ids only need
  * to be unique within this box.
  * Prefix is not needed.
  */
  $living_types = $k_settings->add_field( array(
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
  $k_settings->add_group_field( $living_types, array(
    'name' => 'Name',
    'id'   => 'name',
    'type' => 'text',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
  ) );
  $k_settings->add_group_field( $living_types, array(
    'name' => 'Slug/ID',
    'id'   => 'id',
    'type' => 'text',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
  ) );
  $k_settings->add_group_field( $living_types, array(
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
  $k_settings->add_group_field( $living_types, array(
    'name' => 'Seal',
    'id'   => 'seal_url',
    'type' => 'file',
    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
  ) );
  $k_settings->add_group_field( $living_types, array(
    'name'       => 'Resources Footer Menu',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'resources_menu_id',
    'type'       => 'select',
    'options'   => menu_select_options(),
    'show_option_none' => true,
  ) );


  //page settings
  $pages = $k_settings->add_field( array(
     'id'          => 'page_settings',
     'type'        => 'group',
     'description' => __( 'Page settings', 'koelsch' ),
     'repeatable'  => false, // use false if you want non-repeatable group
     'options'     => array(
         'closed'  => false,
     ),
  ) );
  $k_settings->add_group_field($pages, array(
    'name'       => 'Resources Page',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'resources_page',
    'type'       => 'select',
    'options'   => koelsch_pages_list(),
    'show_option_none' => true,
  ));
  $k_settings->add_group_field($pages, array(
    'name'       => 'Find A Community Page',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'find_community_page',
    'type'       => 'select',
    'options'   => koelsch_pages_list(),
    'show_option_none' => true,
  ));
  $k_settings->add_group_field($pages, array(
    'name'       => 'Careers Page',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'careers_page',
    'type'       => 'select',
    'options'   => koelsch_pages_list(),
    'show_option_none' => true,
  ));
  $k_settings->add_group_field($pages, array(
    'name'       => 'Independent Living Page',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'IL_page',
    'type'       => 'select',
    'options'   => koelsch_pages_list(),
    'show_option_none' => true,
  ));
  $k_settings->add_group_field($pages, array(
    'name'       => 'Assisted Living Page',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'AL_page',
    'type'       => 'select',
    'options'   => koelsch_pages_list(),
    'show_option_none' => true,
  ));
  $k_settings->add_group_field($pages, array(
    'name'       => 'Memory Care Page',
    // 'desc'       => __( 'Street Address', 'koelsch' ),
    'id'         => 'MC_page',
    'type'       => 'select',
    'options'   => koelsch_pages_list(),
    'show_option_none' => true,
  ));

}
/*
* General metaboxes
 */
add_action( 'cmb2_init', 'koelsch_register_general_metaboxes' );
function koelsch_register_general_metaboxes() {
  $featuredVid = new_cmb2_box( array(
    'id'            => 'page_options',
    'title'         => __( 'Page Options', 'koelsch' ),
    'object_types'  => array( 'page' ), // Post type
    'context'       => 'normal',
    'priority'      => 'default',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
  ) );
  $featuredVid->add_field( array(
    'name'       => 'Featured Video URL',
    'id'         => 'featured_video',
    'type' => 'file',
  ) );
}

/**
 * Gutenberg Block Fields
 */

 if( function_exists('acf_add_local_field_group') ):

 acf_add_local_field_group(array(
 	'key' => 'group_5fa928df03a5c',
 	'title' => 'Communities',
 	'fields' => array(
 		array(
 			'key' => 'field_5fa9290b74f04',
 			'label' => 'Title',
 			'name' => 'title',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => 'Communities Near you',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 	),
 	'location' => array(
 		array(
 			array(
 				'param' => 'block',
 				'operator' => '==',
 				'value' => 'acf/communities',
 			),
 		),
 	),
 	'menu_order' => 0,
 	'position' => 'normal',
 	'style' => 'default',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 	'active' => true,
 	'description' => '',
 	'modified' => 1604933492,
 ));

 acf_add_local_field_group(array(
 	'key' => 'group_5fa932fcd1bd1',
 	'title' => 'Communities list',
 	'fields' => array(
 		array(
 			'key' => 'field_5fa9330995826',
 			'label' => 'Title',
 			'name' => 'title',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array(
 			'key' => 'field_5fa9331495827',
 			'label' => 'Description list',
 			'name' => 'description_list',
 			'type' => 'repeater',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'collapsed' => '',
 			'min' => 0,
 			'max' => 0,
 			'layout' => 'table',
 			'button_label' => '',
 			'sub_fields' => array(
 				array(
 					'key' => 'field_5fa9333095828',
 					'label' => 'Abbreviation',
 					'name' => 'abbreviation',
 					'type' => 'text',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'maxlength' => '',
 				),
 				array(
 					'key' => 'field_5fa9333d95829',
 					'label' => 'Text',
 					'name' => 'text',
 					'type' => 'text',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'default_value' => '',
 					'placeholder' => '',
 					'prepend' => '',
 					'append' => '',
 					'maxlength' => '',
 				),
 			),
 		),
 		array(
 			'key' => 'field_5fa9334f9582a',
 			'label' => 'Column',
 			'name' => 'column',
 			'type' => 'repeater',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'collapsed' => '',
 			'min' => 0,
 			'max' => 0,
 			'layout' => 'table',
 			'button_label' => 'Add Column',
 			'sub_fields' => array(
 				array(
 					'key' => 'field_5fa9335b9582b',
 					'label' => 'List',
 					'name' => 'list',
 					'type' => 'repeater',
 					'instructions' => '',
 					'required' => 0,
 					'conditional_logic' => 0,
 					'wrapper' => array(
 						'width' => '',
 						'class' => '',
 						'id' => '',
 					),
 					'collapsed' => '',
 					'min' => 0,
 					'max' => 0,
 					'layout' => 'block',
 					'button_label' => 'Add list',
 					'sub_fields' => array(
 						array(
 							'key' => 'field_5fa933919582d',
 							'label' => 'State',
 							'name' => 'state',
 							'type' => 'select',
 							'instructions' => '',
 							'required' => 0,
 							'conditional_logic' => 0,
 							'wrapper' => array(
 								'width' => '',
 								'class' => '',
 								'id' => '',
 							),
 							'choices' => array(
 								'Arizona' => 'Arizona',
 								'Texas' => 'Texas',
 								'Washington' => 'Washington',
 								'Montana' => 'Montana',
 								'California' => 'California',
 								'Idaho' => 'Idaho',
 								'Illinois' => 'Illinois',
 								'Colorado' => 'Colorado',
 							),
 							'default_value' => 'Arizona',
 							'allow_null' => 0,
 							'multiple' => 0,
 							'ui' => 0,
 							'return_format' => 'value',
 							'ajax' => 0,
 							'placeholder' => '',
 						),
 					),
 				),
 			),
 		),
 	),
 	'location' => array(
 		array(
 			array(
 				'param' => 'block',
 				'operator' => '==',
 				'value' => 'acf/communities-list',
 			),
 		),
 	),
 	'menu_order' => 0,
 	'position' => 'normal',
 	'style' => 'default',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 	'active' => true,
 	'description' => '',
 	'modified' => 1604933513,
 ));

 acf_add_local_field_group(array(
 	'key' => 'group_5fc82cf7cc860',
 	'title' => 'Floor Plan Settings',
 	'fields' => array(
 		array(
 			'key' => 'field_5fc82d43a6b17',
 			'label' => 'Choose Floor Plan',
 			'name' => 'floorplan_id',
 			'type' => 'select',
 			'instructions' => 'Choose the floorplan to display.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'choices' => array(
 				0 => 'Choose One',
 				1575 => 'Memory Care "P" Style 1 Bed, 1 Bath',
 			),
 			'default_value' => false,
 			'allow_null' => 0,
 			'multiple' => 0,
 			'ui' => 0,
 			'return_format' => 'value',
 			'ajax' => 0,
 			'placeholder' => '',
 		),
 	),
 	'location' => array(
 		array(
 			array(
 				'param' => 'block',
 				'operator' => '==',
 				'value' => 'acf/floorplan',
 			),
 		),
 	),
 	'menu_order' => 0,
 	'position' => 'normal',
 	'style' => 'default',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 	'active' => true,
 	'description' => '',
 ));

 acf_add_local_field_group(array(
 	'key' => 'group_5fa9106b192e2',
 	'title' => 'Toolbar',
 	'fields' => array(
 		array(
 			'key' => 'field_5fa94bee68120',
 			'label' => 'Title',
 			'name' => 'title',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array(
 			'key' => 'field_5fa94bda6811f',
 			'label' => 'Page for search',
 			'name' => 'page_for_search',
 			'type' => 'page_link',
 			'instructions' => '',
 			'required' => 1,
 			'conditional_logic' => 0,
 			'wrapper' => array(
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'post_type' => array(
 				0 => 'page',
 			),
 			'taxonomy' => '',
 			'allow_null' => 0,
 			'allow_archives' => 0,
 			'multiple' => 0,
 		),
 	),
 	'location' => array(
 		array(
 			array(
 				'param' => 'block',
 				'operator' => '==',
 				'value' => 'acf/toolbar',
 			),
 		),
 	),
 	'menu_order' => 0,
 	'position' => 'normal',
 	'style' => 'default',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 	'active' => true,
 	'description' => '',
 	'modified' => 1604933485,
 ));

 endif;
  ?>
