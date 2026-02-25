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

$title = get_field('alternative_h1', $term);
$content = $term->description;

if (is_shop()) {
	$title = get_field('heading_shop', 'option') ?: 'Shop';
	$content = get_field('main_description_shop', 'option') ?: '';
}

$category_top_content = get_field('category_top_content', $term);
$category_bottom_content = get_field('category_bottom_content', $term);

if (is_shop()) {
	$category_top_content = get_field('category_top_content_shop', 'option');
	$category_bottom_content = get_field('category_bottom_content_shop', 'option');
}

if ($category_top_content) {
	$category_top = apply_filters('the_content', $category_top_content->post_content);
}

if ($category_bottom_content) {
	$category_bottom = apply_filters('the_content', $category_bottom_content->post_content);
}

$acf_heading = get_field('heading_cta', $term);
$heading_cta = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left">%2$s</%1$s>', 'h3', $acf_heading) : '';
$content_cta = get_field('content_cta', $term);

if (is_shop()) {
	$acf_heading = get_field('heading_cta_shop', 'option') ?: '';
	$heading_cta = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left">%2$s</%1$s>', 'h3', $acf_heading) : '';
	$content_cta = get_field('content_cta_shop', 'option') ?: '';
}

get_header('shop');

?>

<div class="page-header-block page-header-product-category block block--fullwidth block--padded-sm">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="single-product__breadcrumb">
					<?php if (function_exists('woocommerce_breadcrumb')) {
						woocommerce_breadcrumb();
					} ?>
				</div>
				<h1 class="section-title"><?php echo $title ?: woocommerce_page_title(); ?></h1>
				<?php if (!is_shop()) { ?>
					<a href="#left-sidebar" class="btn btn--primary btn-arrow-down">
						View products
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php if ($content) { ?>
	<div class="page-introduction-block block block--fullwidth block--padded-md">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10 fade-in-top">
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

	<?php if (wc_get_loop_prop('total') > wc_get_loop_prop('per_page')): ?>
		<div class="row">
			<div class="col-12">
				<?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($heading_cta): ?>
		<div class="advert-cta block--padded">
			<div class="container-fluid">
				<div class="row text-center justify-content-center">
					<div class="col-12 col-lg-10">
						<?php echo $heading_cta; ?>
						<?php if ($content_cta) { ?>
							<div class="advert-cta__content fade-in-left">
								<?php echo $content_cta; ?>
							</div>
						<?php } ?>
						<?php if (have_rows('buttons_cta', $term)): ?>
							<div class="block-buttons justify-content-center fade-in-left">
								<?php while (have_rows('buttons_cta', $term)):
									the_row(); ?>
									<?php
									$link = get_sub_field('link');
									$theme = get_sub_field('theme');
									if (empty($link)) {
										break;
									}

									echo sprintf('<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);

									?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>

						<?php if (is_shop()): ?>
							<?php if (have_rows('buttons_cta_shop', 'option')): ?>
								<div class="block-buttons justify-content-center fade-in-left">
									<?php while (have_rows('buttons_cta_shop', 'option')):
										the_row(); ?>
										<?php
										$link = get_sub_field('link');
										$theme = get_sub_field('theme');
										if (empty($link)) {
											break;
										}

										echo sprintf('<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);

										?>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

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

						<a href="mailto:?body=<?php echo urlencode(get_permalink($id)) ?>" title="Share by Email">
							<i class="icon-email"></i>
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