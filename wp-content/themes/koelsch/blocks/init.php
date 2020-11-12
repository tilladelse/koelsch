<?php
add_action('acf/init', 'wp_acf_init_block_types');
function wp_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a toolbar block.
        acf_register_block_type(array(
            'name'              => 'toolbar',
            'title'             => __('Toolbar'),
            'render_template'   => 'blocks/toolbar/toolbar.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'toolbar', 'find' ),
        ));

        // register a communities list block.
        acf_register_block_type(array(
            'name'              => 'communities-list',
            'title'             => __('Communities by state list'),
            'render_template'   => 'blocks/communities-list/communities-list.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'communities', 'state' , 'list' ),
        ));

        // register a communities block.
        acf_register_block_type(array(
            'name'              => 'communities',
            'title'             => __('Communities near me'),
            'render_template'   => 'blocks/communities/communities.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'communities' ),
        ));
        
    }
}