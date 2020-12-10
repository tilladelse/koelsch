<?php
add_action('acf/init', 'wp_acf_init_block_types');
function wp_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a toolbar block.
        acf_register_block_type(array(
            'name'              => 'toolbar',
            'title'             => __('Community Search Toolbar'),
            'render_template'   => 'lib/blocks/toolbar/toolbar.php',
            'category'          => 'koelsch',
            'icon'              => 'search',
            'keywords'          => array( 'toolbar', 'find' ),
        ));

        // register a communities list block.
        acf_register_block_type(array(
            'name'              => 'communities-list',
            'title'             => __('Communities by state list'),
            'render_template'   => 'lib/blocks/communities/communities-list.php',
            'category'          => 'koelsch',
            'icon'              => 'location',
            'keywords'          => array( 'communities', 'state' , 'list' ),
            'align'	          	=> 'full',
          	'supports'	        => array(
                  		'align'		=> array('wide', 'full'),
                  	)
        ));

        // register a communities block.
        acf_register_block_type(array(
            'name'              => 'communities',
            'title'             => __('Communities near me'),
            'render_template'   => 'lib/blocks/communities/communities.php',
            'category'          => 'koelsch',
            'icon'              => 'location',
            'keywords'          => array( 'communities' ),
            'align'	          	=> 'full',
          	'supports'	        => array(
                  		'align'		=> array('wide','full'),
                  	)
        ));

        // register a communities block.
        acf_register_block_type(array(
            'name'              => 'floorplan',
            'title'             => __('Floor Plan'),
            'render_template'   => 'lib/blocks/communities/floorplan.php',
            'category'          => 'koelsch',
            'icon'              => 'grid-view',
            'keywords'          => array( 'floorplans', 'floorplan', 'floor', 'plan' ),
            'align'	          	=> 'wide',
          	'supports'	        => array(
                  		'align'		=> array('wide','full'),
                  	)
        ));

    }
}
add_filter('acf/settings/save_json', 'koelsch_acf_json_save_point');

function koelsch_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/lib/blocks/acf';
    // return
    return $path;
}
