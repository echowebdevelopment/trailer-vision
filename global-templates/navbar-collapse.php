<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('echo_container_type');

$reviews_platform_logo = get_field('options_reviews_platform_logo', 'option');
$reviews_platform_link = get_field('options_reviews_platform_link', 'option');
?>

<div class="block__top-menu block--fullwidth block--bg-tertiary">
	<nav id="top-nav" class="navbar navbar-expand-md top-menu" aria-labelledby="top-nav-label">

		<div class="<?php echo esc_attr($container); ?>">

			<!-- The WordPress Menu goes here -->
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container_class' => 'collapse navbar-collapse',
					'container_id' => 'navbarNavDropdown',
					'menu_class' => 'navbar-nav ms-auto',
					'fallback_cb' => '',
					'menu_id' => 'top-menu',
					'depth' => 2,
					'walker' => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>

		</div><!-- .container(-fluid) -->

	</nav><!-- #main-nav -->
</div>

<div class="block__main-menu block--fullwidth block--bg-white">
	<nav class="navbar navbar-expand-xl navbar-light bg-light">

		<p id="main-nav-label" class="h2 screen-reader-text">
			<?php esc_html_e('Main Navigation', 'understrap'); ?>
		</p>

		<div class="<?php echo esc_attr($container); ?>">

			<!-- Your site branding in the menu -->
			<?php get_template_part('global-templates/navbar-branding'); ?>

			<!--<a href="<?php echo $reviews_platform_link ?>" target="_blank" class="reviews-logo-link">-->
				<?php echo wp_get_attachment_image($reviews_platform_logo, 'full', false, array('class' => 'reviews-logo img-fluid', 'loading' => 'eager')) ?>
			<!--</a>-->

			<div class="search-menu">
				<?php echo do_shortcode('[fibosearch]'); ?>
			</div>

			<ul class="navbar-nav main-menu">
				<li class="wishlist-col">
					<a class="wishlist-link" href="<?php echo site_url('wishlist/') ?>">
						<i class="icon-review-star-empty"></i>
						<span>Wishlist</span>
						<span class="wishlist-count"><?php echo yith_wcwl_count_products(); ?></span>
					</a>
				</li>
				<li class="compare-col">
					<a class="yith-woocompare-open" href="#">
						<i class="icon-Compare"></i>
						<span>Compare</span>
						<?php if (do_shortcode('[yith_woocompare_counter]') != 0) { ?>
							<span class="compare-count"><?php echo do_shortcode('[yith_woocompare_counter]') ?></span>
						<?php } ?>
					</a>
				</li>
				<li class="basket-col">
					<a href="<?php echo wc_get_cart_url(); ?>" class="basket-link">
						<i class="icon-basket"></i>
						<span>Basket</span>
						<?php if (WC()->cart->get_cart_contents_count() != 0) { ?>
							<span class="basket-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						<?php } ?>
					</a>
				</li>
				<li class="d-xl-none d-lg-block">
					<nav class="navbar navbar-expand-xl">
						<button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
							data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas"
							aria-expanded="false">
							<i class="navbar-toggler-icon"></i>
						</button>

						<div class="offcanvas bg-white offcanvas-end justify-content-between" tabindex="-1"
							id="navbarNavOffcanvas">

							<button class="btn-close btn-close-secondary text-secondary btn-close-mega" type="button"
								data-bs-dismiss="dropdown"
								aria-label="<?php esc_attr_e('Close menu', 'understrap'); ?>"><i
									class="icon-chevron_left"></i> Back</button>

							<div class="offcanvas-body-menu-1">
								<div>
									<!-- The WordPress Menu goes here -->
									<p class="h3 mobile-menu-title">Our Range</p>
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'shop-menu',
											'container_class' => 'offcanvas-body',
											'container_id' => '',
											'menu_class' => 'navbar-nav pt-0 flex-grow-1',
											'fallback_cb' => '',
											'menu_id' => 'shop-menu',
											'depth' => 2,
											'walker' => new Understrap_WP_Bootstrap_Navwalker(),
										)
									);
									?>
								</div>
								<div class="d-lg-none">
									<p class="h3 mobile-menu-title">General Information</p>
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
											'container_class' => 'offcanvas-body',
											'container_id' => '',
											'menu_class' => 'navbar-nav justify-content-evenly pt-0 flex-grow-1',
											'fallback_cb' => '',
											'menu_id' => 'top-menu',
											'depth' => 2,
											'walker' => new Understrap_WP_Bootstrap_Navwalker(),
										)
									);
									?>
								</div>
							</div>
							<div class="offcanvas-socials d-block d-xl-none">
								<div class="contacts">
									<?php echo do_shortcode('[phone-number]'), do_shortcode('[email-address]') ?>
								</div>
								<?php echo do_shortcode('[opening-times]') ?>
							</div>
						</div><!-- .offcanvas -->
					</nav>
				</li>

			</ul>

		</div><!-- .container(-fluid) -->

	</nav><!-- #main-nav -->
</div>

<div class="block__shop-menu block--fullwidth block--bg-secondary d-xl-block d-lg-none">
	<nav id="shop-nav" class="navbar navbar-expand-md shop-menu" aria-labelledby="shop-nav-label">

		<p id="main-nav-label" class="h2 screen-reader-text">
			<?php esc_html_e('Main Navigation', 'understrap'); ?>
		</p>

		<div class="<?php echo esc_attr($container); ?>">

			<div class="search-menu">
				<?php echo do_shortcode('[fibosearch]'); ?>
			</div>

			<!-- The WordPress Menu goes here -->
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'shop-menu',
					'container_class' => 'collapse navbar-collapse',
					'container_id' => 'navbarNavDropdown',
					'menu_class' => 'navbar-nav justify-content-between pt-0 flex-grow-1',
					'fallback_cb' => '',
					'menu_id' => 'shop-menu',
					'depth' => 2,
					'walker' => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>
		</div><!-- .container(-fluid) -->


	</nav><!-- #main-nav -->
</div>