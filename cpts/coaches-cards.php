<?php

add_action( 'init', 'start_register_coaches_post_type' );
/**
 * Register a Coach post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function start_register_coaches_post_type() {
	$labels = array(
		'name'               => _x( 'Coaches', 'post type general name', 'startinno' ),
		'singular_name'      => _x( 'Coach', 'post type singular name', 'startinno' ),
		'menu_name'          => _x( 'Coaches', 'admin menu', 'startinno' ),
		'name_admin_bar'     => _x( 'Coach', 'add new on admin bar', 'startinno' ),
		'add_new'            => _x( 'Add New Coach', 'Coach', 'startinno' ),
		'add_new_item'       => __( 'Add New Coach', 'startinno' ),
		'new_item'           => __( 'New Coach', 'startinno' ),
		'edit_item'          => __( 'Edit Coach', 'startinno' ),
		'view_item'          => __( 'View Coach', 'startinno' ),
		'all_items'          => __( 'All Coaches', 'startinno' ),
		'search_items'       => __( 'Search Coaches', 'startinno' ),
		'parent_item_colon'  => __( 'Parent Coaches:', 'startinno' ),
		'not_found'          => __( 'No Coaches found.', 'startinno' ),
		'not_found_in_trash' => __( 'No Coaches found in Trash.', 'startinno' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'startinno' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'coach' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => 9,
		'menu_icon'			 => 'dashicons-admin-users',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'coach', $args );
}
