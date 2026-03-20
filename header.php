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

		</header><!-- #wrapper-navbar -->

		<?php if (is_product()) {
			global $product;
			$price_with_tax = wc_get_price_including_tax($product);
			if ($product->is_type('variation')) {
				$parent_id = $product->get_parent_id();
				$parent_product = wc_get_product($parent_id);
				$parent_sku = $parent_product ? $parent_product->get_sku() : '';
			} else {
				$parent_sku = $product->get_sku();
			}

			?>
			<div class="sticky-add-to-cart flex-column" style="display: none;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="sticky-content">
								<div class="sticky-product-title-block">
									<span class="sticky-product-title"><?php echo $product->get_title(); ?></span>
									<span class="product-sku d-none d-sm-block"><?php echo $parent_sku; ?></span>
								</div>
								<div class="d-block d-sm-none text-end" style="line-height: 1; font-size: 14px;">
									<a class="build-order" href="#build-order">
										View / Change your specification
									</a>
								</div>
								<div class="sticky-add-to-cart-options">
									<div class="mb-3 d-none d-sm-block">
										<a class="build-order" href="#build-order">
											View / Change your specification
										</a>
									</div>
									<div class="sticky-add-to-cart-button">
										<div class="total-price">
											<span class="label">From </span>
											<?php echo wc_price($price_with_tax); ?>
										</div>
										<a href="#" class="sticky_single_add_to_cart_button btn btn--primary">
											Add to Basket
										</a>
									</div>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

		<?php } ?>

		<div class="search-mobile">
			<?php echo do_shortcode('[fibosearch]'); ?>
			<?php echo do_shortcode('[gtranslate]'); ?>
		</div>

		<div class="promotional_message">
			<p><?php echo get_field('promotional_message', 'options'); ?></p>
		</div>