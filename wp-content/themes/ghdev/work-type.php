<?php
/**
 * add Works post type
 *
 * @author Paat Sinsuwan
 */
add_action('init', 'custom_work_type');
function custom_work_type(){
	$label = array(
		'name' => __('Works'),
		'singular_name' => __('Work'),
		'add_new' => _x('Add New', 'Work'),
		'add_new_item' => __('Add New Work'),
		'edit_item' => __('Edit Work'),
		'new_item' => __('New Work'),
		'view_item' => __('View Work '),
		'search_items' => __('Search Works'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash')
	);
	
	$args = array(
		'labels' => $label,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'query_var' => true,
		'has_archive' => 'works',
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
	);
	register_post_type('work', $args);
}

/**
 * add Work_types taxonomy
 *
 * @author Paat Sinsuwan
 */
add_action('init', 'custom_taxonomy_work_types');
function custom_taxonomy_work_types(){
	$label = array(
		'name' => __('Work Types', 'taxonomy general name'),
		'singular_name' => __('Work Type', 'taxonomy singular name'),
		'search_items' =>  __( 'Search Work Types' ),
		'popular_items' => __( 'Popular Work Types' ),
		'all_items' => __( 'All Work Types' ),
		'edit_item' => __( 'Edit Work Type' ),
		'update_item' => __( 'Update Work Type' ),
		'add_new_item' => __( 'Add New Work Type' ),
		'new_item_name' => __( 'New Work Type Name' ),
		'separate_items_with_commas' => __( 'Separate work types with commas' ),
		'add_or_remove_items' => __( 'Add or remove work types' ),
		'choose_from_most_used' => __( 'Choose from the most used work types' )
	);
	
	register_taxonomy(
		'work_type', 
		array('work'), 
		array(
			'labels' => $label,
        	'hierarchical' =>true,  
        	'show_ui' => true,  
        	'rewrite' => array( 
				'slug' => 'work_type'
				),  
        	'query_var' => true,  
        	'show_in_nav_menus' => true,  
        	'public' => true,
	));
}
