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

$heading_size = get_field('heading_size_reviews');

$acf_heading = get_field('heading_text_reviews');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text_reviews');
$subheading = $acf_subheading ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($acf_subheading)) : '';


$link = get_field('link');
$logo = get_field('reviews_logo');
// $reviews = get_field('reviews') ?: array();

// $loop_args = array(
// 	'post_type' => 'echo_reviews',
// 	'post_status' => 'publish',
// 	'post__in' => $reviews,
// 	'posts_per_page' => 6
// );

// $query = new WP_Query($loop_args);

?>

<div class="reviews-slider-block block block--margin">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-11 col-xl-11 col-xxl-12">
				<div class="reviews-slider__header">
					<?php if ($heading) { ?>
						<div class="text-block__header">
							<?php echo $heading; ?>
							<?php if ($subheading) { ?>
								<?php echo $subheading; ?>
							<?php } ?>
						</div>
					<?php } ?>
					<div class="reviews-slider__logo-link">
						<?php if ($logo) {
							echo wp_get_attachment_image($logo, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy'));
						}
						if ($link) {
							echo sprintf('<a class="btn btn--transparent" href="%1$s" target="%2$s">%3$s</a>', $link['url'], $link['target'], $link['title']);
						} ?>
					</div>

				</div>

				<div class="reviews-carousel carousel">

					<div id="reviewsio-carousel-widget"></div>
					
					<?php /*if ($query->have_posts()): ?>
						<div class="reviews-carousel__carousel reviews">
						<?php while ($query->have_posts()):
								$query->the_post(); ?>
								<div class="reviews-carousel__item carousel__item">
									<div class="reviews-carousel__block">
										<span class="reviews-carousel__block-content"><?php echo get_the_content(); ?></span>
										<span class="reviews-carousel__block-stars">
											<?php for ($k = 0; $k < 5; $k++) { ?>
												<i class="icon-review-star-full"></i>
											<?php } ?>
										</span>
										<p class="reviews-carousel__block-name"><?php echo get_the_title(); ?></p>
									</div>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					<?php endif; */ ?>
				</div>

			</div>
		</div>

	</div>
</div>