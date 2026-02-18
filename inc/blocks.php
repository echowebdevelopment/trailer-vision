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
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// register blocks
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {

	$blocks = array(
		'usp-block',
		'advert-cta-block',
		'featured-category-block',
		'page-title-block',
		'photo-collage-block',
		'usps-block',
		'advert-feature-block',
		'photo-divider-block',
		'video-block',
		'faqs-block',
		'text-block',
		'text-image-block',
		'homepage-grid-block',
		'brand-range-block',
		'reviews-slider-block',
		'feature-products-slider-block',
		'contact-us-block',
		'blog-slider-feed-block',
		'page-introduction-block',
		'divider-block',
		'logo-block',
	);

	foreach ( $blocks as $block ) {
		register_block_type( get_stylesheet_directory() . '/templates/blocks/'.$block.'/block.json' );
	}
}
