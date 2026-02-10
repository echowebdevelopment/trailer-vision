<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

$term = get_queried_object();

$banner_layout = get_field('layout', $term) ?: 'fullwidth-image';
$bg = get_field('page-title--bg') ? 'block--bg-' . get_field('page-title--bg') : 'block--bg-none';

$classes = array();
$classes[] = 'layout--' . $banner_layout;
$classes[] = $bg;
$classes[] = $bg != 'block--bg-none';

$title = get_field('alternative_h1', $term);
$main_image = get_field('bg_image', $term) ?: 10889;
$content = $term->description;
$link = get_field('button');

$category_top_content = get_field('category_top_content', $term);
$category_bottom_content = get_field('category_bottom_content', $term);

if ($category_top_content) {
	$category_top = apply_filters('the_content', $category_top_content->post_content);
}

if ($category_bottom_content) {
	$category_bottom = apply_filters('the_content', $category_bottom_content->post_content);
}

get_header('shop');

?>

<div class="page-header-block block--fullwidth <?php echo implode(' ', $classes); ?>mb-5">
	<?php echo wp_get_attachment_image($main_image, 'full', false, array('class' => 'layout--' . $banner_layout . '__bg')) ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-5 p-4 p-lg-5">
				<div class="single-product__breadbrumb">
					<?php if (function_exists('woocommerce_breadcrumb')) {
						woocommerce_breadcrumb();
					} ?>
				</div>
				<h1 class="section-title"><?php echo $title ?: woocommerce_page_title(); ?></h1>
				<?php if (get_field('description', $term)) { ?>
					<p><?php echo get_field('description', $term); ?></p>
				<?php } ?>
				<!-- <?php if (get_field('description', $term)) { ?>
					<a href="#category-description" class="btn--link btn-arrow-down small">
						Read more
					</a>
				<?php } ?> -->
			</div>
			<div class="col-lg-6 col-xl-7">

			</div>
		</div>
	</div>
</div>

<?php if ($content) { ?>
	<div class="text-block block block--margin" id="category-description">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10">

					<?php echo wpautop($content); ?>

				</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php
if ($category_top_content) {
	echo $category_top;
}
?>

<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
//do_action('woocommerce_shop_loop_header');

if (woocommerce_product_loop()) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action('woocommerce_before_shop_loop');
	?>

	<div class="facetwp-template">
		<?php woocommerce_product_loop_start();

		if (wc_get_loop_prop('total')) {
			while (have_posts()) {

				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action('woocommerce_shop_loop');

				wc_get_template_part('content', 'product');

			}
		}

		woocommerce_product_loop_end(); ?>
	</div>

	<div class="row pagination-area">
		<div class="col-12 pagination-main">
			<div class="pagination-col text-center">
				<?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
			</div>
		</div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action('woocommerce_after_shop_loop');
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');

if ($category_bottom_content) {
	echo $category_bottom;
}

get_footer('shop');

if (is_tax('product_cat')) {
	$queried_object = get_queried_object(); // Get current taxonomy term
	$category_id = $queried_object->term_id; // Get category ID
} else {
	$category_id = ''; // No category, apply a different logic if needed
}

$args = array(
	'post_type' => 'product',
	'posts_per_page' => -1,
	'tax_query' => !empty($category_id) ? array(
		array(
			'taxonomy' => 'product_cat',
			'field' => 'term_id',
			'terms' => $category_id,
			'operator' => 'IN',
		),
	) : '',
);

$query = new WP_Query($args);


?>

<?php if ($query->have_posts()): ?>
	<?php while ($query->have_posts()):
		$query->the_post();
		$id = get_the_ID();
		?>
		<!-- Modal -->
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

						<input type="hidden" class="hiddenField" value="<?php echo get_permalink($id) ?>">
						<a class="btn--link" onclick="copyTextLoop()"><i class="icon-copy"></i>Copy Link</a>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>