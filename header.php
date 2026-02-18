<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$navbar_type = get_theme_mod('understrap_navbar_type', 'collapse');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/maj3wuu.css">

	<link rel="stylesheet" href="https://assets.reviews.io/css/widgets/carousel-widget.css?_t=2025040415">
	<link rel="stylesheet" href="https://assets.reviews.io/iconfont/reviewsio-icons/style.css?_t=2025040415">
	<link rel="stylesheet" href="https://widget.reviews.io/rating-snippet/dist.css" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
	<?php do_action('wp_body_open'); ?>
	<div class="site" id="page">

		<!-- ******************* The Navbar Area ******************* -->
		<header id="wrapper-navbar" class="main-header">

			<a class="skip-link <?php echo understrap_get_screen_reader_class(true); ?>" href="#content">
				<?php esc_html_e('Skip to content', 'understrap'); ?>
			</a>

			<?php get_template_part('global-templates/navbar', $navbar_type); ?>

			<?php if (is_product()) {
				global $product;
				$price_with_tax = wc_get_price_including_tax($product); ?>
				<div class="sticky-add-to-cart flex-column" style="display: none;">
					<div class="sticky-content">
						<div class="total-price">
							<div class="d-flex flex-column">
								<span class="label">From </span>
								<?php echo wc_price($price_with_tax); ?>
							</div>
							<div class="d-block d-sm-none text-end" style="line-height: 1;">
								<a class="link-to-description btn--link" href="#build-order">
									View / Change your specification
								</a>
							</div>
						</div>
						<div class="sticky-add-to-cart-options">
							<div class="mb-3 d-none d-sm-block">
								<a class="link-to-description btn--link" href="#build-order">
									View / Change your specification
								</a>
							</div>
							<div class="sticky-add-to-cart-button">
								<?php
								woocommerce_quantity_input(
									array(
										'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
										'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
										'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
									)
								);
								?>
								<a href="#" class="sticky_single_add_to_cart_button btn btn--secondary">Add to
									Basket</a>
							</div>

						</div>
					</div>
				</div>

			<?php } ?>
		</header><!-- #wrapper-navbar -->