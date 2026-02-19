<?php
/**********************************************************
 *
 * File:         Photo Gallery
 * Description:  Image Gallery
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');
$i = 0;
?>
<div class="photo-gallery block--margin lightbox-gallery">
	<?php if (have_rows('gallery')): ?>
		<div class="row gx-3 gy-4">
			<?php while (have_rows('gallery')):
				the_row();

				$image = get_sub_field('photo');
				$product_title = get_sub_field('product_title');

				$i++;
				$delay = ($i - 1) * 0.1;

				if ($image):

					$caption = '<div class="lightGallery-captions"><p>' . esc_html($product_title) . '</p></div>';
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="photo-gallery__item fade-in-left" style="--delay: <?php echo $delay; ?>s;">
							<a href="<?php echo esc_url($image['url']); ?>" class="lightbox-gallery__link"
								data-sub-html="<?php echo esc_attr($caption); ?>">

								<?php echo wp_get_attachment_image($image['id'], 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')); ?>
								<?php if ($product_title): ?>
									<span class="photo-gallery__title">
										<?php echo esc_html($product_title); ?>
									</span>
								<?php endif; ?>

							</a>
						</div>
					</div>
					<?php
				endif;
			endwhile; ?>
		</div>
	<?php endif; ?>
</div>