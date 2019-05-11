<?php
function custom_portfolio_type() {
// Set UI labels for Custom Post Type
    $portfolio_labels = array(
        'name'                => _x( 'Portfolios', 'Post Type General Name', 'kevinurielfonseca' ),
        'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'kevinurielfonseca' ),
        'menu_name'           => __( 'Portfolios', 'kevinurielfonseca' ),
		'name_admin_bar'        => __( 'Portfolio', 'kevinurielfonseca' ),
		'archives'              => __( 'Portfolio Archives', 'kevinurielfonseca' ),
		'attributes'            => __( 'Portfolio Attributes', 'kevinurielfonseca' ),
        'parent_item_colon'   => __( 'Parent Portfolio', 'kevinurielfonseca' ),
        'all_items'           => __( 'All Portfolios', 'kevinurielfonseca' ),
        'add_new_item'        => __( 'Add New Portfolio', 'kevinurielfonseca' ),
        'add_new'             => __( 'Add Portfolio', 'kevinurielfonseca' ),
		'new_item'              => __( 'New Item', 'kevinurielfonseca' ),
        'edit_item'           => __( 'Edit Portfolio', 'kevinurielfonseca' ),
        'update_item'         => __( 'Update Portfolio', 'kevinurielfonseca' ),
        'view_item'           => __( 'View Portfolio', 'kevinurielfonseca' ),
		'view_items'           => __( 'View Portfolios', 'kevinurielfonseca' ),
        'search_items'        => __( 'Search Portfolio', 'kevinurielfonseca' ),
        'not_found'           => __( 'Not Found', 'kevinurielfonseca' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'kevinurielfonseca' ),
		'featured_image'        => __( 'Featured Image', 'kevinurielfonseca' ),
		'set_featured_image'    => __( 'Set featured image', 'kevinurielfonseca' ),
		'remove_featured_image' => __( 'Remove featured image', 'kevinurielfonseca' ),
		'use_featured_image'    => __( 'Use as featured image', 'kevinurielfonseca' ),
		'insert_into_item'      => __( 'Insert into item', 'kevinurielfonseca' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'kevinurielfonseca' ),
		'items_list'            => __( 'Items list', 'kevinurielfonseca' ),
		'items_list_navigation' => __( 'Items list navigation', 'kevinurielfonseca' ),
		'filter_items_list'     => __( 'Filter items list', 'kevinurielfonseca' ),
);
     
// Set other options for Custom Post Type
     
    $portfolio_args = array(
        'label'               => __( 'portfolios', 'kevinurielfonseca' ),
        'description'         => __( 'Portfolio Templates and Snippets', 'kevinurielfonseca' ),
        'labels'              => $portfolio_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions','post-formats'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'portfolio_categories'),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
		'menu_icon' => 'dashicons-format-gallery',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'portfolio', $portfolio_args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_portfolio_type', 0 );
?>
<?php /********************************************* Custom Snippets Post Type ***************************************************************************/ ?>
<?php
function custom_snippets_type() {
// Set UI labels for Custom Post Type
    $snippets_labels = array(
        'name'                => _x( 'Snippets', 'Post Type General Name', 'kevinurielfonseca' ),
        'singular_name'       => _x( 'Snippet', 'Post Type Singular Name', 'kevinurielfonseca' ),
        'menu_name'           => __( 'Snippets', 'kevinurielfonseca' ),
		'name_admin_bar'        => __( 'Snippet', 'kevinurielfonseca' ),
		'archives'              => __( 'Snippet Archives', 'kevinurielfonseca' ),
		'attributes'            => __( 'Snippet Attributes', 'kevinurielfonseca' ),
        'parent_item_colon'   => __( 'Parent Snippet', 'kevinurielfonseca' ),
        'all_items'           => __( 'All Snippets', 'kevinurielfonseca' ),
        'add_new_item'        => __( 'Add New Snippet', 'kevinurielfonseca' ),
        'add_new'             => __( 'Add Snippet', 'kevinurielfonseca' ),
		'new_item'              => __( 'New Snippet', 'kevinurielfonseca' ),
        'edit_item'           => __( 'Edit Snippet', 'kevinurielfonseca' ),
        'update_item'         => __( 'Update Snippets', 'kevinurielfonseca' ),
        'view_item'           => __( 'View Snippet', 'kevinurielfonseca' ),
		'view_items'           => __( 'View Snippets', 'kevinurielfonseca' ),		
		'search_items'        => __( 'Search Snippets', 'kevinurielfonseca' ),
        'not_found'           => __( 'Not Found', 'kevinurielfonseca' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'kevinurielfonseca' ),
		'featured_image'        => __( 'Featured Image', 'kevinurielfonseca' ),
		'set_featured_image'    => __( 'Set featured image', 'kevinurielfonseca' ),
		'remove_featured_image' => __( 'Remove featured image', 'kevinurielfonseca' ),
		'use_featured_image'    => __( 'Use as featured image', 'kevinurielfonseca' ),
		'insert_into_item'      => __( 'Insert into item', 'kevinurielfonseca' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'kevinurielfonseca' ),
		'items_list'            => __( 'Items list', 'kevinurielfonseca' ),
		'items_list_navigation' => __( 'Items list navigation', 'kevinurielfonseca' ),
		'filter_items_list'     => __( 'Filter items list', 'kevinurielfonseca' ),
);
     
// Set other options for Custom Post Type
     
    $snippets_args = array(
        'label'               => __( 'snippets', 'kevinurielfonseca' ),
        'description'         => __( 'Snippets Tricks', 'kevinurielfonseca' ),
        'labels'              => $snippets_labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions','post-formats'  ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'snippets_categories' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
		'menu_icon' => 'dashicons-editor-code',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'snippets', $snippets_args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_snippets_type', 0 );
?>