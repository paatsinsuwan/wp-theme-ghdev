<?php
/**
 * add Works post type
 *
 * @author Paat Sinsuwan
 */
add_action('init', 'custom_coll_type');
function custom_coll_type(){
	$label = array(
		'name' => __('Collaborators'),
		'singular_name' => __('Collaborator'),
		'add_new' => _x('Add New', 'Collaborator'),
		'add_new_item' => __('Add New Collaborator'),
		'edit_item' => __('Edit Collaborator'),
		'new_item' => __('New Collaborator'),
		'view_item' => __('View Collaborator'),
		'search_items' => __('Search Collaborators'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash')
	);
	
	$args = array(
		'labels' => $label,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 6,
		'query_var' => true,
		'has_archive' => 'collaborators',
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
	);
	register_post_type('collaborator', $args);
}