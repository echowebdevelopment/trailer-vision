<?php
/**********************************************************
 *
 * File:         Photo Collage
 * Description:  Image Gallery
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

?>
<div class="photo-collage block--fullwidth block--margin">
	<ul class="photo-collage__gallery">
		<?php
		// Check rows exists.
		if (have_rows('gallery')):

			// Loop through rows.
			while (have_rows('gallery')):
				the_row();

				// Load sub field value.
				$image = get_sub_field('photo');
				$product_link = get_sub_field('product_link');

				if ($product_link) {
					$product_url = $product_link['url'];
				} else {
					$product_url = '#';
				}

				echo '<li><a href="' . $product_url . '">' . wp_get_attachment_image($image, 'full', false, array('class' => '', 'loading' => 'lazy')) . '</a></li>';

				// End loop.
			endwhile;

			// No value.
		else:
			// Do something...
		endif;
		?>
	</ul>
</div>