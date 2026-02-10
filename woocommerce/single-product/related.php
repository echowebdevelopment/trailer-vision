<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if ($related_products): ?>

	<section class="related products">

		<?php
		$heading = apply_filters('woocommerce_product_related_products_heading', __('Related Products', 'woocommerce'));

		if ($heading):
			?>
			<h2><?php echo esc_html($heading); ?></h2>
		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

		<?php foreach ($related_products as $related_product): ?>

			<?php
			$post_object = get_post($related_product->get_id());
			$id = $related_product->get_id();

			setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
	
			wc_get_template_part('content', 'product');
			?>

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

		<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();
