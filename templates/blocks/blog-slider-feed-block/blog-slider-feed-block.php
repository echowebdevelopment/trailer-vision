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

$heading_size = get_field('heading_size_bog');

$acf_heading = get_field('heading_text_bog');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text_bog');
$subheading = $acf_subheading ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($acf_subheading)) : '';

$link = get_field('link_bog');

$loop_args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 6
);

$query = new WP_Query($loop_args);

?>

<div class="reviews-slider-block block block--margin">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
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
						<?php if ($link) {
							echo sprintf('<a class="btn btn--transparent" href="%1$s" target="%2$s">%3$s</a>', $link['url'], $link['target'], $link['title']);
						} ?>
					</div>

				</div>

				<div class="blog-carousel carousel">
					<?php if ($query->have_posts()): ?>
						<div class="blog-carousel__carousel blog">
							<?php while ($query->have_posts()):
								$query->the_post(); ?>
								<?php
								echo '<div>';
								get_template_part('template-parts/partials/card/card', get_post_type(), ['row_class' => 'flex-row-reverse']);
								echo '</div>';
								?>

							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>

	</div>
</div>