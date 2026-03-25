<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

$permalink = get_permalink($product->get_ID());

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}

$id = $product->get_id();
$main_features_content = get_field('main_features_content', $product->get_ID());
$gallery_image_ids = $product->get_gallery_image_ids();
$second_image = !empty($gallery_image_ids) ? wp_get_attachment_image($gallery_image_ids[0], 'woocommerce_thumbnail', false, array('class' => 'hover-image-menu img-fluid', 'loading' => 'lazy')) : '';

?>
<li <?php wc_product_class('', $product); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action('woocommerce_before_shop_loop_item');

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

	?>

	<div class="product-category__image">
		<?php echo get_the_post_thumbnail($product->get_id(), 'small', array('class' => 'main-image-menu img-fluid', 'loading' => 'lazy')); ?>
		<?php if ($second_image) {
			echo $second_image;
		} ?>
	</div>

	<?php

	do_action('woocommerce_before_shop_loop_item_title');

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action('woocommerce_shop_loop_item_title');

	?>

	<div class="grid-product-content">
		<?php echo $main_features_content; ?>
	</div>

	<?php

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	do_action('woocommerce_after_shop_loop_item_title');

	?>

	<div class="mt-auto">
		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 5);
		do_action('woocommerce_after_shop_loop_item');
		?>
	</div>

</li>