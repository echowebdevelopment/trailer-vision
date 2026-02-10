<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

// Get main image and gallery images
$main_image_id = $product->get_image_id() ?: '9';
$gallery_image_ids = $product->get_gallery_image_ids();

$main_img_url = wp_get_attachment_image_url($main_image_id, 'full', null);

$image = get_post($main_image_id);
$image_caption = $image->post_excerpt ?: $product->get_title();
?>

<div class="single-product-images lightbox-gallery">

	<div class="single-product__main">
		<?php
		echo '<a href="' . $main_img_url . '" class="lightbox-gallery__link" data-sub-html="<div class=\'lightGallery-captions\'><p>' . $image_caption . '</p></div>">';
		echo wp_get_attachment_image($main_image_id, 'full', false, array('class' => 'single-product__main-img img-fluid', 'loading' => 'eager'));
		echo '</a>'; ?>
	</div>
	<?php if (!empty($gallery_image_ids)) { ?>
		<div class="single-product__gallery">
			<?php
			// Show the first and second images from the gallery
			$i = 1;
			foreach ($gallery_image_ids as $gallery_id) {
				$image = get_post($gallery_id);
				$image_caption = $image->post_excerpt ?: $product->get_title();
				$img_url = wp_get_attachment_image_url($gallery_id, 'full', null);

				echo '<div id="lightgallery" class="single-product__gallery-img img-' . $i . '">';
				echo '<a href="' . $img_url . '" class="lightbox-gallery__link" data-sub-html="<div class=\'lightGallery-captions\'><p>' . $image_caption . '</p></div>">';
				echo wp_get_attachment_image($gallery_id, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager'));
				echo '</a>';
				echo '</div>';

				$i++;
			} ?>
		</div>

		<!-- Button Below -->
		<div class="single-product__button">
			<a id="magic_start" href="#" class="btn btn--primary btn-arrow-right">See more photos</a>
		</div>
	<?php } ?>
</div>