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

$i = 0;
?>

<div class="homepage-slider-block block block--fullwidth">
	<div class="row">
		<div class="col-12">
			<?php if (have_rows('slider_grid')): ?>
				<div class="hero-slider-carousel carousel">
					<?php while (have_rows('slider_grid')):
						the_row();
						$heading_size = get_sub_field('heading_size_grid');
						$acf_heading = get_sub_field('heading_text_grid');
						$acf_subheading = get_sub_field('subheading_text_grid');
						$image_background = get_sub_field('image_background');
						$feature_image = get_sub_field('feature_image');

						$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';
						$subheading = $acf_subheading ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($acf_subheading)) : '';

						if ($i == 0) {
							$loading = 'eager';
							$i++;
						} else {
							$loading = 'lazy';
						}
						?>
						<div class="hero-slider block--bg">
							<?php echo wp_get_attachment_image($image_background, 'full', false, array('class' => 'block__bg img-fluid', 'loading' => $loading)); ?>
							<div class="hero-slider-content block--fg">
								<?php if ($heading) { ?>
									<div class="container-fluid">
										<div class="row gy-5 align-items-center">
											<div class="col-12 col-lg-4">
												<div class="text-block__header">
													<?php echo $heading; ?>
													<?php if ($subheading) { ?>
														<?php echo $subheading; ?>
													<?php } ?>
													<?php if (have_rows('buttons_text_grid')): ?>
														<div class="block-buttons">
															<?php while (have_rows('buttons_text_grid')):
																the_row(); ?>
																<?php
																$link = get_sub_field('link');
																$theme = get_sub_field('theme');
																if (empty($link)) {
																	break;
																}
																echo sprintf('<a class="btn btn--%1$s btn-no-border" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);
																?>
															<?php endwhile; ?>
														</div>
													<?php endif; ?>
												</div>
											</div>
											<div class="col-12 col-lg-8">
												<?php echo wp_get_attachment_image($feature_image, 'full', false, array('class' => 'feature-img img-fluid', 'loading' => $loading)); ?>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>