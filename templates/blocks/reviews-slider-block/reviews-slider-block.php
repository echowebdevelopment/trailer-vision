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

$acf_heading = get_field('heading_text_reviews');
$heading = $acf_heading ? sprintf('<h2 class="text-block__heading">%1$s</h2>', $acf_heading) : '';

$acf_subheading = get_field('subheading_text_reviews');
$subheading = $acf_subheading ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($acf_subheading)) : '';

$logo = get_field('reviews_logo');
$reviews = get_field('reviews') ?: array();

$loop_args = array(
	'post_type' => 'echo_reviews',
	'post_status' => 'publish',
	'post__in' => $reviews,
	'posts_per_page' => 6
);

$query = new WP_Query($loop_args);

?>

<div class="reviews-slider-block block block--padded block--bg-plain-pattern block--fullwidth">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-lg-3">
				<div class="reviews-slider__header fade-in-left">
					<?php if ($heading) { ?>
						<div class="text-block__header">
							<?php echo $heading; ?>
							<?php if ($subheading) { ?>
								<?php echo $subheading; ?>
							<?php } ?>
						</div>
					<?php } ?>
					<div class="reviews-slider__logo-link">
						<?php if (have_rows('buttons_reviews')): ?>
							<div class="block-buttons">
								<?php while (have_rows('buttons_reviews')):
									the_row(); ?>
									<?php
									$link = get_sub_field('link');
									$theme = get_sub_field('theme');
									$size = get_sub_field('size');
									if (empty($link)) {
										break;
									}

									echo sprintf('<a class="btn btn--%1$s btn--%5$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title'], $size);

									?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>

						<?php if ($logo) {
							echo wp_get_attachment_image($logo, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy'));
						}
						?>
					</div>
				</div>
			</div>

			<div class="col-12 col-lg-8 col-xl-7 col-xxl-6 offset-xl-1 offset-xxl-2">
				<div class="reviews-carousel carousel fade-in-right">
					<?php if ($query->have_posts()): ?>
						<div class="reviews-carousel__carousel reviews">
							<?php while ($query->have_posts()):
								$query->the_post();
								$rating = get_field('number_of_stars', get_the_ID());
								$review_subject = get_field('review_subject', get_the_ID());
								?>
								<div class="reviews-carousel__item carousel__item">
									<div class="reviews-carousel__block">
										<div class="reviews-carousel__block-content">
											<?php echo get_the_content(); ?>
										</div>
										<div class="reviews-carousel__block-stars">
											<?php if ($rating == 4) {
												for ($k = 0; $k < $rating; $k++) { ?>
													<i class="icon-star-solid"></i>
												<?php } ?>
												<i class="icon-star-solid grey-out"></i>
											<?php } else {
												for ($k = 0; $k < $rating; $k++) { ?>
													<i class="icon-star-solid"></i>
												<?php }
											} ?>
										</div>
										<div class="reviews-carousel__block-footer">
											<span class="reviews-carousel__block-author"><?php echo get_the_title(); ?></span>
											|
											<span class="reviews-carousel__block-subject"><?php echo $review_subject; ?></span>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>