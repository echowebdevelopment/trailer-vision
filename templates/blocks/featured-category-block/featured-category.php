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

?>
<div class="featured-category block--margin">
	<div class="container-fluid">
		<div class="row">
			<?php if (have_rows('category_list')):
				while (have_rows('category_list')):
					the_row(); ?>
					<?php
					$links = get_sub_field('button');
					$featured = get_sub_field('featured_image');
					?>
					<div class="col-xxl-3 col-lg-3 col-md-6">
						<?php echo '<a href="' . $links['url'] . '" >' ?>
						<div class="card">
							<?php echo wp_get_attachment_image($featured, 'full', false, array('class' => 'card-img', 'loading' => 'lazy')) ?>
							<div class="card-img-overlay p-4">
								<h3 class="section-title"><?php echo get_sub_field('title'); ?></h3>
								<?php echo '<span class="btn">' . $links['title'] . '</span>'; ?>
							</div>
						</div>
						</a>
					</div>
				<?php endwhile;
			endif; ?>
		</div>
	</div>
</div>