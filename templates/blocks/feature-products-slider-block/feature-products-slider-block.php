<?php
/**********************************************************
 *
 * File:         Page Header
 * Description:  Page Header
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     10/06/24
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size_prod_slider');

$acf_heading = get_field('heading_text_prod_slider');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$products = get_field('feature_products_prod_slider') ?: array();

$link = get_field('link_to_products');

$loop_args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'post__in' => $products,
	'posts_per_page' => 8
);

$query = new WP_Query($loop_args);

?>

<div class="feature-product-slider-block block block--padded block--fullwidth block--bg-plain-pattern">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12">
				<?php if ($heading) { ?>
					<div class="text-block__header text-center">
						<?php echo $heading; ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-12 col-lg-11 col-xl-11 col-xxl-12">
				<div class="product-carousel carousel">
					<?php if ($query->have_posts()) { ?>
						<div class="product-carousel__carousel products">
							<?php while ($query->have_posts()):
								$query->the_post();
								$id = get_the_ID(); ?>
								<div class="product-carousel__item carousel__item">
									<?php get_template_part('woocommerce/content', 'product'); ?>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					<?php } else { ?>
						<div class="woocommerce-no-products-found">
							<div class="woocommerce-info">
								No products selected.
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-12">
				<?php if ($link) { ?>
					<div class="slider-button text-center">
						<a class="btn btn--secondary" href="<?php echo $link['url']; ?>"
							target="<?php echo $link['target']; ?>">
							<?php echo $link['title']; ?>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php if ($query->have_posts()): ?>
		<?php while ($query->have_posts()):
			$query->the_post();
			$id = get_the_ID(); ?>
			<!-- Modal -->
			<div class="modal fade product-slider-modal" id="product-slider-modal-<?php echo $id; ?>" tabindex="-1"
				aria-labelledby="product-slider-modalLabel-<?php echo $id; ?>" aria-hidden="true">
				<div class="modal-close-btn">
					<a class="btn btn--transparent btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">Close</a>
				</div>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<p class="h3">Share <?php echo get_the_title($id); ?></p>
						</div>
						<div class="modal-body social-share">
							<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($id)) ?>"
								target="_blank">
								<i class="icon-facebook"></i>
							</a>

							<a href="mailto:?body=<?php echo urlencode(get_permalink($id)) ?>" title="Share by Email">
								<i class="icon-email"></i>
							</a>

							<a class="btn--link copy-link" data-link="<?php echo get_permalink($id); ?>">
								<i class="icon-copy"></i>Copy Link
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>