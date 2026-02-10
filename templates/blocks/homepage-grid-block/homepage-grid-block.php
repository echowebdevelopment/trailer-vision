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

$sideblock1 = get_field('slider_group_1_grid');
$heading1 = $sideblock1['heading_text_grid'] ? sprintf('<%1$s class="h3 text-block__heading">%2$s</%1$s>', $sideblock1['heading_size_grid'], $sideblock1['heading_text_grid']) : '';
$subheading1 = $sideblock1['subheading_text_grid'] ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($sideblock1['subheading_text_grid'])) : '';

$sideblock2 = get_field('slider_group_2_grid');
$heading2 = $sideblock2['heading_text_grid'] ? sprintf('<%1$s class="h4 text-block__heading">%2$s</%1$s>', $sideblock2['heading_size_grid'], $sideblock2['heading_text_grid']) : '';
$subheading2 = $sideblock2['subheading_text_grid'] ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($sideblock2['subheading_text_grid'])) : '';

$sideblock3 = get_field('slider_group_3_grid');
$heading3 = $sideblock3['heading_text_grid'] ? sprintf('<%1$s class="h4 text-block__heading">%2$s</%1$s>', $sideblock3['heading_size_grid'], $sideblock3['heading_text_grid']) : '';
$subheading3 = $sideblock3['subheading_text_grid'] ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($sideblock3['subheading_text_grid'])) : '';
?>

<div class="homepage-grid-block block block--fullwidth">
	<div class="row justify-content-center g-2">
		<div class="col-12 col-xl-7">

			<?php if (have_rows('slider_grid')): ?>
				<div class="hero-slider-carousel carousel">
					<?php while (have_rows('slider_grid')):
						the_row();
						$heading_size = get_sub_field('heading_size_grid');
						$acf_heading = get_sub_field('heading_text_grid');
						$acf_subheading = get_sub_field('subheading_text_grid');
						$image_grid = get_sub_field('image_grid');

						$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';
						$subheading = $acf_subheading ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($acf_subheading)) : '';

						$auxColor = '';
						$add_background_colour = get_sub_field('add_background_colour');
						if ($add_background_colour == 'yes') {
							$auxColor = 'bg-color-faded';
						}

						if ($i == 0) {
							$loading = 'eager';
							$i++;
						} else {
							$loading = 'lazy';
						}
						?>
						<div class="main__grid block--bg">
							<?php echo wp_get_attachment_image($image_grid, 'full', false, array('class' => 'block__bg img-fluid', 'loading' => $loading)); ?>
							<div class="main__grid-content block--fg">
								<?php if ($heading) { ?>
									<div class="text-block__header <?php echo $auxColor ?>">
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
													echo sprintf('<a class="btn btn--%1$s btn-arrow-right btn-no-border" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);
													?>
												<?php endwhile; ?>
											</div>
										<?php endif; ?>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-12 col-xl-5">

			<div class="row g-2">
				<div class="col-12 col-lg-4 col-xl-12">
					<div class="long__grid block--bg">
						<a href="<?php echo $sideblock1['link_grid']['url'] ?>"
							target="<?php echo $sideblock1['link_grid']['target'] ?>">
							<?php echo wp_get_attachment_image($sideblock1['image_grid'], 'full', false, array('class' => 'block__bg img-fluid', 'loading' => 'eager')); ?>
							<div class="long__grid-content block--fg">
								<?php if ($heading1) { ?>
									<div class="text-block__header">
										<?php echo $heading1; ?>
										<?php if ($subheading1) { ?>
											<?php echo $subheading1; ?>
										<?php } ?>
									</div>
								<?php } ?>
								<?php if ($sideblock1['link_grid']): ?>
									<?php if ($sideblock1['link_grid']['title']): ?>
										<div class="block-buttons">
											<span
												class="btn btn--<?php echo $sideblock1['theme_grid']; ?> btn-arrow-right"><?php echo $sideblock1['link_grid']['title']; ?>
											</span>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</a>
					</div>
				</div>
				<div class="col-6 col-lg-4 col-xl-6">
					<div class="small__grid block--bg">
						<a href="<?php echo $sideblock2['link_grid']['url'] ?>"
							target="<?php echo $sideblock2['link_grid']['target'] ?>">
							<?php echo wp_get_attachment_image($sideblock2['image_grid'], 'full', false, array('class' => 'block__bg img-fluid', 'loading' => 'eager')); ?>
							<div class="small__grid-content block--fg">
								<?php if ($heading2) { ?>
									<div class="text-block__header">
										<?php echo $heading2; ?>
										<?php if ($subheading2) { ?>
											<?php echo $subheading2; ?>
										<?php } ?>
									</div>
								<?php } ?>
								<?php if ($sideblock2['link_grid']): ?>
									<div class="block-buttons">
										<span
											class="btn btn--<?php echo $sideblock2['theme_grid']; ?> btn-arrow-right"><?php echo $sideblock2['link_grid']['title']; ?></span>
									</div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				</div>
				<div class="col-6 col-lg-4 col-xl-6">
					<div class="small__grid block--bg">
						<a href="<?php echo $sideblock3['link_grid']['url'] ?>"
							target="<?php echo $sideblock3['link_grid']['target'] ?>">
							<?php echo wp_get_attachment_image($sideblock3['image_grid'], 'full', false, array('class' => 'block__bg img-fluid', 'loading' => 'eager')); ?>
							<div class="small__grid-content block--fg">
								<?php if ($heading3) { ?>
									<div class="text-block__header">
										<?php echo $heading3 ?>
										<?php if ($subheading3) { ?>
											<?php echo $subheading3; ?>
										<?php } ?>
									</div>
								<?php } ?>
								<?php if ($sideblock3['link_grid']): ?>
									<div class="block-buttons">
										<span
											class="btn btn--<?php echo $sideblock3['theme_grid']; ?> btn-arrow-right"><?php echo $sideblock3['link_grid']['title']; ?></span>
									</div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>