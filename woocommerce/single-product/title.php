<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $product;
?>

<div class="single-product__title single-product__title-area-desktop">
	<div class="product-title">
		<?php the_title('<h1 class="product_title entry-title">', '</h1>'); ?>
	</div>
	<div class="product-rating-share">
		<a href="#reviews" style="margin-bottom: 1rem; text-decoration: none;">
			<div class="ruk_rating_snippet" data-sku="<?php echo $product->get_sku(); ?>"></div>
		</a>

		<div class="single-product__compare"><?php echo do_shortcode('[yith_compare_button]'); ?></div>

		<a type="button" class="btn--share" data-bs-toggle="modal" aria-label="Open Share Model"
			data-bs-target="#product-modal-<?php echo $product->get_ID(); ?>"><i
				class="icon-share-icon"></i><span>Share</span></a>
		<!-- Modal -->
		<div class="modal fade product-modal share-modal" id="product-modal-<?php echo $product->get_ID(); ?>"
			tabindex="-1" aria-labelledby="product-modalLabel-<?php echo $product->get_ID(); ?>" aria-hidden="true">
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

						<input type="hidden" id="hiddenField" value="<?php echo get_permalink($product->ID) ?>">
						<a class="btn--link" onclick="copyText()"><i class="icon-copy"></i>Copy Link</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>