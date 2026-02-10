<?php
/**********************************************************
 *
 * File:         Custom Post Types
 * Description:  Register the custom post types
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

add_action('init', function () {
	register_post_type('echo_reviews', array(
		'labels' => array(
			'name' => 'Reviews',
			'singular_name' => 'Review',
			'menu_name' => 'Reviews',
			'all_items' => 'All Reviews',
			'edit_item' => 'Edit Review',
			'view_item' => 'View Review',
			'view_items' => 'View Reviews',
			'add_new_item' => 'Add New Review',
			'new_item' => 'New Review',
			'parent_item_colon' => 'Parent Review:',
			'search_items' => 'Search Reviews',
			'not_found' => 'No Reviews found',
			'not_found_in_trash' => 'No Reviews found in the bin',
			'archives' => 'Review Archives',
			'attributes' => 'Review Attributes',
			'insert_into_item' => 'Insert into Review',
			'uploaded_to_this_item' => 'Uploaded to this Review',
			'filter_items_list' => 'Filter Reviews list',
			'filter_by_date' => 'Filter Reviews by date',
			'items_list_navigation' => 'Reviews list navigation',
			'items_list' => 'Reviews list',
			'item_published' => 'Review published.',
			'item_published_privately' => 'Review published privately.',
			'item_reverted_to_draft' => 'Review reverted to draft.',
			'item_scheduled' => 'Review scheduled.',
			'item_updated' => 'Review updated.',
			'item_link' => 'Review Link',
			'item_link_description' => 'A link to a Review.',
		),
		'public' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-star-half',
		'supports' => array(
			0 => 'title',
			1 => 'excerpt',
			2 => 'editor',
			3 => 'thumbnail',
		),
		'has_archive' => 'Reviews',
		'rewrite' => array(
			'slug' => 'reviews',
			'with_front' => false,
			'pages' => false,
		),
		'can_export' => false,
		'delete_with_user' => false,
	));

	register_post_type( 'additional_content', array(
		'labels' => array(
			'name' => 'Additional Content',
			'singular_name' => 'Additional Content',
			'menu_name' => 'Additional Content',
			'all_items' => 'All Additional Content',
			'edit_item' => 'Edit Additional Content',
			'view_item' => 'View Additional Content',
			'view_items' => 'View Additional Content',
			'add_new_item' => 'Add New Additional Content',
			'add_new' => 'Add New Additional Content',
			'new_item' => 'New Additional Content',
			'parent_item_colon' => 'Parent Additional Content:',
			'search_items' => 'Search Additional Content',
			'not_found' => 'No Additional Content found',
			'not_found_in_trash' => 'No Additional Content found in the bin',
			'archives' => 'Additional Content Archives',
			'attributes' => 'Additional Content Attributes',
			'insert_into_item' => 'Insert into Additional Content',
			'uploaded_to_this_item' => 'Uploaded to this Additional Content',
			'filter_items_list' => 'Filter Additional Content list',
			'filter_by_date' => 'Filter Additional Content by date',
			'items_list_navigation' => 'Additional Content list navigation',
			'items_list' => 'Additional Content list',
			'item_published' => 'Additional Content published.',
			'item_published_privately' => 'Additional Content published privately.',
			'item_reverted_to_draft' => 'Additional Content reverted to draft.',
			'item_scheduled' => 'Additional Content scheduled.',
			'item_updated' => 'Additional Content updated.',
			'item_link' => 'Additional Content Link',
			'item_link_description' => 'A link to a Additional Content.',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-welcome-add-page',
		'supports' => array(
			0 => 'title',
			1 => 'editor',
			2 => 'custom-fields',
		),
		'has_archive' => false,
		'rewrite' => array(
			'with_front' => false,
			'feeds' => false,
		),
		'delete_with_user' => false,
	));

	// register_post_type('echo_faqs', array(
	// 	'labels' => array(
	// 		'name' => 'FAQs',
	// 		'singular_name' => 'FAQ',
	// 		'menu_name' => 'FAQs',
	// 		'all_items' => 'All FAQs',
	// 		'edit_item' => 'Edit FAQ',
	// 		'view_item' => 'View FAQ',
	// 		'view_items' => 'View FAQs',
	// 		'add_new_item' => 'Add New FAQ',
	// 		'new_item' => 'New FAQ',
	// 		'parent_item_colon' => 'Parent FAQ:',
	// 		'search_items' => 'Search FAQs',
	// 		'not_found' => 'No FAQs found',
	// 		'not_found_in_trash' => 'No FAQs found in the bin',
	// 		'archives' => 'FAQ Archives',
	// 		'attributes' => 'FAQ Attributes',
	// 		'insert_into_item' => 'Insert into FAQ',
	// 		'uploaded_to_this_item' => 'Uploaded to this FAQ',
	// 		'filter_items_list' => 'Filter FAQs list',
	// 		'filter_by_date' => 'Filter FAQs by date',
	// 		'items_list_navigation' => 'FAQs list navigation',
	// 		'items_list' => 'FAQs list',
	// 		'item_published' => 'FAQ published.',
	// 		'item_published_privately' => 'FAQ published privately.',
	// 		'item_reverted_to_draft' => 'FAQ reverted to draft.',
	// 		'item_scheduled' => 'FAQ scheduled.',
	// 		'item_updated' => 'FAQ updated.',
	// 		'item_link' => 'FAQ Link',
	// 		'item_link_description' => 'A link to a FAQ.',
	// 	),
	// 	'public' => true,
	// 	'exclude_from_search' => true,
	// 	'show_in_nav_menus' => false,
	// 	'show_in_rest' => true,
	// 	'menu_icon' => 'dashicons-align-left',
	// 	'supports' => array(
	// 		0 => 'title',
	// 		1 => 'excerpt',
	// 		2 => 'editor',
	// 		3 => 'thumbnail',
	// 	),
	// 	'has_archive' => 'faqs',
	// 	'rewrite' => array(
	// 		'slug' => 'faqs',
	// 		'with_front' => false,
	// 		'pages' => false,
	// 	),
	// 	'can_export' => false,
	// 	'delete_with_user' => false,
	// ));

});

