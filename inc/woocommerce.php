<?php
/**
 * Add WooCommerce support
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('after_setup_theme', 'understrap_woocommerce_support');
if (!function_exists('understrap_woocommerce_support')) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function understrap_woocommerce_support()
	{
		add_theme_support('woocommerce');

		// Add Product Gallery support.
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-slider');

		// Add Bootstrap classes to form fields.
		add_filter('woocommerce_form_field_args', 'understrap_wc_form_field_args', 10, 3);
		add_filter('woocommerce_form_field_radio', 'understrap_wc_form_field_radio', 10, 4);
		add_filter('woocommerce_quantity_input_classes', 'understrap_quantity_input_classes');
		add_filter('woocommerce_loop_add_to_cart_args', 'understrap_loop_add_to_cart_args');

		// Wrap the add-to-cart link in `div.add-to-cart-container`.
		add_filter('woocommerce_loop_add_to_cart_link', 'understrap_loop_add_to_cart_link');

		// Add Bootstrap classes to account navigation.
		add_filter('woocommerce_account_menu_item_classes', 'understrap_account_menu_item_classes');
	}
}

// First unhook the WooCommerce content wrappers.
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Then hook in your own functions to display the wrappers your theme requires.
add_action('woocommerce_before_main_content', 'understrap_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'understrap_woocommerce_wrapper_end', 10);

if (!function_exists('understrap_woocommerce_wrapper_start')) {
	/**
	 * Display the theme specific start of the page wrapper.
	 */
	function understrap_woocommerce_wrapper_start()
	{
		$container = get_theme_mod('echo_container_type');
		if (false === $container) {
			$container = '';
		}

		$auxClass = '';
		if (is_product()) {
			$auxClass = 'block--fullwidth';
		}

		echo '<div class="wrapper pt-0" id="woocommerce-wrapper">';
		echo '<div class="' . esc_attr($container) . '" id="content" tabindex="-1">';
		echo '<div class="row">';
		get_template_part('global-templates/left-sidebar-check');
		echo '<main class="site-main ' . $auxClass . '" id="main">';
	}
}

if (!function_exists('understrap_woocommerce_wrapper_end')) {
	/**
	 * Display the theme specific end of the page wrapper.
	 */
	function understrap_woocommerce_wrapper_end()
	{
		echo '</main>';
		get_template_part('global-templates/right-sidebar-check');
		echo '</div><!-- .row -->';
		echo '</div><!-- .container(-fluid) -->';
		echo '</div><!-- #woocommerce-wrapper -->';
	}
}

if (!function_exists('understrap_wc_form_field_args')) {
	/**
	 * Modifies the form field's arguments by input type. The arguments are used
	 * in `woocommerce_form_field()` to build the form fields.
	 *
	 * @see https://woocommerce.github.io/code-reference/namespaces/default.html#function_woocommerce_form_field
	 *
	 * @param array<string,mixed> $args  Form field arguments.
	 * @param string              $key   Value of the fields name attribute.
	 * @param string|null         $value Value of <select> option.
	 *
	 * @return array<string,mixed> Form field arguments.
	 */
	function understrap_wc_form_field_args($args, $key, $value)
	{
		$bootstrap4 = 'bootstrap4' === get_theme_mod('understrap_bootstrap_version', 'bootstrap4');

		// Add margin to each form field's html element wrapper (<p></p>).
		if ($bootstrap4) {
			$args['class'][] = 'form-group';
		}
		$args['class'][] = 'mb-3';

		// Start field type switch case.
		switch ($args['type']) {
			case 'country':
				/*
				 * WooCommerce will populate a <select> element of type 'country'
				 * with the country names. $args defined for this specific input
				 * type targets only the country <select> element.
				 */

				$args['class'][] = 'single-country';
				break;
			case 'state':
				/*
				 * WooCommerce will populate a <select> element of type 'state'
				 * with the state names. $args defined for this specific input
				 * type targets only the state <select> element.
				 */

				// Add custom data attributes to the form input itself.
				$args['custom_attributes']['data-plugin'] = 'select2';
				$args['custom_attributes']['data-allow-clear'] = 'true';
				$args['custom_attributes']['aria-hidden'] = 'true';
				break;
			case 'checkbox':
				/*
				 * WooCommerce checkbox markup differs from Bootstrap checkbox
				 * markup. We apply Bootstrap classes such that the WooCommerce
				 * checkbox look matches the Bootstrap checkbox look.
				 */

				// Get Bootstrap version specific CSS class base.
				$base = $bootstrap4 ? 'custom-control' : 'form-check';

				if (isset($args['label'])) {
					// Wrap the label in <span> tag.
					$args['label'] = "<span class=\"{$base}-label\">{$args['label']}</span>";
				}

				// Add a class to the form input's <label> tag.
				$args['label_class'][] = $base;
				if ($bootstrap4) {
					$args['label_class'][] = 'custom-checkbox';
				}

				// Add a class to the form input itself.
				$args['input_class'][] = $base . '-input';
				break;
			case 'select':
				/*
				 * Targets all <select> elements, except the <select> elements
				 * of type country or of type state.
				 */

				// Add a class to the form input itself.
				$args['input_class'][] = $bootstrap4 ? 'form-control' : 'form-select';

				// Add custom data attributes to the form input itself.
				$args['custom_attributes']['data-plugin'] = 'select2';
				$args['custom_attributes']['data-allow-clear'] = 'true';
				break;
			case 'radio':
				// Get Bootstrap version specific CSS class base.
				$base = $bootstrap4 ? 'custom-control' : 'form-check';

				$args['label_class'][] = $base . '-label';
				$args['input_class'][] = $base . '-input';
				break;
			default:
				$args['input_class'][] = 'form-control';
				break;
		} // End of switch ( $args ).
		return $args;
	}
}

if (!function_exists('understrap_wc_form_field_radio')) {
	/**
	 * Adjust the WooCommerce checkout/address radio fields to match the look of
	 * Bootstrap radio fields.
	 *
	 * Wraps each radio field (`<input>`+`<label>`) in a `.from-check`.
	 *
	 * If `$args['label']` is set a `<label>` tag is prepended to the radio
	 * fields. `$args['label_class']` is used for the class attribute of this
	 * tag and the class attribute of the actual input labels. Hence, we must
	 * remove the first occurance of the label class added via
	 * `understrap_wc_form_field_args()` that is meant for input labels only.
	 *
	 * @param string              $field The field's HTML incl. the wrapper element.
	 * @param string              $key   The wrapper element's id attribute value.
	 * @param array<string|mixed> $args  An array of field arguments.
	 * @param string|null         $value The field's value.
	 * @return string
	 */
	function understrap_wc_form_field_radio($field, $key, $args, $value)
	{

		// Set up Bootstrap version specific variables.
		if ('bootstrap4' === get_theme_mod('understrap_bootstrap_version', 'bootstrap4')) {
			$wrapper_classes = 'custom-control custom-radio';
			$label_class = 'custom-control-label';
		} else {
			$wrapper_classes = 'form-check';
			$label_class = 'form-check-label';
		}

		// Remove the first occurance of the label class if neccessary.
		if (isset($args['label']) && isset($args['label_class'])) {
			$strpos = strpos($field, $label_class);
			if (false !== $strpos) {
				$field = substr_replace($field, '', $strpos, strlen($label_class));

				/*
				 * If $label_class was the only class in $args['label_class']
				 * then there is an empty class attribute now. Let's remove it.
				 */
				$field = str_replace('class=""', '', $field);
			}
		}

		// Wrap each radio in a <span.from-check>.
		$field = str_replace('<input', "<span class=\"{$wrapper_classes}\"><input", $field);
		$field = str_replace('</label>', '</label></span>', $field);
		if (isset($args['label'])) {
			// Remove the closing span tag from the first <label> element.
			$strpos = strpos($field, '</label>') + strlen('</label>');
			$field = substr_replace($field, '', $strpos, strlen('</span>'));
		}

		return $field;
	}
}

if (!is_admin() && !function_exists('wc_review_ratings_enabled')) {
	/**
	 * Check if reviews are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_reviews_enabled()
	{
		return 'yes' === get_option('woocommerce_enable_reviews');
	}

	/**
	 * Check if reviews ratings are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_review_ratings_enabled()
	{
		return wc_reviews_enabled() && 'yes' === get_option('woocommerce_enable_review_rating');
	}
}

if (!function_exists('understrap_quantity_input_classes')) {
	/**
	 * Add Bootstrap class to quantity input field.
	 *
	 * @param array $classes Array of quantity input classes.
	 * @return array
	 */
	function understrap_quantity_input_classes($classes)
	{
		$classes[] = 'form-control';
		return $classes;
	}
}

if (!function_exists('understrap_loop_add_to_cart_link')) {
	/**
	 * Wrap add to cart link in container.
	 *
	 * @param string $html Add to cart link HTML.
	 * @return string Add to cart link HTML.
	 */
	function understrap_loop_add_to_cart_link($html)
	{
		return '<div class="add-to-cart-container">' . $html . '</div>';
	}
}

if (!function_exists('understrap_loop_add_to_cart_args')) {
	/**
	 * Add Bootstrap button classes to add to cart link.
	 *
	 * @param array<string,mixed> $args Array of add to cart link arguments.
	 * @return array<string,mixed> Array of add to cart link arguments.
	 */
	function understrap_loop_add_to_cart_args($args)
	{
		if (isset($args['class']) && !empty($args['class'])) {
			if (!is_string($args['class'])) {
				return $args;
			}

			// Remove the `button` class if it exists.
			if (false !== strpos($args['class'], 'button')) {
				$args['class'] = explode(' ', $args['class']);
				$args['class'] = array_diff($args['class'], array('button'));
				$args['class'] = implode(' ', $args['class']);
			}

			$args['class'] .= ' btn btn-outline-primary';
		} else {
			$args['class'] = 'btn btn-outline-primary';
		}

		if ('bootstrap4' === get_theme_mod('understrap_bootstrap_version', 'bootstrap4')) {
			$args['class'] .= ' btn-block';
		}

		return $args;
	}
}

if (!function_exists('understrap_account_menu_item_classes')) {
	/**
	 * Add Bootstrap classes to the account navigation.
	 *
	 * @param string[] $classes Array of classes added to the account menu items.
	 * @return string[] Array of classes added to the account menu items.
	 */
	function understrap_account_menu_item_classes($classes)
	{
		$classes[] = 'list-group-item';
		$classes[] = 'list-group-item-action';
		if (in_array('is-active', $classes, true)) {
			$classes[] = 'active';
		}
		return $classes;
	}
}

//remove zoom from single product image on hover
function remove_image_zoom_support()
{
	remove_theme_support('wc-product-gallery-zoom');
}
add_action('wp', 'remove_image_zoom_support', 100);


/**************************************/
/* !- Custom Functions from here      */
/**************************************/

/* Breadcrumbs */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_filter('woocommerce_breadcrumb_defaults', 'echo_breadcrumb_args', 10, 1);
function echo_breadcrumb_args($args)
{
	$args = array(
		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'wrap_after' => '</nav>',
		'before' => '',
		'after' => '',
		'delimiter' => ' <i class="woocommerce-breadcrumb__delimiter icon-arrow-right"></i> ',
		'home' => _x('Home', 'breadcrumb', 'woocommerce'),
	);

	return $args;
}

add_action('woocommerce_before_single_product', 'mobile_title_area', 20);
function mobile_title_area()
{
	global $product;

	?>
	<div class="container-fluid single-product__title-area-mobile">
		<div class="row">
			<div class="col-12">
				<div class="single-product__breadbrumb">
					<?php if (function_exists('woocommerce_breadcrumb')) {
						woocommerce_breadcrumb();
					} ?>
				</div>

				<div class="single-product__title">
					<div class="product-title">
						<?php the_title('<h2 class="h1 product_title entry-title">', '</h2>'); ?>
					</div>
					<div class="product-rating-share">
						<a href="#reviews" style="margin-bottom: 1rem; text-decoration: none;">
							<div class="ruk_rating_snippet" data-sku="<?php echo $product->get_sku(); ?>"></div>
						</a>

						<div class="single-product__compare"><?php echo do_shortcode('[yith_compare_button]'); ?></div>

						<a type="button" class="btn--share" data-bs-toggle="modal" aria-label="Open Share Model"
							data-bs-target="#mobile-product-modal-<?php echo $product->get_ID(); ?>"><i
								class="icon-share-icon"></i><span>Share</span></a>
						<!-- Modal -->
						<div class="modal fade mobile-product-modal share-modal"
							id="mobile-product-modal-<?php echo $product->get_ID(); ?>" tabindex="-1"
							aria-labelledby="mobile-product-modalLabel-<?php echo $product->get_ID(); ?>"
							aria-hidden="true">
							<div class="modal-close-btn">
								<a class="btn btn--transparent btn-close" type="button" data-bs-dismiss="modal"
									aria-label="Close">Close</a>
							</div>
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<p class="h3">Share</p>
									</div>
									<div class="modal-body social-share">
										<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($product->ID)) ?>"
											target="_blank">
											<i class="icon-facebook"></i>
										</a>

										<a href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode(get_permalink($product->ID)) ?>"
											target="_blank">
											<i class="icon-interest"></i>
										</a>

										<a href="mailto:?body=<?php echo urlencode(get_permalink($product->ID)) ?>"
											title="Share by Email">
											<i class="icon-email-icon"></i>
										</a>

										<input type="hidden" id="hiddenField"
											value="<?php echo get_permalink($product->ID) ?>">
										<a class="btn--link" onclick="copyText()"><i class="icon-copy"></i>Copy Link</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="single-product__price-sale-badge">
					<p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
						<?php echo $product->get_price_html(); ?>
					</p>

					<?php
					if ($product->is_on_sale()) {
						$regular_price = $product->get_regular_price();
						$sale_price = $product->get_sale_price();

						if ($regular_price && $sale_price) {
							$percentage_saved = round((($regular_price - $sale_price) / $regular_price) * 100);
							echo '<span class="special-badge sale">Save ' . $percentage_saved . '%</span>';
						}
					}

					// For variable products, display sale percentage
					if ($product->is_type('variable') && $product->is_on_sale()) {
						$min_regular_price = null;
						$min_sale_price = null;

						foreach ($product->get_available_variations() as $variation) {
							$regular_price = $variation['display_regular_price'];
							$sale_price = $variation['display_price'];

							if (is_null($min_regular_price) || $regular_price < $min_regular_price) {
								$min_regular_price = $regular_price;
							}
							if (is_null($min_sale_price) || $sale_price < $min_sale_price) {
								$min_sale_price = $sale_price;
							}
						}

						if ($min_regular_price && $min_sale_price) {
							$percentage_saved = round((($min_regular_price - $min_sale_price) / $min_regular_price) * 100);
							echo '<span class="special-badge sale">Save ' . $percentage_saved . '%</span>';
						}
					}
					?>

					<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
				</div>

				<div class="single-product__mobile-buttons mb-4">
					<a class="btn btn--transparent btn-arrow-down" href="#build-order">Customise this product</a>

					<?php if (have_rows('other_sizes_available')) { ?>
						<a class="btn btn--transparent btn-arrow-down" href="#other-sizes">Other Sizes</a>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
<?php }

/* Sale badge */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3);
function woocommerce_custom_sale_text($text, $post, $product)
{
	global $product;
	?>

	<?php if ($product->is_on_sale()) { ?>
		<div class="loop-badge">
			<?php
			$regular_price = $product->get_regular_price();
			$sale_price = $product->get_sale_price();

			if ($regular_price && $sale_price) {
				$percentage_saved = round((($regular_price - $sale_price) / $regular_price) * 100);
				echo '<span class="special-badge sale">Save ' . $percentage_saved . '%</span>';
			}
	}

	// For variable products, display sale percentage
	if ($product->is_type('variable') && $product->is_on_sale()) {
		$min_regular_price = null;
		$min_sale_price = null;

		foreach ($product->get_available_variations() as $variation) {
			$regular_price = $variation['display_regular_price'];
			$sale_price = $variation['display_price'];

			if (is_null($min_regular_price) || $regular_price < $min_regular_price) {
				$min_regular_price = $regular_price;
			}
			if (is_null($min_sale_price) || $sale_price < $min_sale_price) {
				$min_sale_price = $sale_price;
			}
		}

		if ($min_regular_price && $min_sale_price) {
			$percentage_saved = round((($min_regular_price - $min_sale_price) / $min_regular_price) * 100);
			echo '<span class="special-badge sale">Save ' . $percentage_saved . '%</span>';
		} ?>

		</div>
	<?php }
}

/* Rating */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

/* Price */
add_filter('woocommerce_variable_sale_price_html', 'wpglorify_variation_price_format', 10, 2);
add_filter('woocommerce_variable_price_html', 'wpglorify_variation_price_format', 10, 2);
function wpglorify_variation_price_format($price, $product)
{

	// Main Price
	$prices = array($product->get_variation_price('min', true), $product->get_variation_price('max', true));
	$price = $prices[0] !== $prices[1] ? sprintf(__('%1$s', 'woocommerce'), wc_price($prices[0])) : wc_price($prices[0]);

	// Sale Price
	$prices = array($product->get_variation_regular_price('min', true), $product->get_variation_regular_price('max', true));
	sort($prices);
	$saleprice = $prices[0] !== $prices[1] ? sprintf(__('%1$s', 'woocommerce'), wc_price($prices[0])) : wc_price($prices[0]);

	if ($price !== $saleprice) {
		$price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
	}
	return $price;
}

add_filter('woocommerce_get_price_html', function ($price, $product) {
	if ($product->is_type('variation')) {
		if ($product->is_on_sale()) {
			$sale_price_with_tax = wc_get_price_including_tax($product, ['price' => $product->get_sale_price()]);
			return wc_price($sale_price_with_tax); // Show only sale price with VAT
		}
	}
	return $price;
}, 10, 2);

/* Hide Stock Message */
function my_wc_hide_in_stock_message()
{
	return '';
}

add_filter('woocommerce_stock_html', 'my_wc_hide_in_stock_message', 10, 3);

/* Button to Description */
add_action('woocommerce_before_add_to_cart_form', 'add_product_description_button', 7);
function add_product_description_button()
{
	global $product;
	if (!empty($product->get_description())) { ?>
		<a href="#product_description" class="link-to-description btn--link btn-arrow-down">Read product information</a>
	<?php }
}

/* Remove product category info */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

/* Add to cart */
// Single Product Page Add to Cart
// add_filter('woocommerce_product_single_add_to_cart_text', 'bbloomer_custom_add_cart_button_single_product', 9999);

// function bbloomer_custom_add_cart_button_single_product($label)
// {
// 	if (WC()->cart && !WC()->cart->is_empty()) {
// 		foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
// 			$product = $values['data'];
// 			if (get_the_ID() == $product->get_id()) {
// 				$label = 'In your basket';
// 				break;
// 			}
// 		}
// 	}
// 	return $label;
// }

add_filter('woocommerce_variation_is_active', 'custom_disabled_add_to_cart_message', 10, 2);

function custom_disabled_add_to_cart_message($is_active, $variation)
{
	// Only apply this to variable products
	if (!$is_active) {
		add_filter('woocommerce_get_price_html', function ($price) {
			return '<span class="please-select-message">Please select one answer for each of the product options</span>';
		});
	}
	return $is_active;
}

/* Quantity Selector */
/**
 * @snippet       Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 * @how-to        businessbloomer.com/woocommerce-customization
 * @author        Rodolfo Melogli, Business Bloomer
 * @compatible    WooCommerce 8
 * @community     https://businessbloomer.com/club/
 */
add_action('woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus');

function bbloomer_display_quantity_minus()
{
	if (!is_product())
		return;
	echo '<button type="button" class="minus" >-</button>';
}

add_action('woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus');

function bbloomer_display_quantity_plus()
{
	if (!is_product())
		return;
	echo '<button type="button" class="plus" >+</button>';
}

add_action('woocommerce_before_single_product', 'bbloomer_add_cart_quantity_plus_minus');

function bbloomer_add_cart_quantity_plus_minus()
{
	wc_enqueue_js("
      $('form.cart').on( 'click', 'button.plus, button.minus', function() {
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
         });

		 $('.sticky-add-to-cart-button .quantity').on( 'click', 'button.plus, button.minus', function() {
            var qty = $( this ).closest( '.sticky-add-to-cart-button .quantity' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
         });
   ");
}

add_action('woocommerce_share', 'custom_out_of_stock_message_under_price');
function custom_out_of_stock_message_under_price()
{
	global $product;

	if (!$product->is_in_stock()) {
		echo '<p><b>Back in Stock Soon</b></p>';
	}
}

/* Payment Icons */
add_action('woocommerce_share', 'product_payment_icons');
function product_payment_icons()
{ ?>
	<div class="single-product__payment-icons">
		<div class="d-flex align-items-center text-content">
			<i class="icon-secure-payments"></i>
			<span>Secure Payments</span>
		</div>
		<div class="payment-options">
			<img src="/wp-content/uploads/2025/01/Visa.svg" width="49" height="16" loading="lazy" />
			<img src="/wp-content/uploads/2025/01/American-Express.svg" width="49" height="16" loading="lazy" />
			<img src="/wp-content/uploads/2025/01/Mastercard.svg" width="49" height="16" loading="lazy" />
			<img src="/wp-content/uploads/2025/01/Maestro.svg" width="49" height="16" loading="lazy" />
			<img src="/wp-content/uploads/2025/01/Google_Pay_Logo.svg" width="49" height="16" loading="lazy" />
			<img src="/wp-content/uploads/2025/01/Apple-Pay.svg" width="49" height="16" loading="lazy" />
			<!-- <img src="/wp-content/uploads/2025/01/Paypal.svg" width="49" height="16" loading="lazy" /> -->
			<img src="/wp-content/uploads/2025/01/Klarna_Payment_Badge.svg" width="49" height="16" loading="lazy" />
		</div>
	</div>
<?php }

/* Request a sample */
add_action('woocommerce_share', 'linked_products');
function linked_products()
{
	global $product;

	if (have_rows('other_sizes_available')) { ?>
		<div id="other-sizes" class="linked-products-block">
			<h4>Other sizes available</h4>
			<?php while (have_rows('other_sizes_available')) {
				the_row();
				$option_label = get_sub_field('option_label');
				$linked_produt_id = get_sub_field('linked_products');

				?>
				<a href="<?php echo get_permalink($linked_produt_id) ?>"
					class="btn btn--transparent btn-arrow-right other-size-available">
					<?php echo $option_label; ?>
				</a>
			<?php } ?>

		</div>
	<?php }
}

/* Accordion information */
add_action('woocommerce_share', 'product_accordion');
function product_accordion()
{
	global $product;
	$id = $product->get_ID();
	?>
	<div class="single-product__accordions">
		<div class="row">
			<div class="col-12">

				<?php if (!empty($product->get_description())) { ?>
					<details class="accordion__item" open>
						<summary id="product_description" class="accordion accordion__question">
							<span class="accordion__question-text">Product information</span>
						</summary>
						<div class="accordion__answer">
							<?php echo wpautop($product->get_description()); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('features_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Features</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('features_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('specification_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Specifications</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('specification_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('comfort_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Comfort</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('comfort_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('dimensions_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Dimensions</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('dimensions_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('packages_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Packages</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('packages_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('assembly_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Assembly</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('assembly_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('design_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Design</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('design_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('fillings_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Fillings</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('fillings_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('technical_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Technical</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('technical_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('video_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Video</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('video_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('fabrics_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Fabrics</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('fabrics_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('covers_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Covers</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('covers_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!empty(get_field('designer_content', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Designer</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('designer_content', $id); ?>
						</div>
					</details>
				<?php } ?>

				<?php if (!has_term('sample-products', 'product_cat', $product->get_id())) { ?>
					<details class="accordion__item" open>
						<summary id="reviews" class="accordion accordion__question">
							<span class="accordion__question-text">Product reviews</span>
						</summary>
						<div class="accordion__answer reviews-area">
							<!-- <p class="reviews-area__title">Read our customer reviews for this product.
								<a class="btn btn--transparent btn-arrow-right d-none d-sm-block" type="button"
									data-bs-toggle="modal" aria-label="Open Review Model" data-bs-target="#reviewModal">
									Review this product
								</a>
							</p> -->
							<div id="ReviewsWidget"></div>
							<?php //echo comments_template(); ?>



							<!-- <a class="btn btn--transparent btn-arrow-right d-block d-sm-none mobile-reviews-btn" type="button"
								data-bs-toggle="modal" aria-label="Open Review Model" data-bs-target="#reviewModal">
								Review this product
							</a>

							<div class="modal fade reviews-modal" id="reviewModal" tabindex="-1"
								aria-labelledby="reviewModalLabel" aria-hidden="true">
								<div class="modal-close-btn">
									<a class="btn btn--transparent btn-close" type="button" data-bs-dismiss="modal"
										aria-label="Close">Close</a>
								</div>
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h3><i class="icon-customer-service"></i>Leave a product review</h3>
											<p>Please use the form below to leave your review of this product..</p>
										</div>
										<div class="modal-body">
											<?php
											if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())): ?>
												<div id="review_form_wrapper">
													<div id="review_form">
														<?php
														$commenter = wp_get_current_commenter();
														$comment_form = array(
															/* translators: %s is product title */
															'title_reply' => have_comments() ? esc_html__('Add a review', 'woocommerce') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
															/* translators: %s is product title */
															'title_reply_to' => esc_html__('Leave a Reply to %s', 'woocommerce'),
															'title_reply_before' => '<span id="reply-title" class="comment-reply-title">',
															'title_reply_after' => '</span>',
															'comment_notes_after' => '',
															'label_submit' => esc_html__('Submit review', 'woocommerce'),
															'class_submit' => 'btn btn--transparent',
															'logged_in_as' => '',
															'comment_field' => '',
														);

														$name_email_required = true;
														$fields = array(
															'author' => array(
																'label' => __('Name', 'woocommerce'),
																'type' => 'text',
																'value' => $commenter['comment_author'],
																'required' => $name_email_required,
															),
															'email' => array(
																'label' => __('Email', 'woocommerce'),
																'type' => 'email',
																'value' => $commenter['comment_author_email'],
																'required' => $name_email_required,
															),
														);

														$comment_form['fields'] = array();

														foreach ($fields as $key => $field) {
															$field_html = '<div class="comment-form-' . esc_attr($key) . '">';
															$field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);

															if ($field['required']) {
																$field_html .= '&nbsp;<span class="required">*</span>';
															}

															$field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></div>';

															$comment_form['fields'][$key] = $field_html;
														}

														$account_page_url = wc_get_page_permalink('myaccount');
														if ($account_page_url) {
															/* translators: %s opening and closing link tags respectively */
															$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
														}

														if (wc_review_ratings_enabled()) {
															$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__('Your rating', 'woocommerce') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</label><select name="rating" id="rating" required>
															<option value="">' . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
															<option value="5">' . esc_html__('Perfect', 'woocommerce') . '</option>
															<option value="4">' . esc_html__('Good', 'woocommerce') . '</option>
															<option value="3">' . esc_html__('Average', 'woocommerce') . '</option>
															<option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
															<option value="1">' . esc_html__('Very poor', 'woocommerce') . '</option>
														</select></div>';
														}

														$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your review', 'woocommerce') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

														comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
														?>
													</div>
												</div>
											<?php else: ?>
												<p class="woocommerce-verification-required">
													<?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?>
												</p>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div> -->

						</div>
					</details>
				<?php } ?>

				<?php //if (!empty(get_field('video_content', $id))) { ?>
				<!-- <details class="accordion__item" open>
					<summary id="question_block" class="accordion accordion__question">
						<span class="accordion__question-text">FAQs about this product</span>
					</summary>
					<div class="accordion__answer">
						No questions at the moment.
					</div>
				</details> -->
				<?php //} ?>

				<?php if (!empty(get_field('options_product_delivery_information', 'option')) || !empty(get_field('delivery_information', $id))) { ?>
					<details class="accordion__item" open>
						<summary class="accordion accordion__question">
							<span class="accordion__question-text">Delivery lead time</span>
						</summary>
						<div class="accordion__answer">
							<?php echo get_field('delivery_information', $id) ?: get_field('options_product_delivery_information', 'option'); ?>
						</div>
					</details>
				<?php } ?>
			</div>
		</div>
	</div>
<?php }

/* Title for orders builder */
add_action('woocommerce_before_variations_form', 'variation_block_title');
function variation_block_title()
{
	echo '<div id="build-order" class="variation-block__title">';
	echo '<h4>Customise this product</h4>';
	// echo '<a href="#question_block" class="link-to-description btn--link btn-question"><i class="icon-customer-service"></i><span>Got a question?</span></a>';
	echo '</div>';
}

add_action('woocommerce_before_add_to_cart_form', 'single_block_title');
function single_block_title()
{
	global $product;
	if ($product->get_type() !== 'variable') {
		echo '<div id="build-order" class="single-product-block__title">';
		echo '<h4>Customise this product</h4>';
		// echo '<a href="#question_block" class="link-to-description btn--link btn-question"><i class="icon-customer-service"></i><span>Got a question?</span></a>';
		echo '</div>';
	}
}

/* Product Addons */
add_filter('gettext', 'change_product_addons_subtotal_label', 20, 3);
function change_product_addons_subtotal_label($translated_text, $text, $domain)
{
	if ($domain === 'woocommerce-product-addons' && $text === 'Subtotal') {
		$translated_text = 'Total';
	}
	return $translated_text;
}

/* Request a sample */
add_action('wc_product_addon_start', 'request_sample_btn');
function request_sample_btn()
{
	// Dynamically get the addon ID to pass it along
	$addon_id = get_the_ID(); // This assumes you can get the current addon ID
	global $product;

	?>
	<div class="request-sample-block" data-addon-id="<?php echo esc_attr($addon_id); ?>">
		<div class="request-sample-block-label">
			<strong class="request-choice-label">Selected colour</strong>:
			<span class="request-sample-label">None</span>
		</div>
		<a href="#" class="btn btn--transparent btn-arrow-right add-sample-to-cart"
			data-addon-id="<?php echo esc_attr($addon_id); ?>"
			data-product-name="<?php echo esc_attr($product->get_name()); ?>">
			Request a sample
		</a>
		<button type="button" class="attribute-tooltip-sample" data-bs-toggle="tooltip" data-bs-placement="right"
			title="<?php echo get_field('request_sample_tooltip', 'option') ?: 'Click to request a physical sample of this color to see its true shade and texture before making a decision. You can add up to 5 samples to your cart free of charge.' ?>">?</button>
	</div>
<?php }

// Ajax action to check the current sample product count in the cart
add_action('wp_ajax_check_sample_product_count', 'check_sample_product_count');
add_action('wp_ajax_nopriv_check_sample_product_count', 'check_sample_product_count');

function check_sample_product_count()
{
	$sample_product_id = 7685; // Sample product ID
	$sample_count = 0;

	// Loop through the cart and count all instances of the sample product
	foreach (WC()->cart->get_cart() as $cart_item) {
		if ($cart_item['product_id'] == $sample_product_id) {
			$sample_count += $cart_item['quantity']; // Count the quantity of each entry
		}
	}

	wp_send_json_success(['count' => $sample_count]);
}

// Ajax action to add sample product to cart while enforcing the limit
add_action('wp_ajax_add_sample_product_to_cart', 'add_sample_product_to_cart');
add_action('wp_ajax_nopriv_add_sample_product_to_cart', 'add_sample_product_to_cart');

function add_sample_product_to_cart()
{
	if (!isset($_POST['sample_product_id']) || !isset($_POST['selected_addon']) || !isset($_POST['selected_choice'])) {
		wp_send_json_error(['message' => 'Invalid request.']);
		return;
	}

	$product_id = intval($_POST['sample_product_id']); // Sample product ID
	$selected_addon = sanitize_text_field($_POST['selected_addon']); // Selected add-on
	$selected_choice = sanitize_text_field($_POST['selected_choice']); // Selected choice
	$original_product_name = sanitize_text_field($_POST['original_product_name']); // Selected Product

	// Count how many samples are already in the cart
	$sample_count = 0;
	foreach (WC()->cart->get_cart() as $cart_item) {
		if ($cart_item['product_id'] == $product_id) {
			$sample_count += $cart_item['quantity'];
		}
	}

	// Prevent adding more if the limit (5) is reached
	if ($sample_count >= 5) {
		wp_send_json_error(['message' => 'You cannot add more than 5 sample products to your basket.']);
		return;
	}

	// Prepare custom cart item data
	$cart_item_data = [
		'selected_addon' => $selected_addon,
		'selected_choice' => $selected_choice,
		'sample_from_product' => $original_product_name
	];

	// Add product to cart with custom data
	$cart_item_key = WC()->cart->add_to_cart($product_id, 1, 0, [], $cart_item_data);

	if ($cart_item_key) {
		wp_send_json_success(['message' => 'Sample added to cart!']);
	} else {
		wp_send_json_error(['message' => 'Error adding sample to cart.']);
	}
}


add_filter('woocommerce_get_item_data', 'display_sample_product_meta', 10, 2);
function display_sample_product_meta($item_data, $cart_item)
{
	if (isset($cart_item['selected_addon'])) {
		$item_data[] = [
			'key' => wc_clean($cart_item['selected_choice']),
			'value' => wc_clean($cart_item['selected_addon'])
		];
	}

	if (isset($cart_item['sample_from_product'])) {
		$item_data[] = [
			'key' => 'Sample for',
			'value' => wc_clean($cart_item['sample_from_product']),
		];
	}
	return $item_data;
}

add_action('woocommerce_checkout_create_order_line_item', 'display_sample_product_order_meta', 10, 4);
function display_sample_product_order_meta($item, $cart_item_key, $values, $order)
{
	if (!empty($values['selected_addon']) && !empty($values['selected_choice'])) {
		// Store both as order item meta
		$item->add_meta_data($values['selected_choice'], $values['selected_addon'], true);
	}

	if (!empty($values['sample_from_product'])) {
		$item->add_meta_data('Sample for', $values['sample_from_product'], true);
	}
}

/* UPSELL Products */
//add_action('woocommerce_before_single_product_summary_custom', 'woocommerce_related_products', 15);
add_action('woocommerce_before_single_product_summary_custom', 'display_upsell_products_on_custom_hook', 15);
function display_upsell_products_on_custom_hook()
{
	global $product;

	if (!$product) {
		return;
	}

	$upsell_ids = $product->get_upsell_ids();

	if (!empty($upsell_ids)) {
		// Query for the upsell products
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1, // Change if you want a limit
			'post__in' => $upsell_ids,
			'orderby' => 'post__in',
		);

		$upsells = new WP_Query($args);
		?>

		<div class="feature-product-slider-block block block--margin">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-12 col-md-11 col-xl-11 col-xxl-12">
						<div class="text-block__header">
							<h2>Related Products</h2>
						</div>

						<div class="product-carousel carousel">
							<?php if ($upsells->have_posts()) { ?>
								<div class="product-carousel__carousel products">
									<?php while ($upsells->have_posts()):
										$upsells->the_post(); ?>
										<div class="product-carousel__item carousel__item">
											<?php get_template_part('woocommerce/content', 'product'); ?>
										</div>
									<?php endwhile; ?>
								</div>
								<?php wp_reset_postdata(); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		// Generate modals for each upsell
		$upsells->rewind_posts(); // rewind so we can loop again
		while ($upsells->have_posts()):
			$upsells->the_post();
			$id = get_the_ID(); ?>
			<!-- Modal -->
			<div class="modal fade product-slider-modal" id="product-slider-modal-<?php echo $id; ?>" tabindex="-1"
				aria-labelledby="product-slider-modalLabel-<?php echo $id; ?>" aria-hidden="true">
				<div class="modal-close-btn">
					<a class="btn btn--transparent btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">Close</a>
				</div>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<p class="h3">Share</p>
						</div>
						<div class="modal-body social-share">
							<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($id)) ?>"
								target="_blank">
								<i class="icon-facebook"></i>
							</a>
							<a href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode(get_permalink($id)) ?>"
								target="_blank">
								<i class="icon-interest"></i>
							</a>
							<a href="mailto:?body=<?php echo urlencode(get_permalink($id)) ?>" title="Share by Email">
								<i class="icon-email-icon"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile;
		wp_reset_postdata();

	} else { ?>
		<?php woocommerce_output_related_products(); ?>
	<?php }
}


/* Loop Actions */
add_action('woocommerce_after_shop_loop_item', 'loop_actions_button', 5);
function loop_actions_button()
{
	global $product;
	$product_id = get_the_ID();
	$category_slug = 'showroom-display'; // Replace with the category slug 
	?>
	<div class="product-buttons justify-content-between">
		<div class="d-flex align-items-center">
			<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
			<a type="button" class="btn--share" data-bs-toggle="modal" aria-label="Open Share Model"
				data-bs-target="#product-slider-modal-<?php echo $product->get_ID(); ?>">
				<i class="icon-share-icon"></i><span>Share</span>
			</a>
			<?php echo do_shortcode('[yith_compare_button]'); ?>
		</div>
		<?php if (has_term($category_slug, 'product_cat', $product_id)) { ?>
			<span><i class="icon-location-icon"></i> In our showroom</span>
		<?php } ?>
	</div>
<?php }

/* Checkout */
function chekout_title()
{ ?>
	<h1 class="text-block__heading">Checkout</h1>
<?php }
add_action('woocommerce_checkout_billing', 'chekout_title');

add_filter('woocommerce_shipping_package_name', 'custom_shipping_package_name');
function custom_shipping_package_name($name)
{
	return 'Delivery Choices';
}

add_filter('woocommerce_checkout_fields', 'custom_checkout_phone_label');
function custom_checkout_phone_label($fields)
{
	$fields['billing']['billing_phone']['label'] = 'Phone - preferably a mobile number';
	return $fields;
}

add_filter('woocommerce_cart_shipping_method_full_label', 'remove_free_label', 10, 2);
function remove_free_label($full_label, $method)
{
	if ($full_label == 'Local Pickup' || $full_label == 'Local pickup') {
		$full_label = 'Collect from our workshop close to Cambridge';
	}

	return $full_label;
}

add_action('woocommerce_after_shipping_rate', 'add_text_to_shipping_options');
function add_text_to_shipping_options($method)
{
	$quote_auxiliary_text = get_field('quote_auxiliary_text', 'option') ?: 'Please contact us directly for a custom delivery quote.';
	$royal_mail_auxiliary_text = get_field('royal_mail_auxiliary_text', 'option') ?: 'Fast and reliable delivery via Royal Mail First Class.';
	$ground_entrance_auxiliary_text = get_field('ground_entrance_auxiliary_text', 'option') ?: 'Your order will be delivered to the ground floor or entrance.';
	$upper_below_ground_auxiliary_text = get_field('upper_below_ground_auxiliary_text', 'option') ?: 'Delivery is available for upper floors or below ground level.';
	$local_pickup_auxiliary_text = get_field('local_pickup_auxiliary_text', 'option') ?: 'Pick up your order directly from our store.';

	if (!is_checkout()) {
		return;
	}

	// Define different text for each shipping method title
	$shipping_texts = array(
		'Please call us for a delivery quotation' => $quote_auxiliary_text,
		'Royal Mail First Class Post' => $royal_mail_auxiliary_text,
		'Delivery to the Ground Floor/Entrance' => $ground_entrance_auxiliary_text,
		'Upper Floor or Below Ground Floor Level' => $upper_below_ground_auxiliary_text,
		'Local pickup' => $local_pickup_auxiliary_text,
	);

	// Check if the shipping method title exists in the array and display the text
	if (isset($shipping_texts[$method->get_label()])) {
		echo '<p class="small">' . esc_html($shipping_texts[$method->get_label()]) . '</p>';
	}
}

add_filter('woocommerce_cart_totals', 'display_shipping_inclusive_of_tax');
function display_shipping_inclusive_of_tax($cart_totals)
{
	// Check if we're on the checkout page
	if (is_checkout()) {

		echo 'asd';
		// Get the shipping total including tax
		$shipping_total_incl_tax = WC()->cart->get_shipping_total() + WC()->cart->get_shipping_tax_total();

		// Format the total to include VAT
		$formatted_shipping_total = wc_price($shipping_total_incl_tax);

		// Replace the shipping total with the VAT-inclusive total
		$cart_totals['shipping']->value = $shipping_total_incl_tax;
		$cart_totals['shipping']->formatted_value = $formatted_shipping_total;
	}

	return $cart_totals;
}

add_filter('woocommerce_cod_process_payment_order_status', 'change_cod_payment_order_status', 10, 2);
function change_cod_payment_order_status($order_status, $order)
{
	return 'pending-payment';
}

add_action('woocommerce_review_order_before_payment', function () {
	echo '<h3 class="block--margin-md mb-3">' . esc_html__('Choose Payment') . '</h3>';
});

/**************************************/
/* !Shipping Options Ajax             */
/**************************************/
//https://wp-qa.com/move-checkout-shipping-options-in-woocommerce
add_filter('woocommerce_update_order_review_fragments', 'my_custom_shipping_table_update');
function my_custom_shipping_table_update($fragments)
{
	ob_start();
	?>
	<div class="shipping-options">
		<?php wc_cart_totals_shipping_html(); ?>
	</div>
	<?php
	$woocommerce_shipping_methods = ob_get_clean();
	$fragments['.shipping-options'] = $woocommerce_shipping_methods;
	return $fragments;
}

/* Category/Shop Page */
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_action('woocommerce_before_shop_loop', 'shop_page_filters', 10);
function shop_page_filters()
{ ?>

	<div class="row">
		<div class="col-12">
			<div class="sort-search-filters">
				<?php
				echo do_shortcode('[facetwp facet="sorting_filter"]');
				echo do_shortcode('[facetwp facet="product_search"]');
				?>
				<!-- <a class="btn btn--primary btn-arrow-right yith-woocompare-open" href="#">Comparision Menu</a> -->
			</div>
		</div>
	</div>

<?php }

/* WooCommerce Add to basket */
add_filter('woocommerce_product_add_to_cart_text', 'replace_loop_add_to_cart_button_text', 20, 2);
function replace_loop_add_to_cart_button_text($text, $product)
{
	if ($product->is_type('variable') && $product->is_purchasable()) {
		$text = __('Customise this product', 'woocommerce');
	}
	if ($product->is_type('simple') && $product->is_purchasable()) {
		$text = __('Customise this product', 'woocommerce');
	}
	return $text;
}

/* Basket update number in basket */
add_filter('woocommerce_add_to_cart_fragments', 'update_cart_count_fragments');
function update_cart_count_fragments($fragments)
{
	$fragments['.basket-count'] = '<span class="basket-count">' . WC()->cart->get_cart_contents_count() . '</span>';
	return $fragments;
}

add_action('wp_ajax_update_wishlist_count', 'update_wishlist_count_ajax');
add_action('wp_ajax_nopriv_update_wishlist_count', 'update_wishlist_count_ajax');
function update_wishlist_count_ajax()
{
	wp_send_json_success(array(
		'count' => yith_wcwl_count_products(),
	));
}

/* Tooltip for variations */
add_filter('woocommerce_attribute_label', 'custom_attribute_label', 10, 3);
function custom_attribute_label($label, $name, $product)
{
	// Check if we're on a single product page and if the attribute starts with 'pa_'
	if (is_product() && strpos($name, 'pa_') === 0) {
		// Get the attribute ID to fetch the tooltip
		$attribute_id = wc_attribute_taxonomy_id_by_name($name);
		$tooltip_text = get_option("wc_attribute_my_field-$attribute_id");

		// If there's a tooltip set, append it to the label
		if (!empty($tooltip_text)) {
			// Add the tooltip HTML next to the label
			$label .= '<button type="button" class="attribute-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="' . esc_attr($tooltip_text) . '">?</button>';
		}
	}

	return $label;
}

// Display the custom field for tooltip text on the attribute term page
add_action('woocommerce_after_add_attribute_fields', 'my_edit_wc_attribute_my_field');
add_action('woocommerce_after_edit_attribute_fields', 'my_edit_wc_attribute_my_field');
function my_edit_wc_attribute_my_field()
{
	$id = isset($_GET['edit']) ? absint($_GET['edit']) : 0;
	$value = $id ? get_option("wc_attribute_my_field-$id") : '';
	?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="tooltip_text">Tooltip Text</label>
		</th>
		<td>
			<!-- Change from input to textarea for a larger text block -->
			<textarea name="tooltip_text" id="tooltip_text" rows="4"
				cols="50"><?php echo esc_textarea($value); ?></textarea>
			<p class="description">Enter the tooltip text for this attribute term. It can be a larger description.</p>
		</td>
	</tr>
	<?php
}

// Save the tooltip text when the attribute is added or updated
add_action('woocommerce_attribute_added', 'my_save_wc_attribute_my_field');
add_action('woocommerce_attribute_updated', 'my_save_wc_attribute_my_field');
function my_save_wc_attribute_my_field($id)
{
	if (is_admin() && isset($_POST['tooltip_text'])) { // Check for 'tooltip_text'
		$option = "wc_attribute_my_field-$id";
		update_option($option, sanitize_textarea_field($_POST['tooltip_text'])); // Sanitize as textarea field
	}
}

// Delete the tooltip text when the attribute is deleted
add_action('woocommerce_attribute_deleted', function ($id) {
	delete_option("wc_attribute_my_field-$id");
});

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'custom_loop_product_thumbnail', 10);
function custom_loop_product_thumbnail()
{
	global $product;
	$size = 'full';

	$image_size = apply_filters('single_product_archive_thumbnail_size', $size);

	echo $product ? $product->get_image($image_size) : '';
}


// New order notification only for "Pending" Order status
add_action('woocommerce_checkout_order_processed', 'pending_new_order_notification', 20, 1);
function pending_new_order_notification($order_id)
{
	$order = wc_get_order($order_id);

	// Only for "pending" order status
	if (!$order->has_status('pending'))
		return;

	// Get the WooCommerce mailer
	$mailer = WC()->mailer();

	// Send "Customer Order Details" email (includes payment link)
	$order_details_email = $mailer->get_emails()['WC_Email_Customer_On_Hold_Order'];
	$order_details_email->trigger($order_id);

	// Send "New Order" email to admin and additional recipients
	$admin_email = $mailer->get_emails()['WC_Email_New_Order'];
	$admin_email->trigger($order_id);
}


add_action('woocommerce_after_order_itemmeta', function ($item_id, $item, $order) {
	if ($item->get_type() === 'line_item') {
		$product = $item->get_product();

		if ($product) {
			$regular_price = $product->get_regular_price();
			$sale_price = $product->get_sale_price();
			$discount_percentage = 0;

			if ($regular_price && $sale_price) {
				$discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100, 2);
			}

			if ($sale_price) {
				echo '<p><strong>Regular Price:</strong> ' . wc_price($regular_price) . '</p>';
				echo '<p><strong>Sale Price:</strong> ' . wc_price($sale_price) . '</p>';
				echo '<p><strong>Discount:</strong> ' . $discount_percentage . '%</p>';
			}
		}
	}
}, 10, 3);

// Discontinue status and redirect
add_action('init', function () {
	if (!session_id()) {
		session_start();
	}
});

add_action('template_redirect', 'redirect_discontinued_products');
function redirect_discontinued_products()
{
	if (is_singular('product')) {
		global $post;

		$is_discontinued = get_field('discontinue_product', $post->ID);
		if ($is_discontinued) {
			// Store product ID in session
			$_SESSION['discontinued_product_id'] = $post->ID;

			// Redirect to clean URL
			wp_redirect(home_url('/browse-our-latest/'));
			exit;
		}
	}
}

function display_related_products_from_session()
{
	if (!isset($_SESSION['discontinued_product_id'])) {
		return do_shortcode('[recent_products per_page="8" columns="4"]');
	}

	$product_id = intval($_SESSION['discontinued_product_id']);
	$product = wc_get_product($product_id);

	// Clear session so it doesn’t persist across pages
	unset($_SESSION['discontinued_product_id']);

	if (!$product) {
		return do_shortcode('[recent_products per_page="8" columns="4"]');
	}

	$related_ids = wc_get_related_products($product_id, 8);

	if (!empty($related_ids)) {
		return do_shortcode('[products ids="' . implode(',', $related_ids) . '" columns="4"]');
	}

	return do_shortcode('[recent_products per_page="8" columns="4"]');
}
add_shortcode('dynamic_related_products', 'display_related_products_from_session');

add_filter('woocommerce_my_account_my_orders_actions', 'remove_myaccount_orders_cancel_button', 10, 2);
function remove_myaccount_orders_cancel_button($actions, $order)
{
	unset($actions['cancel']);

	return $actions;
}

/* Checkout Extra Field */
add_filter('woocommerce_checkout_fields', 'add_title_to_checkout');
function add_title_to_checkout($fields)
{
	$fields['billing']['billing_title'] = array(
		'type' => 'select',
		'label' => __('Title', 'woocommerce'),
		'required' => false,
		'class' => array(''),
		'priority' => 5,
		'options' => array(
			'' => __('Select title', 'woocommerce'),
			'Mr' => __('Mr', 'woocommerce'),
			'Mrs' => __('Mrs', 'woocommerce'),
			'Miss' => __('Miss', 'woocommerce'),
			'Ms' => __('Ms', 'woocommerce'),
			'Mx' => __('Mx', 'woocommerce'),
		),
	);

	return $fields;
}

add_action('woocommerce_checkout_create_order', 'save_title_to_order', 10, 2);
function save_title_to_order($order, $data)
{
	if (!empty($_POST['billing_title'])) {
		$order->update_meta_data('_billing_title', sanitize_text_field($_POST['billing_title']));
	}
}

add_action('woocommerce_admin_order_data_after_billing_address', 'display_title_in_admin_order', 10, 1);
function display_title_in_admin_order($order)
{
	$title = $order->get_meta('_billing_title');
	if ($title) {
		echo '<p><strong>' . __('Title') . ':</strong> ' . esc_html($title) . '</p>';
	}
}

add_filter('woocommerce_email_customer_details_fields', 'add_title_to_email', 10, 3);
function add_title_to_email($fields, $sent_to_admin, $order)
{
	$title = get_post_meta($order->get_id(), '_billing_title', true);
	if ($title) {
		$fields['billing_title'] = array(
			'label' => __('Title', 'woocommerce'),
			'value' => $title,
		);
	}
	return $fields;
}

/* Custome field Company */
add_filter('woocommerce_checkout_fields', 'add_company_to_checkout');
function add_company_to_checkout($fields)
{
	$fields['billing']['billing_company'] = array(
		'type' => 'text',
		'label' => __('Company/Business name', 'woocommerce'),
		'required' => false,
		'class' => array('form-row-wide'),
		'priority' => 20,
	);

	return $fields;
}

add_action('woocommerce_checkout_create_order', 'save_company_to_order', 10, 2);
function save_company_to_order($order, $data)
{
	if (!empty($_POST['billing_company'])) {
		$order->update_meta_data('billing_company', sanitize_text_field($_POST['billing_company']));
	}
}

add_action('woocommerce_admin_order_data_after_billing_address', 'display_company_in_admin_order', 10, 1);
function display_company_in_admin_order($order)
{
	$title = $order->get_meta('billing_company');
	if ($title) {
		echo '<p><strong>' . __('Company/Business name') . ':</strong> ' . esc_html($title) . '</p>';
	}
}

add_filter('woocommerce_email_customer_details_fields', 'add_company_to_email', 10, 3);
function add_company_to_email($fields, $sent_to_admin, $order)
{
	$title = get_post_meta($order->get_id(), 'billing_company', true);
	if ($title) {
		$fields['billing_company'] = array(
			'label' => __('Company/Business name', 'woocommerce'),
			'value' => $title,
		);
	}
	return $fields;
}

/* Custome field Alternative number */
add_filter('woocommerce_checkout_fields', 'custom_add_alt_phone_checkout_field');
function custom_add_alt_phone_checkout_field($fields)
{
	// Add alternative phone number just after the main phone
	$fields['billing']['billing_alt_phone'] = array(
		'label' => __('Alternative Phone Number', 'woocommerce'),
		'required' => false,
		'class' => array('form-row-wide'),
		'priority' => 100,
	);
	return $fields;
}

add_action('woocommerce_checkout_update_order_meta', 'custom_save_alt_phone_checkout_field');
function custom_save_alt_phone_checkout_field($order_id)
{
	if (!empty($_POST['billing_alt_phone'])) {
		update_post_meta($order_id, '_billing_alt_phone', sanitize_text_field($_POST['billing_alt_phone']));
	}
}

add_action('woocommerce_admin_order_data_after_billing_address', 'custom_display_alt_phone_admin_order', 10, 1);
function custom_display_alt_phone_admin_order($order)
{
	$alt_phone = get_post_meta($order->get_id(), '_billing_alt_phone', true);
	if ($alt_phone) {
		echo '<p><strong>' . __('Alternative Phone') . ':</strong> ' . esc_html($alt_phone) . '</p>';
	}
}

add_filter('woocommerce_email_customer_details_fields', 'custom_add_alt_phone_to_emails', 10, 3);
function custom_add_alt_phone_to_emails($fields, $sent_to_admin, $order)
{
	$alt_phone = get_post_meta($order->get_id(), '_billing_alt_phone', true);
	if ($alt_phone) {
		$fields['billing_alt_phone'] = array(
			'label' => __('Alternative Phone', 'woocommerce'),
			'value' => $alt_phone,
		);
	}
	return $fields;
}



