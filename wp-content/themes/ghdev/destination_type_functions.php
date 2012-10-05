<?php 
add_action( 'init', 'create_destinations' );

function create_destinations(){
	$labels = array(
		'name' => _x('Destinations', 'post type general name'),
		'singular_name' => _x('Destination', 'post type singular name'),
		'add_new' => _x('Add New', 'Destination'),
		'add_new_item' => __('Add New Destination'),
		'edit_item' => __('Edit Destination'),
		'new_item' => __('New Destination'),
		'view_item' => __('View Destination'),
		'search_items' => __('Search Destinations'),
		'not_found' =>  __('No Destinations found'),
		'not_found_in_trash' => __('No Destinations found in Trash'),
		'parent_item_colon' => ''
	);
	$supports = array('title', 'editor', 'custom-fields', 'revisions', 'excerpt');

	register_post_type( 'event',
			array(
			'labels' => $labels,
			'public' => true,
			'supports' => $supports
		)
	);
}
 ?>