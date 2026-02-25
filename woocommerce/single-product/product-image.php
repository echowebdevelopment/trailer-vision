<?php
defined('ABSPATH') || exit;

global $product;

// Main image
$main_image_id = $product->get_image_id() ?: '9';
$main_img_url = wp_get_attachment_image_url($main_image_id, 'full', null);
$image = get_post($main_image_id);
$image_caption = $image->post_excerpt ?: $product->get_title();

// Gallery images
$gallery_image_ids = $product->get_gallery_image_ids();
?>

<div class="single-product-images lightbox-gallery">

	<div class="single-product__main">
		<!-- <a href="<?php echo esc_url($main_img_url); ?>" class="lightbox-gallery__link main-lightbox-link"
			data-sub-html="<div class='lightGallery-captions'><p><?php echo esc_attr($image_caption); ?></p></div>"> -->
		<?php
		echo wp_get_attachment_image(
			$main_image_id,
			'full',
			false,
			array(
				'class' => 'single-product__main-img img-fluid',
				'id' => 'main-product-image',
				'loading' => 'eager'
			)
		);
		?>
		<!-- </a> -->
	</div>

	<?php if (!empty($gallery_image_ids)): ?>
		<div class="single-product__gallery">
			<div class="product-gallery-slider carousel">
				<?php
				$all_image_ids = array_merge([$main_image_id], $gallery_image_ids); // main + gallery
				$i = 1;
				foreach ($all_image_ids as $img_id):

					$img_url = wp_get_attachment_image_url($img_id, 'full');
					$thumbnail_url = wp_get_attachment_image_url($img_id, 'woocommerce_thumbnail');

					echo '<div class="single-product__gallery-img img-' . $i . '">';
					echo '<a href="' . esc_url($img_url) . '" 
                class="product-thumbnail-link" 
                data-full="' . esc_url($img_url) . '">';
					echo wp_get_attachment_image(
						$img_id,
						'woocommerce_thumbnail',
						false,
						array(
							'class' => 'img-fluid product-thumbnail',
							'loading' => 'lazy'
						)
					);
					echo '</a>';
					echo '</div>';

					$i++;
				endforeach;
				?>
			</div>
		</div>
	<?php endif; ?>
</div>

<div class="product-usp">
	<?php if (have_rows('product_usp', $product->get_ID())):
		while (have_rows('product_usp', $product->get_ID())):
			the_row();
			echo get_sub_field('text');
		endwhile;
	elseif (have_rows('options_product_usp', 'option')):
		while (have_rows('options_product_usp', 'option')):
			the_row();

			$text = get_sub_field('text');
			$image = get_sub_field('icon');
			$icon_label = get_sub_field('icon_label'); ?>

			<div class="product-usp-content">
				<?php if ($text): ?>
					<div class="product-usp-badge">
						<?php echo $text; ?>
					</div>
				<?php endif; ?>
				<?php if ($image): ?>
					<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')); ?>
				<?php endif; ?>
				<?php if ($icon_label): ?>
					<span>
						<?php echo $icon_label; ?>
					</span>
				<?php endif; ?>
			</div>
			
		<?php endwhile;
	endif; ?>
</div>