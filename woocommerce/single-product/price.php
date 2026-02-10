<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $product;

?>

<div class="single-product__price-sale-badge single-product__title-area-desktop">
	<p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
		From <?php echo $product->get_price_html(); ?>
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