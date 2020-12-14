<?php
add_action('acf/init', 'wp_acf_init_block_types');
function wp_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a toolbar block.
        acf_register_block_type(array(
            'name'              => 'toolbar',
            'title'             => __('Toolbar'),
            'render_template'   => 'lib/blocks/toolbar/toolbar.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'toolbar', 'find' ),
        ));

        // register a communities list block.
        acf_register_block_type(array(
            'name'              => 'communities-list',
            'title'             => __('Communities by state list'),
            'render_template'   => 'lib/blocks/communities/communities-list.php',
            'category'          => 'formatting',
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
            'category'          => 'formatting',
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
            'category'          => 'formatting',
            'icon'              => 'grid-view',
            'keywords'          => array( 'floorplans', 'floorplan', 'floor', 'plan' ),
            'align'	          	=> 'wide',
          	'supports'	        => array(
                  		'align'		=> array('wide','full'),
                  	)
        ));
		
		
		/* new Content Blocks */
		
		acf_register_block_type( array(
			'name'				=> 'single_image_and_content',
			'title'				=> __('Single Image & Content'),
			'render_template'   => 'blocks/content-blocks/single_image_and_content.php',
			'category'          => 'formatting',
			'mode'              => 'edit',
            'icon'              => 'media-document',
            'keywords'          => array( 'image', 'content' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => true,
				'align' => array('left', 'right'),
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'content_area',
			'title'				=> __('Content Area'),
			'render_template'   => 'blocks/content-blocks/content_area.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
            'icon'              => 'layout',
            'keywords'          => array( 'content', 'area' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => true,
				'align_content' => array('top', 'center', 'bottom'),
				'align' => array('left', 'center', 'right'),
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'gold_line',
			'title'				=> __('Gold Line'),
			'render_template'   => 'blocks/content-blocks/gold_line.php',
			'category'          => 'formatting',
			'mode'              => 'edit',
            'icon'              => 'minus',
            'keywords'          => array( 'gold', 'line' ),
			'supports'			=> array(
				'align' => array('left', 'center', 'right'),
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'goldtitle',
			'title'				=> __('Gold Title'),
			'render_template'   => 'blocks/content-blocks/goldtitle.php',
			'category'          => 'formatting',
			'mode'              => 'edit',
            'icon'              => 'minus',
            'keywords'          => array( 'gold', 'title' ),
			'supports'			=> array(
				'align' => false,
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'button',
			'title'				=> __('Button'),
			'render_template'   => 'blocks/content-blocks/button.php',
			'category'          => 'formatting',
			'mode'              => 'edit',
            'icon'              => 'button',
			'align'	          	=> 'wide',
            'keywords'          => array( 'button' )
		));
		
		acf_register_block_type( array(
			'name'				=> 'image_with_caption',
			'title'				=> __('Image With Caption'),
			'render_template'   => 'blocks/content-blocks/image_with_caption.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
            'icon'              => 'cover-image',
            'keywords'          => array( 'image', 'caption' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => true,
				'align' => array('left', 'right'),
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'map',
			'title'				=> __('Map'),
			'render_template'   => 'blocks/content-blocks/map.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
            'icon'              => 'admin-site-alt3',
            'keywords'          => array( 'map' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => false,
				'align' => false,
			),
			'enqueue_style' => 'https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css',
			/*'enqueue_script' => 'https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js',*/
		));
		
		acf_register_block_type( array(
			'name'				=> 'subsection',
			'title'				=> __('Subsection'),
			'render_template'   => 'blocks/content-blocks/subsection.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
			'align'	          	=> false,
            'icon'              => 'cover-image',
            'keywords'          => array( 'image', 'caption' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => true
				)
		));
		
		acf_register_block_type( array(
			'name'				=> 'pv_slideshow',
			'title'				=> __('Photo & Video Slideshow'),
			'render_template'   => 'blocks/content-blocks/slideshow.php',
			'category'          => 'formatting',
			'mode'              => 'edit',
            'icon'              => 'images-alt2',
			'align'	          	=> 'wide',
            'keywords'          => array( 'photo', 'vodeo', 'slideshow' )
		));
		
		acf_register_block_type( array(
			'name'				=> 'masonry_images',
			'title'				=> __('Masonry Images'),
			'render_template'   => 'blocks/content-blocks/masonry_images.php',
			'category'          => 'formatting',
			'mode'              => 'edit',
            'icon'              => 'instagram',
			'align'	          	=> 'wide',
            'keywords'          => array( 'photo', 'vodeo', 'masonry', 'images' )
		));
		
		acf_register_block_type( array(
			'name'				=> 'image_and_content_set',
			'title'				=> __('Image & Content Set'),
			'render_template'   => 'blocks/content-blocks/image_and_content_set.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
            'icon'              => 'media-document',
            'keywords'          => array( 'image', 'content' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => true,
				'align' => array('left', 'right'),
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'main_image',
			'title'				=> __('Main Image & Content'),
			'render_template'   => 'blocks/content-blocks/main_image.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
            'icon'              => 'media-document',
            'keywords'          => array( 'image', 'content' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => true,
				'align' => false,
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'secondary_image',
			'title'				=> __('Secondary Image & Content'),
			'render_template'   => 'blocks/content-blocks/secondary_image.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
            'icon'              => 'media-document',
            'keywords'          => array( 'image', 'content' ),
			'supports'			=> array(
				'mode' => true,
				'jsx' => true,
				'align' => false,
			)
		));
		
		acf_register_block_type( array(
			'name'				=> 'conatiner',
			'title'				=> __('Container'),
			'render_template'   => 'blocks/content-blocks/conatiner.php',
			'category'          => 'formatting',
			'mode'              => 'preview',
            'icon'              => 'welcome-widgets-menus',
            'keywords'          => array( 'conatiner' ),
			'supports'			=> array(
				'mode' => false,
				'jsx' => true,
				'align' => false,
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
