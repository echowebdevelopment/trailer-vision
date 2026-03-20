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

if ($product->is_type('variation')) {
	$parent_id = $product->get_parent_id();
	$parent_product = wc_get_product($parent_id);
	$parent_sku = $parent_product ? $parent_product->get_sku() : '';
} else {
	$parent_sku = $product->get_sku();
}

?>

<?php
// $StockQ = $product->get_stock_quantity();
// $badges = []; // collect badges here

// // ACF custom badge
// $message = get_field('custom_badge_text', $product->get_ID());
// $color = get_field('custom_badge_theme', $product->get_ID()) ?: 'primary';

// $messageInStock = get_field('in_stock_text', 'options') ?: 'In Stock';
// $messageSale = get_field('on_sale_text', 'options') ?: 'On Sale';
// $messageOutOfStock = get_field('out_of_stock_text', 'options') ?: 'Out of Stock';
// $messageBackOrder = get_field('back_order_text', 'options') ?: 'Back Order';

// // Custom Badge
// if ($message) {
// 	$badges[] = '<div class="special-badge ' . esc_attr($color) . '">' . esc_html__($message, 'woocommerce') . '</div>';
// } elseif ($product->is_on_sale()) {
// 	$badges[] = '<div class="special-badge red sale">' . esc_html__($messageSale, 'woocommerce') . '</div>';
// } elseif ($product->is_on_backorder()) {
// 	// Backorder
// 	$badges[] = '<div class="special-badge secondary preorder">' . esc_html__($messageBackOrder, 'woocommerce') . '</div>';
// } elseif ($product->is_in_stock() || $StockQ > 0) {
// 	// IN STOCK
// 	$badges[] = '<div class="special-badge primary instock">' . esc_html__($messageInStock, 'woocommerce') . '</div>';
// } elseif (!$product->is_in_stock() || $StockQ <= 0) {
// 	// OUT OF STOCK
// 	$badges[] = '<div class="special-badge tertiary outstock">' . esc_html__($messageOutOfStock, 'woocommerce') . '</div>';
// }

// // Output all badges
// if (!empty($badges)) {
// 	echo implode('', $badges);
// }
?>

<div class="single-product__price-sale-badge single-product__title-area-desktop">
	<p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
		<span class="price-label">From</span> <?php echo $product->get_price_html(); ?> <small class="price-incl-vat">incl. VAT</small>
	</p>

	<span class="product-sku"><?php echo $parent_sku; ?></span>
</div>