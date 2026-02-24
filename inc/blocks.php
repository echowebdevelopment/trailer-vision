<?php
/**********************************************************
 *
 * File:         Blocks
 * Description:  ACF blocks function call
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/01/24
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

// register blocks
add_action('init', 'register_acf_blocks');
function register_acf_blocks()
{

	$blocks = array(
		'advert-cta-block',
		'advert-feature-block',
		'blog-slider-feed-block',
		'contact-us-block',
		'divider-block',
		'downloads-area-block',
		'faqs-block',
		'feature-products-slider-block',
		'featured-category-block',
		'find-us-block',
		'homepage-slider-block',
		'logo-block',
		'map-block',
		'newsletter-block',
		'page-introduction-block',
		'page-title-block',
		'photo-gallery-block',
		'reviews-slider-block',
		'social-feed-block',
		'text-block',
		'text-image-block',
		'usp-block',
	);

	foreach ($blocks as $block) {
		register_block_type(get_stylesheet_directory() . '/templates/blocks/' . $block . '/block.json');
	}
}
