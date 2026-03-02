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

?>

<div class="block__main-menu block--bg-white">
	<nav class="navbar navbar-expand-xl p-0">

		<p id="main-nav-label" class="h2 screen-reader-text">
			<?php esc_html_e('Main Navigation', 'understrap'); ?>
		</p>

		<div class="<?php echo esc_attr($container); ?>">

			<?php get_template_part('global-templates/navbar-branding'); ?>

			<div class="menu-wrapper">

				<div class="row w-100 align-items-center justify-content-between d-xl-flex d-none">

					<div class="col-5">
						<?php echo do_shortcode('[fibosearch]'); ?>
					</div>

					<div class="col-6">
						<div class="main-submenu">
							<?php echo do_shortcode('[gtranslate]'); ?>
							<div class="submenu-account">
								<a href="/">Home</a>
								<a href="https://www.camos-uk.com/" target="_blank">Trade Customers</a>
								<?php echo do_shortcode('[login-account]'); ?>
							</div>
						</div>
					</div>

				</div>

				<div class="row w-100">

					<div class="col-12">

						<ul class="navbar-nav main-menu">

							<li class="d-none d-xl-block">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'container' => false,
										'menu_class' => 'navbar-nav justify-content-evenly pt-0',
										'fallback_cb' => '',
										'menu_id' => 'main-menu',
										'depth' => 2,
										'walker' => new Understrap_WP_Bootstrap_Navwalker(),
									)
								);
								?>
							</li>

							<li class="contact-menu">
								<?php echo do_shortcode('[phone-number]'); ?>
								<?php echo do_shortcode('[email-address]'); ?>
								<a class="account-link" href="<?php echo site_url('my-account/') ?>">
									<i class="icon-account"></i>
								</a>
								<a href="<?php echo wc_get_cart_url(); ?>" class="basket-link">
									<i class="icon-basket"></i>
									<?php if (WC()->cart->get_cart_contents_count() != 0) { ?>
										<span
											class="basket-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
									<?php } ?>
								</a>
							</li>

							<li class="d-lg-block d-xl-none">
								<nav class="navbar navbar-expand-xl">

									<button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
										data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas"
										aria-expanded="false">
										<i class="icon-menu"></i><span class="sr-only">Menu</span>
									</button>

									<div class="offcanvas offcanvas-end" tabindex="-1" id="navbarNavOffcanvas">

										<div class="offcanvas-body-menu">
											<button class="navbar-toggler border-0 p-0" type="button"
												data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas"
												aria-controls="navbarNavOffcanvas" aria-expanded="false">
												<i class="icon-cross"></i>
											</button>
											<?php
											wp_nav_menu(
												array(
													'theme_location' => 'primary',
													'container_class' => 'offcanvas-body',
													'container_id' => '',
													'menu_class' => 'navbar-nav justify-content-evenly pt-0 flex-grow-1',
													'fallback_cb' => '',
													'menu_id' => 'menu',
													'depth' => 2,
													'walker' => new Understrap_WP_Bootstrap_Navwalker(),
												)
											);
											?>
										</div>
									</div>
								</nav>
								
							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</nav>
</div>