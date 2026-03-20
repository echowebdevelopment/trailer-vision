<?php
/**********************************************************
 *
 * File:         Featured Category
 * Description:  Showcase featured category
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size');
$acf_heading = get_field('heading');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$subheading = get_field('subheading');

$discover_block = get_field('discover_block');

$link_to_shop = get_field('link_to_shop');
?>

<div class="discover-block block block--padded block--fullwidth">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<div class="row fade-in-left">
					<div class="col-12">
						<?php if ($heading) { ?>
							<div class="text-block__header text-center">
								<?php echo $heading; ?>
								<?php if ($subheading) { ?>
									<p>
										<?php echo $subheading; ?>
									</p>
								<?php } ?>
								<?php echo do_shortcode('[fibosearch]'); ?>
							</div>
						<?php } ?>

						<div class="discover-carousel__carousel carousel">
							<?php if ($discover_block): ?>
								<?php foreach ($discover_block as $term): ?>
									<?php
									$image = $term['image'];
									$title = $term['title'];
									$category_link = $term['category_link'];
									?>
									<div>
										<div class="category-card">
											<a href="<?php echo $category_link['url']; ?>">
												<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'category-card-image img-fluid image-shadow', 'loading' => 'lazy')); ?>
												<h3 class="category-card-title">
													<?php echo esc_html($title); ?>
												</h3>
												<span>See products <i class="icon-nav-forward"></i></span>
											</a>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<?php if ($link_to_shop) { ?>
				<div class="row block--margin-top-sm text-center">
					<div class="col-12">
						<a href="<?php echo $link_to_shop['url']; ?>" class="btn btn--primary fade-in-left">
							<?php echo $link_to_shop['title']; ?>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>