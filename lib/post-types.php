<?php

// Register Custom Post Type
function val_post_type() {

	/*********************
	MANIFESTO CPT
	*********************/
	$labels = array(
		'name'                => _x( 'Manifesto Items', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Manifesto Item', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Manifesto', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'Items', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'faq',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'manifesto', 'text_domain' ),
		'description'         => __( 'Valhalla\'s Manifesto (faq)', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'page-attributes', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-networking',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'manifesto', $args );


	/*********************
	PRESS RELEASE CPT
	*********************/
	$labels = array(
		'name'                => _x( 'Press Releases', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Press Release', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Press Releases', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'Press Releases', 'text_domain' ),
		'view_item'           => __( 'View Press Release', 'text_domain' ),
		'add_new_item'        => __( 'Add New Press Release', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'pr',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Press Release', 'text_domain' ),
		'description'         => __( 'Valhalla press releases', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'page-attributes', ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-aside',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'press_release', $args );

	/*********************
	IMAGE CPT
	*********************/
	$labels = array(
		'name'                => _x( 'Images', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Image', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Images', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Image:', 'text_domain' ),
		'all_items'           => __( 'Images', 'text_domain' ),
		'view_item'           => __( 'View Image', 'text_domain' ),
		'add_new_item'        => __( 'Add New Image', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Image', 'text_domain' ),
		'update_item'         => __( 'Update Image', 'text_domain' ),
		'search_items'        => __( 'Search Images', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'image',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Images', 'text_domain' ),
		'description'         => __( 'User submitted images', 'text_domain' ),
		'taxonomies'         	=> array('category', 'post_tag'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'page-attributes', 'thumbnail'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-image',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'image', $args );

	/*********************
	VIDEO CPT
	*********************/
	$labels = array(
		'name'                => _x( 'Videos', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Video', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Videos', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Video:', 'text_domain' ),
		'all_items'           => __( 'Videos', 'text_domain' ),
		'view_item'           => __( 'View Video', 'text_domain' ),
		'add_new_item'        => __( 'Add New Video', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Video', 'text_domain' ),
		'update_item'         => __( 'Update Video', 'text_domain' ),
		'search_items'        => __( 'Search Videos', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'video',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Videos', 'text_domain' ),
		'description'         => __( 'User submitted videos', 'text_domain' ),
		'taxonomies'         	=> array('category', 'post_tag'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'page-attributes', 'thumbnail'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-video',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'video', $args );

}

// Hook into the 'init' action
add_action( 'init', 'val_post_type', 0 );
