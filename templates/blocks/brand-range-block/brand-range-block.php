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

$heading_size = get_field('heading_size_range');
$heading_center = get_field('heading_center_range');

$acf_heading = get_field('heading_text_range');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text_range');
$subheading = $acf_subheading ? sprintf('<div class="text-block__subheading">%1$s</div>', wpautop($acf_subheading)) : '';

$auxCenter = '';
$auxCenterBtn = '';

if ($heading_center == 'yes') {
	$auxCenter = 'text-center';
	$auxCenterBtn = 'center-btns';
}

?>

<div class="brand-range-block block block--margin">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?php if ($heading) { ?>
					<div class="text-block__header <?php echo $auxCenter ?>">
						<?php echo $heading; ?>
						<?php if ($subheading) { ?>
							<?php echo $subheading; ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-12 col-md-11 col-xl-11 col-xxl-12 <?php echo $auxCenterBtn ?>">
				<?php if (have_rows('brands_range')): ?>
					<div class="brand-carousel__carousel d-flex">
						<?php while (have_rows('brands_range')):
							the_row('questions');
							$image = get_sub_field('image');
							$logo = get_sub_field('logo');
							$subtitle = get_sub_field('subtitle');
							$link = get_sub_field('link');
							$content = get_sub_field('content');
							?>
							<div class="d-inline-flex flex-column">
								<?php if ($link) { ?>
									<?php echo '<a class="brand-range-block__content" href="' . $link['url'] . '" target="' . $link['target'] . '">'; ?>
								<?php } ?>
								<div class="d-flex flex-column">
									<div class="brand-range-block__content-image">

										<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')); ?>

									</div>

									<div class="brand-range-block__content-logo">
										<?php echo wp_get_attachment_image($logo, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')); ?>
									</div>

									<p class="brand-range-block__content-subtitle"><?php echo $subtitle; ?></p>

									<?php if ($link) { ?>
										<div class="brand-range-block__content-link">
											<?php echo sprintf('<span class="btn btn--transparent">%1$s</span>', $link['title']); ?>
										</div>
									<?php } ?>

									<div class="brand-range-block__content-text">
										<?php echo wpautop($content); ?>
									</div>
								</div>
								<?php if ($link) {
									echo '</a>';
								} ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>