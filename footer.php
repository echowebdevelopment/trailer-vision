<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('echo_container_type');

$auxClass = "move-right";

if (is_front_page()) {
	$auxClass = "move-left";
}

?>

<a href="/contact/" class="floating-link">
	<div class="floating-btn <?php echo $auxClass ?>">
		<div class="floating-text-icon">
			<div>
				<p class="mb-0 main">Need advice?</p>
				<p class="mb-0 small">We’re here to help you</p>
			</div>
			<i class="icon-customer-service"></i>
		</div>
		<span class="btn btn-transparent btn-arrow-right">
			Get in touch
		</span>
	</div>
</a>

<footer class="site-footer block border-top-green" id="site-footer">

	<div class="site-footer__primary block--padded-md">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row">
				<div class="site-footer__logo col-12 col-lg-3 block--padded-sm">
					<?php dynamic_sidebar('footer-col-1'); ?>
				</div>
				<div class="site-footer__menu col-12 col-md-4 col-lg-2 block--padded-sm">
					<?php dynamic_sidebar('footer-col-2'); ?>
				</div>
				<div class="site-footer__menu col-12 col-md-4 col-lg-2 block--padded-sm">
					<?php dynamic_sidebar('footer-col-3'); ?>
				</div>
				<div class="site-footer__menu col-12 col-md-4 col-lg-2 block--padded-sm">
					<?php dynamic_sidebar('footer-col-4'); ?>
				</div>
				<div class="site-footer__contact-details col-12 col-lg-3 block--padded-sm">
					<?php dynamic_sidebar('footer-col-5'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="site-footer__payment-icons border-top-green block--padded-md">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row align-items-center justify-content-center text-center site-footer__payment-icons-row">
				<?php dynamic_sidebar('footer-payment-icons'); ?>
			</div>
		</div>
	</div><!-- .site-info -->

	<div class="site-footer__disclaimer block--padded-sm">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row text-center site-footer__disclaimer-row">
				<?php dynamic_sidebar('footer-disclaimer'); ?>
			</div>
		</div>
	</div><!-- .site-info -->

	<span style="display:none;">website uptime string</span>
</footer><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://widget.reviews.io/carousel-inline-iframeless/dist.js?_t=2025040415"></script>
<script src="https://widget.reviews.io/polaris/build.js"></script>

<script src="https://widget.reviews.io/rating-snippet/dist.js"></script>

<script>
	ratingSnippet("ruk_rating_snippet", {
		store: "www.sitandsleep.co.uk",
		mode: "default",
		color: "#f7c623",
		linebreak: true,
		text: "Reviews",
		singularText: "Review",
		lang: "en",
		usePolaris: false,
		showEmptyStars: false,
	});
</script>

<script>
	function copyText() {
		// Get the hidden field
		const hiddenField = document.getElementById('hiddenField');

		// Create a temporary textarea element to hold the text to be copied
		const tempTextarea = document.createElement('textarea');
		tempTextarea.value = hiddenField.value;
		document.body.appendChild(tempTextarea);

		// Select the text and copy it to the clipboard
		tempTextarea.select();
		document.execCommand('copy');

		// Remove the temporary textarea
		document.body.removeChild(tempTextarea);

		// Show a message indicating that the text was copied
		alert("Text copied!");
	}

	function copyTextLoop() {
		// Find the closest modal
		const modal = event.target.closest('.modal');

		// Find the hidden field within this modal
		const hiddenField = modal.querySelector('.hiddenField');

		// Create a temporary textarea element to hold the text to be copied
		const tempTextarea = document.createElement('textarea');
		tempTextarea.value = hiddenField.value;
		document.body.appendChild(tempTextarea);

		// Select the text and copy it to the clipboard
		tempTextarea.select();
		document.execCommand('copy');

		// Remove the temporary textarea
		document.body.removeChild(tempTextarea);

		// Show a message indicating that the text was copied
		alert("Text copied!");
	}

	jQuery(function ($) {
		// Initialize Bootstrap tooltips (works on hover automatically)
		$('[data-bs-toggle="tooltip"]').tooltip();

		// Optional: Handle click event to show tooltip manually
		$(document).on('click', '.attribute-tooltip', function (e) {
			e.preventDefault(); // Prevent default action
			$(this).tooltip('show'); // Show tooltip manually
		});
	});

</script>

<script>
	new carouselInlineWidget('reviewsio-carousel-widget', {
		/*Your REVIEWS.io account ID:*/
		store: 'www.sitandsleep.co.uk',
		sku: '',
		lang: 'en',
		carousel_type: 'topHeader',
		styles_carousel: 'CarouselWidget--topHeader--withcards',

		/*Widget settings:*/
		options: {
			general: {
				/*What reviews should the widget display? Available options: company, product, third_party. You can choose one type or multiple separated by comma.*/
				review_type: 'company, product, third_party',
				/*Minimum number of reviews required for widget to be displayed*/
				min_reviews: '4',
				/*Maximum number of reviews to include in the carousel widget.*/
				max_reviews: '20',
				address_format: 'CITY, COUNTRY',
				/*Carousel auto-scrolling speed. 3000 = 3 seconds. If you want to disable auto-scroll, set this value to false.*/
				enable_auto_scroll: 10000,
			},
			header: {
				/*Show overall rating stars*/
				enable_overall_stars: true,
				rating_decimal_places: 2,
			},
			reviews: {
				/*Show customer name*/
				enable_customer_name: true,
				/*Show customer location*/
				enable_customer_location: true,
				/*Show "verified review" badge*/
				enable_verified_badge: true,
				/*Show "verified subscriber" badge*/
				enable_subscriber_badge: true,
				/*Show "I recommend this product" badge (Only for product reviews)*/
				enable_recommends_badge: true,
				/*Show photos attached to reviews*/
				enable_photos: true,
				/*Show videos attached to reviews*/
				enable_videos: true,
				/*Show when review was written*/
				enable_review_date: true,
				/*Hide reviews written by the same customer (This may occur when customer reviews multiple products)*/
				disable_same_customer: true,
				/*Minimum star rating*/
				min_review_percent: 4,
				/*Show 3rd party review source*/
				third_party_source: true,
				/*Hide reviews without comments (still shows if review has a photo)*/
				hide_empty_reviews: true,
				/*Show product name*/
				enable_product_name: true,
				/*Show only reviews which have specific tags (multiple semicolon separated tags allowed i.e tag1;tag2)*/
				tags: "",
				/*Show branch, only one input*/
				branch: "",
				enable_branch_name: false,
			},
			popups: {
				/*Make review items clickable (When they are clicked, a popup appears with more information about a customer and review)*/
				enable_review_popups: true,
				/*Show "was this review helpful" buttons*/
				enable_helpful_buttons: true,
				/*Show how many times review was upvoted as helpful*/
				enable_helpful_count: true,
				/*Show share buttons*/
				enable_share_buttons: true,
			},
		},
		translations: {
			verified_customer: "Verified Customer",
		},
		styles: {
			/*Base font size is a reference size for all text elements. When base value gets changed, all TextHeading and TexBody elements get proportionally adjusted.*/
			'--base-font-size': '16px',
			'--base-maxwidth': '100%',

			/*Logo styles:*/
			'--reviewsio-logo-style': 'var(--logo-normal)',

			/*Star styles:*/
			'--common-star-color': ' #f7c623',
			'--common-star-disabled-color': ' rgba(0,0,0,0.25)',
			'--medium-star-size': ' 22px',
			'--small-star-size': '19px', /*Modal*/
			'--x-small-star-size': '16px',
			'--x-small-star-display': 'inline-flex',

			/*Header styles:*/
			'--header-order': '1',
			'--header-width': '160px',
			'--header-bg-start-color': 'transparent',
			'--header-bg-end-color': 'transparent',
			'--header-gradient-direction': '135deg',
			'--header-padding': '0.5em',
			'--header-border-width': '0px',
			'--header-border-color': 'rgba(0,0,0,0.1)',
			'--header-border-radius': '0px',
			'--header-shadow-size': '0px',
			'--header-shadow-color': 'rgba(0, 0, 0, 0.1)',

			/*Header content styles:*/
			'--header-star-color': 'inherit',
			'--header-disabled-star-color': 'inherit',
			'--header-heading-text-color': 'inherit',
			'--header-heading-font-size': 'inherit',
			'--header-heading-font-weight': 'inherit',
			'--header-heading-line-height': 'inherit',
			'--header-heading-text-transform': 'inherit',
			'--header-subheading-text-color': 'inherit',
			'--header-subheading-font-size': 'inherit',
			'--header-subheading-font-weight': 'inherit',
			'--header-subheading-line-height': 'inherit',
			'--header-subheading-text-transform': 'inherit',

			/*Review item styles:*/
			'--item-maximum-columns': '5',/*Must be 3 or larger*/
			'--item-background-start-color': '#ffffff',
			'--item-background-end-color': '#ffffff',
			'--item-gradient-direction': '135deg',
			'--item-padding': '1.5em',
			'--item-border-width': '0px',
			'--item-border-color': 'rgba(0,0,0,0.1)',
			'--item-border-radius': '0px',
			'--item-shadow-size': '10px',
			'--item-shadow-color': 'rgba(0,0,0,0.05)',

			/*Heading styles:*/
			'--heading-text-color': ' #0E1311',
			'--heading-text-font-weight': ' 600',
			'--heading-text-font-family': ' inherit',
			'--heading-text-line-height': ' 1.4',
			'--heading-text-letter-spacing': '0',
			'--heading-text-transform': 'none',

			/*Body text styles:*/
			'--body-text-color': ' #0E1311',
			'--body-text-font-weight': '400',
			'--body-text-font-family': ' inherit',
			'--body-text-line-height': ' 1.4',
			'--body-text-letter-spacing': '0',
			'--body-text-transform': 'none',

			/*Scroll button styles:*/
			'--scroll-button-icon-color': '#0E1311',
			'--scroll-button-icon-size': '24px',
			'--scroll-button-bg-color': 'transparent',

			'--scroll-button-border-width': '0px',
			'--scroll-button-border-color': 'rgba(0,0,0,0.1)',

			'--scroll-button-border-radius': '60px',
			'--scroll-button-shadow-size': '0px',
			'--scroll-button-shadow-color': 'rgba(0,0,0,0.1)',
			'--scroll-button-horizontal-position': '0px',
			'--scroll-button-vertical-position': '0px',

			/*Badge styles:*/
			'--badge-icon-color': '#0E1311',
			'--badge-icon-font-size': '15px',
			'--badge-text-color': '#0E1311',
			'--badge-text-font-size': 'inherit',
			'--badge-text-letter-spacing': 'inherit',
			'--badge-text-transform': 'inherit',

			/*Author styles:*/
			'--author-font-size': 'inherit',
			'--author-font-weight': 'inherit',
			'--author-text-transform': 'inherit',

			/*Product photo or review photo styles:*/
			'--photo-video-thumbnail-size': '60px',
			'--photo-video-thumbnail-border-radius': '0px',

			/*Popup styles:*/
			'--popup-backdrop-color': 'rgba(0,0,0,0.75)',
			'--popup-color': '#ffffff',
			'--popup-star-color': 'inherit',
			'--popup-disabled-star-color': 'inherit',
			'--popup-heading-text-color': 'inherit',
			'--popup-body-text-color': 'inherit',
			'--popup-badge-icon-color': 'inherit',
			'--popup-badge-icon-font-size': '19px',
			'--popup-badge-text-color': 'inherit',
			'--popup-badge-text-font-size': '14px',
			'--popup-border-width': '0px',
			'--popup-border-color': 'rgba(0,0,0,0.1)',
			'--popup-border-radius': '0px',
			'--popup-shadow-size': '0px',
			'--popup-shadow-color': 'rgba(0,0,0,0.1)',
			'--popup-icon-color': '#0E1311',

			/*Tooltip styles:*/
			'--tooltip-bg-color': '#0E1311',
			'--tooltip-text-color': '#ffffff',
		},
	});
</script>

<script>
	new ReviewsWidget('#AllReviewsWidget', {
		//Your REVIEWS.io Store ID and widget type:
		store: 'www.sitandsleep.co.uk',
		widget: 'polaris',

		//Content settings (store_review,product_review,third_party_review,questions). Choose what to display in this widget:
		options: {
			types: 'third_party_review',
			enable_sentiment_analysis: false,
			lang: 'en',
			//Possible layout options: bordered, large and reverse.
			layout: '',
			//How many reviews & questions to show per page?
			per_page: 20,
			store_review: {
				hide_if_no_results: false,
			},
			third_party_review: {
				hide_if_no_results: false,
			},
			//Product specific settings. Provide product SKU for which reviews should be displayed:
			product_review: {
				//Display product reviews - include multiple product SKUs seperated by Semi-Colons (Main Indentifer in your product catalog )
				sku: '[Multiple SKUs Seperated by Semi-Colons e.g "sku1;sku2;" ]',
				hide_if_no_results: false,
			},
			//Questions settings:
			questions: {
				hide_if_no_results: true,
				enable_ask_question: true,
				enable_ask_question_button_style: false, //Show "be the first to ask a question" text as a button
				show_dates: true,
				//Display group questions by providing a grouping variable, new questions will be assigned to this group.
				grouping: '[Group questions by providing a grouping variable here or a specific product SKU]'
			},
			//Header settings:
			header: {
				enable_summary: true, //Show overall rating & review count
				enable_ratings: true,
				enable_attributes: true,
				enable_image_gallery: false, //Show photo & video gallery
				enable_percent_recommended: false, //Show what percentage of reviewers recommend it
				enable_write_review: false, //Show "Write Review" button
				enable_ask_question: false, //Show "Ask Question" button
				enable_sub_header: true, //Show subheader
				rating_decimal_places: 2,
				use_write_review_button: false, //Show "be the first to leave a review" text as a button
				enable_if_no_results: false, //Show header when there are no results
			},

			//AI summary settings
			sentiment: {
				badge_text: 'Our Customers Say'
			},

			//Filtering settings:
			filtering: {
				enable: true, //Show filtering options
				enable_text_search: true, //Show search field
				enable_sorting: true, //Show sorting options (most recent, most popular)
				enable_product_filter: false, //Show product options filter
				enable_media_filter: false, //Show reviews with images/video/media options
				enable_overall_rating_filter: true, //Show overall rating breakdown filter
				enable_language_filter: false, // Filter by review language
				enable_language_filter_language_change: false, // Update widget language based on language selected
				enable_ratings_filters: false, //Show product attributes filter
				enable_attributes_filters: false, //Show author attributes filter
				enable_expanded_filters: false, //Show filters as a section instead of dropdown
			},

			//Review settings:
			reviews: {
				enable_avatar: true, //Show author avatar
				enable_reviewer_name: true, //Show author name
				enable_reviewer_address: true, //Show author location
				reviewer_address_format: 'city, country', //Author location display format
				enable_verified_badge: true, //Show "Verified Customer" badge
				enable_subscriber_badge: true, //Show "Verified Subscriber" badge
				review_content_filter: 'undefined', //Filter content
				enable_reviewer_recommends: true, //Show "I recommend it" badge
				enable_attributes: true, //Show author attributes
				enable_product_name: true, //Show display product name
				enable_review_title: undefined, //Show review title
				enable_replies: false, //Show review replies
				enable_images: false, //Show display review photos
				enable_ratings: true, //Show product attributes (additional ratings)
				enable_share: false, //Show share buttons
				enable_helpful_vote: false, //Show "was this helpful?" section
				enable_helpful_display: false, //Show how many times times review upvoted
				enable_report: false, //Show report button
				enable_date: true, //Show when review was published
				enable_third_party_source: true, //Show third party source
				enable_duplicate_reviews: undefined, //Show multiple reviews from the same user

			},
		},
		//Translation settings
		translations: {
			'Verified Customer': 'Verified Customer'
		},
		//Style settings:
		styles: {
			//Base font size is a reference size for all text elements. When base value gets changed, all TextHeading and TexBody elements get proportionally adjusted.
			'--base-font-size': '16px',

			//Button styles (shared between buttons):
			'--common-button-font-family': 'inherit',
			'--common-button-font-size': '16px',
			'--common-button-font-weight': '500',
			'--common-button-letter-spacing': '0',
			'--common-button-text-transform': 'none',
			'--common-button-vertical-padding': '10px',
			'--common-button-horizontal-padding': '20px',
			'--common-button-border-width': '2px',
			'--common-button-border-radius': '0px',

			//Primary button styles:
			'--primary-button-bg-color': '#0E1311',
			'--primary-button-border-color': '#0E1311',
			'--primary-button-text-color': '#ffffff',

			//Secondary button styles:
			'--secondary-button-bg-color': 'transparent',
			'--secondary-button-border-color': '#0E1311',
			'--secondary-button-text-color': '#0E1311',

			//Star styles:
			'--common-star-color': '#f7c623',
			'--common-star-disabled-color': 'rgba(0,0,0,0.25)',
			'--medium-star-size': '22px',
			'--small-star-size': '19px',

			//Heading styles:
			'--heading-text-color': '#0E1311',
			'--heading-text-font-weight': '600',
			'--heading-text-font-family': 'inherit',
			'--heading-text-line-height': '1.4',
			'--heading-text-letter-spacing': '0',
			'--heading-text-transform': 'none',

			//Body text styles:
			'--body-text-color': '#0E1311',
			'--body-text-font-weight': '400',
			'--body-text-font-family': 'inherit',
			'--body-text-line-height': '1.4',
			'--body-text-letter-spacing': '0',
			'--body-text-transform': 'none',

			//Input field styles:
			'--inputfield-text-font-family': 'inherit',
			'--input-text-font-size': '14px',
			'--inputfield-text-font-weight': '400',
			'--inputfield-text-color': '#0E1311',
			'--inputfield-border-color': 'rgba(0,0,0,0.2)',
			'--inputfield-background-color': 'transparent',
			'--inputfield-border-width': '1px',
			'--inputfield-border-radius': '0px',

			'--common-border-color': 'rgba(0,0,0,0.15)',
			'--common-border-width': '1px',
			'--common-sidebar-width': '190px',

			//Filters panel styles:
			'--filters-panel-bg-color': 'transparent',
			'--filters-panel-font-size': '16px',
			'--filters-panel-text-color': '16px',
			'--filters-panel-horizontal-padding': '0',
			'--filters-panel-vertical-padding': '0',

			//Slider indicator (for attributes) styles:
			'--slider-indicator-bg-color': 'rgba(0,0,0,0.1)',
			'--slider-indicator-button-color': '#0E1311',
			'--slider-indicator-width': '190px',

			//Badge styles:
			'--badge-icon-color': '#0E1311',
			'--badge-icon-font-size': 'inherit',
			'--badge-text-color': '#0E1311',
			'--badge-text-font-size': 'inherit',
			'--badge-text-letter-spacing': 'inherit',
			'--badge-text-transform': 'inherit',

			//Author styles:
			'--author-font-size': 'inherit',
			'--author-text-transform': 'none',

			//Author avatar styles:
			'--avatar-thumbnail-size': '60px',
			'--avatar-thumbnail-border-radius': '100px',
			'--avatar-thumbnail-text-color': '#0E1311',
			'--avatar-thumbnail-bg-color': 'rgba(0,0,0,0.1)',

			//Product photo or review photo styles:
			'--photo-video-thumbnail-size': '80px',
			'--photo-video-thumbnail-border-radius': '0px',

			//Media (photo & video) slider styles:
			'--mediaslider-scroll-button-icon-color': '#0E1311',
			'--mediaslider-scroll-button-bg-color': 'rgba(255, 255, 255, 0.85)',
			'--mediaslider-overlay-text-color': '#ffffff',
			'--mediaslider-overlay-bg-color': 'rgba(0, 0, 0, 0.8))',
			'--mediaslider-item-size': '110px',

			//Pagination & tabs styles (normal):
			'--pagination-tab-text-color': '#0E1311',
			'--pagination-tab-text-transform': 'none',
			'--pagination-tab-text-letter-spacing': '0',
			'--pagination-tab-text-font-size': '16px',
			'--pagination-tab-text-font-weight': '600',

			//Pagination & tabs styles (active):
			'--pagination-tab-active-text-color': '#0E1311',
			'--pagination-tab-active-text-font-weight': '600',
			'--pagination-tab-active-border-color': '#0E1311',
			'--pagination-tab-border-width': '3px',

			//AI summary styles
			'--sentiment-base-font-size': '15px',
			'--sentiment-panel-bg-color': 'transparent',
			'--sentiment-panel-border-size': '1px',
			'--sentiment-panel-border-color': 'rgba(0, 0, 0, 0.1)',
			'--sentiment-panel-border-radius': '0px',
			'--sentiment-panel-shadow-size': '0px',
			'--sentiment-panel-shadow-color': 'rgba(0, 0, 0, 0.1)',
			'--sentiment-heading-text-color': '#0E1311',
			'--sentiment-heading-text-font-weight': '600',
			'--sentiment-heading-text-font-family': 'inherit',
			'--sentiment-heading-text-line-height': '1.4',
			'--sentiment-heading-text-letter-spacing': '0',
			'--sentiment-heading-text-transform': 'none',
			'--sentiment-body-text-color': '#0E1311',
			'--sentiment-body-text-font-weight': '400',
			'--sentiment-body-text-font-family': 'inherit',
			'--sentiment-body-text-line-height': '1.4',
			'--sentiment-body-text-letter-spacing': '0',
			'--sentiment-body-text-transform': 'none',
			'--sentiment-panel-vertical-padding': '25px',
			'--sentiment-panel-horizontal-padding': '20px',
			'--sentiment-header-text-color': 'inherit',
			'--sentiment-header-text-font-size': '12px',
			'--sentiment-header-text-font-weight': 'inherit',
			'--sentiment-header-bg-color': 'rgba(0, 0, 0, 0.04)',
			'--sentiment-header-border-radius': '50px',
			'--sentiment-header-shadow-size': '0px',
			'--sentiment-header-shadow-color': 'rgba(0, 0, 0, 0.1)',
			'--sentiment-header-vertical-padding': '7px',
			'--sentiment-header-horizontal-padding': '10px',
			'--sentiment-pagination-tab-text-font-size': '13px',
			'--sentiment-pagination-tab-text-font-weight': '600',
			'--sentiment-pagination-tab-text-color': '#0E1311',
			'--sentiment-pagination-tab-text-transform': 'none',
			'--sentiment-pagination-tab-text-letter-spacing': '0',
			'--sentiment-pagination-tab-active-text-color': '#0E1311',
			'--sentiment-pagination-tab-active-text-font-weight': '600',
			'--sentiment-pagination-tab-active-border-color': '#0E1311',
			'--sentiment-pagination-tab-border-width': '3px',
		},
	});
</script>

<script>
	new ReviewsWidget('#ReviewsWidget', {
		//Your REVIEWS.io Store ID and widget type:
		store: 'www.sitandsleep.co.uk',
		widget: 'polaris',

		//Content settings (store_review,product_review,third_party_review,questions). Choose what to display in this widget:
		options: {
			types: 'product_review',
			enable_sentiment_analysis: false,
			lang: 'en',
			//Possible layout options: bordered, large and reverse.
			layout: '',
			//How many reviews & questions to show per page?
			per_page: 3,
			store_review: {
				hide_if_no_results: false,
			},
			third_party_review: {
				hide_if_no_results: false,
			},
			//Product specific settings. Provide product SKU for which reviews should be displayed:
			product_review: {
				//Display product reviews - include multiple product SKUs seperated by Semi-Colons (Main Indentifer in your product catalog )
				sku: '<?php echo get_post_meta(get_the_ID(), '_sku', true); ?>',
				hide_if_no_results: false,
			},
			//Questions settings:
			questions: {
				hide_if_no_results: true,
				enable_ask_question: true,
				enable_ask_question_button_style: false, //Show "be the first to ask a question" text as a button
				show_dates: true,
				//Display group questions by providing a grouping variable, new questions will be assigned to this group.
				grouping: '[Group questions by providing a grouping variable here or a specific product SKU]'
			},
			//Header settings:
			header: {
				enable_summary: true, //Show overall rating & review count
				enable_ratings: true,
				enable_attributes: false,
				enable_image_gallery: false, //Show photo & video gallery
				enable_percent_recommended: false, //Show what percentage of reviewers recommend it
				enable_write_review: false, //Show "Write Review" button
				enable_ask_question: false, //Show "Ask Question" button
				enable_sub_header: false, //Show subheader
				rating_decimal_places: 2,
				use_write_review_button: false, //Show "be the first to leave a review" text as a button
				enable_if_no_results: false, //Show header when there are no results
			},

			//AI summary settings
			sentiment: {
				badge_text: 'Our Customers Say'
			},

			//Filtering settings:
			filtering: {
				enable: false, //Show filtering options
				enable_text_search: false, //Show search field
				enable_sorting: false, //Show sorting options (most recent, most popular)
				enable_product_filter: false, //Show product options filter
				enable_media_filter: false, //Show reviews with images/video/media options
				enable_overall_rating_filter: false, //Show overall rating breakdown filter
				enable_language_filter: false, // Filter by review language
				enable_language_filter_language_change: false, // Update widget language based on language selected
				enable_ratings_filters: false, //Show product attributes filter
				enable_attributes_filters: false, //Show author attributes filter
				enable_expanded_filters: false, //Show filters as a section instead of dropdown
			},

			//Review settings:
			reviews: {
				enable_avatar: true, //Show author avatar
				enable_reviewer_name: true, //Show author name
				enable_reviewer_address: true, //Show author location
				reviewer_address_format: 'city, country', //Author location display format
				enable_verified_badge: true, //Show "Verified Customer" badge
				enable_subscriber_badge: true, //Show "Verified Subscriber" badge
				review_content_filter: 'undefined', //Filter content
				enable_reviewer_recommends: true, //Show "I recommend it" badge
				enable_attributes: true, //Show author attributes
				enable_product_name: true, //Show display product name
				enable_review_title: undefined, //Show review title
				enable_replies: false, //Show review replies
				enable_images: true, //Show display review photos
				enable_ratings: true, //Show product attributes (additional ratings)
				enable_share: false, //Show share buttons
				enable_helpful_vote: false, //Show "was this helpful?" section
				enable_helpful_display: false, //Show how many times times review upvoted
				enable_report: false, //Show report button
				enable_date: true, //Show when review was published
				enable_third_party_source: true, //Show third party source
				enable_duplicate_reviews: undefined, //Show multiple reviews from the same user

			},
		},
		//Translation settings
		translations: {
			'Verified Customer': 'Verified Customer'
		},
		//Style settings:
		styles: {
			//Base font size is a reference size for all text elements. When base value gets changed, all TextHeading and TexBody elements get proportionally adjusted.
			'--base-font-size': '16px',

			//Button styles (shared between buttons):
			'--common-button-font-family': 'inherit',
			'--common-button-font-size': '16px',
			'--common-button-font-weight': '500',
			'--common-button-letter-spacing': '0',
			'--common-button-text-transform': 'none',
			'--common-button-vertical-padding': '10px',
			'--common-button-horizontal-padding': '20px',
			'--common-button-border-width': '2px',
			'--common-button-border-radius': '0px',

			//Primary button styles:
			'--primary-button-bg-color': '#0E1311',
			'--primary-button-border-color': '#0E1311',
			'--primary-button-text-color': '#ffffff',

			//Secondary button styles:
			'--secondary-button-bg-color': 'transparent',
			'--secondary-button-border-color': '#0E1311',
			'--secondary-button-text-color': '#0E1311',

			//Star styles:
			'--common-star-color': '#f7c623',
			'--common-star-disabled-color': 'rgba(0,0,0,0.25)',
			'--medium-star-size': '22px',
			'--small-star-size': '19px',

			//Heading styles:
			'--heading-text-color': '#0E1311',
			'--heading-text-font-weight': '600',
			'--heading-text-font-family': 'inherit',
			'--heading-text-line-height': '1.4',
			'--heading-text-letter-spacing': '0',
			'--heading-text-transform': 'none',

			//Body text styles:
			'--body-text-color': '#0E1311',
			'--body-text-font-weight': '400',
			'--body-text-font-family': 'inherit',
			'--body-text-line-height': '1.4',
			'--body-text-letter-spacing': '0',
			'--body-text-transform': 'none',

			//Input field styles:
			'--inputfield-text-font-family': 'inherit',
			'--input-text-font-size': '14px',
			'--inputfield-text-font-weight': '400',
			'--inputfield-text-color': '#0E1311',
			'--inputfield-border-color': 'rgba(0,0,0,0.2)',
			'--inputfield-background-color': 'transparent',
			'--inputfield-border-width': '1px',
			'--inputfield-border-radius': '0px',

			'--common-border-color': 'rgba(0,0,0,0.15)',
			'--common-border-width': '1px',
			'--common-sidebar-width': '190px',

			//Filters panel styles:
			'--filters-panel-bg-color': 'transparent',
			'--filters-panel-font-size': '16px',
			'--filters-panel-text-color': '16px',
			'--filters-panel-horizontal-padding': '0',
			'--filters-panel-vertical-padding': '0',

			//Slider indicator (for attributes) styles:
			'--slider-indicator-bg-color': 'rgba(0,0,0,0.1)',
			'--slider-indicator-button-color': '#0E1311',
			'--slider-indicator-width': '190px',

			//Badge styles:
			'--badge-icon-color': '#0E1311',
			'--badge-icon-font-size': 'inherit',
			'--badge-text-color': '#0E1311',
			'--badge-text-font-size': 'inherit',
			'--badge-text-letter-spacing': 'inherit',
			'--badge-text-transform': 'inherit',

			//Author styles:
			'--author-font-size': 'inherit',
			'--author-text-transform': 'none',

			//Author avatar styles:
			'--avatar-thumbnail-size': '60px',
			'--avatar-thumbnail-border-radius': '100px',
			'--avatar-thumbnail-text-color': '#0E1311',
			'--avatar-thumbnail-bg-color': 'rgba(0,0,0,0.1)',

			//Product photo or review photo styles:
			'--photo-video-thumbnail-size': '80px',
			'--photo-video-thumbnail-border-radius': '0px',

			//Media (photo & video) slider styles:
			'--mediaslider-scroll-button-icon-color': '#0E1311',
			'--mediaslider-scroll-button-bg-color': 'rgba(255, 255, 255, 0.85)',
			'--mediaslider-overlay-text-color': '#ffffff',
			'--mediaslider-overlay-bg-color': 'rgba(0, 0, 0, 0.8))',
			'--mediaslider-item-size': '110px',

			//Pagination & tabs styles (normal):
			'--pagination-tab-text-color': '#0E1311',
			'--pagination-tab-text-transform': 'none',
			'--pagination-tab-text-letter-spacing': '0',
			'--pagination-tab-text-font-size': '16px',
			'--pagination-tab-text-font-weight': '600',

			//Pagination & tabs styles (active):
			'--pagination-tab-active-text-color': '#0E1311',
			'--pagination-tab-active-text-font-weight': '600',
			'--pagination-tab-active-border-color': '#0E1311',
			'--pagination-tab-border-width': '3px',

			//AI summary styles
			'--sentiment-base-font-size': '15px',
			'--sentiment-panel-bg-color': 'transparent',
			'--sentiment-panel-border-size': '1px',
			'--sentiment-panel-border-color': 'rgba(0, 0, 0, 0.1)',
			'--sentiment-panel-border-radius': '0px',
			'--sentiment-panel-shadow-size': '0px',
			'--sentiment-panel-shadow-color': 'rgba(0, 0, 0, 0.1)',
			'--sentiment-heading-text-color': '#0E1311',
			'--sentiment-heading-text-font-weight': '600',
			'--sentiment-heading-text-font-family': 'inherit',
			'--sentiment-heading-text-line-height': '1.4',
			'--sentiment-heading-text-letter-spacing': '0',
			'--sentiment-heading-text-transform': 'none',
			'--sentiment-body-text-color': '#0E1311',
			'--sentiment-body-text-font-weight': '400',
			'--sentiment-body-text-font-family': 'inherit',
			'--sentiment-body-text-line-height': '1.4',
			'--sentiment-body-text-letter-spacing': '0',
			'--sentiment-body-text-transform': 'none',
			'--sentiment-panel-vertical-padding': '25px',
			'--sentiment-panel-horizontal-padding': '20px',
			'--sentiment-header-text-color': 'inherit',
			'--sentiment-header-text-font-size': '12px',
			'--sentiment-header-text-font-weight': 'inherit',
			'--sentiment-header-bg-color': 'rgba(0, 0, 0, 0.04)',
			'--sentiment-header-border-radius': '50px',
			'--sentiment-header-shadow-size': '0px',
			'--sentiment-header-shadow-color': 'rgba(0, 0, 0, 0.1)',
			'--sentiment-header-vertical-padding': '7px',
			'--sentiment-header-horizontal-padding': '10px',
			'--sentiment-pagination-tab-text-font-size': '13px',
			'--sentiment-pagination-tab-text-font-weight': '600',
			'--sentiment-pagination-tab-text-color': '#0E1311',
			'--sentiment-pagination-tab-text-transform': 'none',
			'--sentiment-pagination-tab-text-letter-spacing': '0',
			'--sentiment-pagination-tab-active-text-color': '#0E1311',
			'--sentiment-pagination-tab-active-text-font-weight': '600',
			'--sentiment-pagination-tab-active-border-color': '#0E1311',
			'--sentiment-pagination-tab-border-width': '3px',
		},
	});
</script>

</body>

</html>