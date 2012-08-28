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
		'add_new_item' => __('Add New Work')
	);
	
	$args = array(
		'labels' => $label,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'works', 'with_front' => false),
		'supports' => array('title', 'editor', 'thumbnail')
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
		'name' => __('Work Types'),
		'singular_name' => __('Work Type'),
		'add_new_item' => __('Add New Work Type')
	);
	
	register_taxonomy('work_type', array('work'), array(
		'labels' => $label,
        'hierarchical' =>true,  
        'show_ui' => true,  
        'rewrite' => array( 'slug' => 'work_types'),  
        'query_var' => true,  
        'show_in_nav_menus' => true,  
        'public' => true
	));
}
