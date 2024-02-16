<?php

/**
 * Chapter post type
 */
function chapter_post_type() {

	$labels = array(
		'name'                  => _x( 'Chapters', 'Post Type General Name', 'ptpi' ),
		'singular_name'         => _x( 'Chapter', 'Post Type Singular Name', 'ptpi' ),
		'menu_name'             => __( 'Chapters', 'ptpi' ),
		'name_admin_bar'        => __( 'Chapter', 'ptpi' ),
		'archives'              => __( 'Chapter Archives', 'ptpi' ),
		'attributes'            => __( 'Chapter Attributes', 'ptpi' ),
		'parent_item_colon'     => __( 'Parent Chapter:', 'ptpi' ),
		'all_items'             => __( 'All Chapters', 'ptpi' ),
		'add_new_item'          => __( 'Add New Chapter', 'ptpi' ),
		'add_new'               => __( 'Add New', 'ptpi' ),
		'new_item'              => __( 'New Chapter', 'ptpi' ),
		'edit_item'             => __( 'Edit Chapter', 'ptpi' ),
		'update_item'           => __( 'Update Chapter', 'ptpi' ),
		'view_item'             => __( 'View Chapter', 'ptpi' ),
		'view_items'            => __( 'View Chapters', 'ptpi' ),
		'search_items'          => __( 'Search Chapter', 'ptpi' ),
		'not_found'             => __( 'Not found', 'ptpi' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'ptpi' ),
		'featured_image'        => __( 'Featured Image', 'ptpi' ),
		'set_featured_image'    => __( 'Set featured image', 'ptpi' ),
		'remove_featured_image' => __( 'Remove featured image', 'ptpi' ),
		'use_featured_image'    => __( 'Use as featured image', 'ptpi' ),
		'insert_into_item'      => __( 'Insert into Chapter', 'ptpi' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Chapter', 'ptpi' ),
		'items_list'            => __( 'Chapters list', 'ptpi' ),
		'items_list_navigation' => __( 'Chapters list navigation', 'ptpi' ),
		'filter_items_list'     => __( 'Filter Chapters list', 'ptpi' ),
    );

	$args = array(
		'label'                 => __( 'Chapter', 'ptpi' ),
		'description'           => __( 'PTPI Chapters', 'ptpi' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-editor-ul',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'rewrite'				=> array( 'slug' => 'Chapters' ),
		'has_archive'           => 'chapters-archive',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'chapter', $args );

}
add_action( 'init', 'chapter_post_type', 0 );
