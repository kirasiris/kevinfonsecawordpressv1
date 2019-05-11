<?php
//========================= Taxonomy for Portfolio Custom Post Type ===========================//
 
function portfolio_categories_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $portfolio_cats = array(
    'name' => _x( 'Portfolio Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Portfolio Categories' ),
    'all_items' => __( 'All Portfolio Categories' ),
    'parent_item' => __( 'Parent Portfolio Category' ),
    'parent_item_colon' => __( 'Parent Portfolio Category:' ),
    'edit_item' => __( 'Edit Portfolio Category' ), 
    'update_item' => __( 'Update Portfolio Category' ),
    'add_new_item' => __( 'Add New Portfolio Category' ),
    'new_item_name' => __( 'New Portfolio Category' ),
    'menu_name' => __( 'Portfolio Categories' ),
  );    
 
// Now register the taxonomy
  register_taxonomy('portfolio_categories',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $portfolio_cats,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio_categories' ),
  ));
 
}
add_action( 'init', 'portfolio_categories_taxonomy', 0 );

//========================= Tags for Portfolio Custom Type ===========================//

function portfolio_tags_taxonomy() { 
// Labels part for the GUI
 
  $portfolio_tags = array(
    'name' => _x( 'Portfolio Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Portfolio Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Portfolio Tags' ),
    'popular_items' => __( 'Popular Portfolio Tags' ),
    'all_items' => __( 'All Portfolio Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Portfolio Tag' ), 
    'update_item' => __( 'Update Portfolio Tag' ),
    'add_new_item' => __( 'Add New Portfolio Tag' ),
    'new_item_name' => __( 'New Portfolio Tag Name' ),
    'separate_items_with_commas' => __( 'Separate portfolio tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove portfolio tags' ),
    'choose_from_most_used' => __( 'Choose from the most used portfolio tags' ),
    'menu_name' => __( 'Portfolio Tags' ),
  );
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('portfolio_tags',array('portfolio'),array(
    'hierarchical' => false,
    'labels' => $portfolio_tags,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio_tags' ),
  ));
}
add_action( 'init', 'portfolio_tags_taxonomy', 0 );

//========================= Taxonomy for Snippets Custom Type ===========================//

function snippets_categories_taxonomy() {
 
  $snippets_cats = array(
    'name' => _x( 'Snippets Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Snippet Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Snippet Categories' ),
    'all_items' => __( 'All Snippet Categories' ),
    'parent_item' => __( 'Parent Snippet Category' ),
    'parent_item_colon' => __( 'Parent Snippet Category:' ),
    'edit_item' => __( 'Edit Snippet Category' ), 
    'update_item' => __( 'Update Snippet Category' ),
    'add_new_item' => __( 'Add New Snippet Category' ),
    'new_item_name' => __( 'New Snippet Category' ),
    'menu_name' => __( 'Snippets Categories' ),
  );    
 
// Now register the taxonomy
  register_taxonomy('snippets_categories',array('snippets'), array(
    'hierarchical' => true,
    'labels' => $snippets_cats,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'snippets_categories' ),
  ));
 
}
add_action( 'init', 'snippets_categories_taxonomy', 0 );

//========================= Tags for Snippets Custom Type ===========================//

function snippets_tags_taxonomy() { 
// Labels part for the GUI
 
  $snippets_tags = array(
    'name' => _x( 'Snippets Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Snippet Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Snippet Tags' ),
    'popular_items' => __( 'Popular Snippet Tags' ),
    'all_items' => __( 'All Snippet Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Snippet Tag' ), 
    'update_item' => __( 'Update Snippet Tag' ),
    'add_new_item' => __( 'Add New Snippet Tag' ),
    'new_item_name' => __( 'New Snippet Tag Name' ),
    'separate_items_with_commas' => __( 'Separate snippets tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove snippets tags' ),
    'choose_from_most_used' => __( 'Choose from the most used snippets tags' ),
    'menu_name' => __( 'Snippet Tags' ),
  );
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('snippets_tags',array('snippets'),array(
    'hierarchical' => false,
    'labels' => $snippets_tags,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'snippet_tags' ),
  ));
}
add_action( 'init', 'snippets_tags_taxonomy', 0 );
?>