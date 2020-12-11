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

        // register a floorplan block.
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

        acf_register_block_type(array(
            'name'              => 'round-image',
            'title'             => __('Round Image'),
            'render_template'   => 'lib/blocks/layout/round-image.php',
            'category'          => 'koelsch',
            'icon'              => 'format-image',
            'keywords'          => array( 'image', 'images', 'circle', 'round' ),
            'align'	          	=> 'wide',
            'supports'	        => array(
                      'align'		=> false,
                    )
        ));

        acf_register_block_type(array(
            'name'              => 'icons',
            'title'             => __('Seals & Marks'),
            'render_template'   => 'lib/blocks/layout/koelsch-seals.php',
            'category'          => 'koelsch',
            'icon'              => 'superhero',
            'keywords'          => array( 'icon', 'badge', 'svg' ),
            'align'	          	=> 'wide',
            'supports'	        => array(
                      'align'		=> false,
                    )
        ));

        acf_register_block_type(array(
            'name'              => 'article-listing',
            'title'             => __('Article Listing'),
            'render_template'   => 'lib/blocks/layout/article-listing.php',
            'category'          => 'koelsch',
            'icon'              => 'format-aside',
            'keywords'          => array( 'icon', 'badge', 'svg' ),
            'align'	          	=> 'wide',
            'supports'	        => array(
                      'align'		=> false,
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
