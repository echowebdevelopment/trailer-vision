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

$auxClass = "block--margin ";

if ( is_checkout() || is_product() || is_product_category() || is_shop() ) {
	$auxClass = "block--border-both block--padded";
}

?>

<?php if (have_rows('usp', 'options')): ?>
	<div class="usp-block block block--fullwidth <?php echo $auxClass; ?>">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="usp-carousel carousel">
						<div class="usp-carousel__carousel">
							<?php while (have_rows('usp', 'options')):
								the_row();
								$icon = get_sub_field('icon');
								$title = get_sub_field('title');
								$description = get_sub_field('description');
								?>
								<div class="usp__item carousel__item">
									<?php echo wp_get_attachment_image($icon, 'full', false, array('class' => 'usp__img img-fluid', 'loading' => 'lazy')) ?>
									<div class="usp__content">
										<p class="usp__title"><?php echo $title ?></p>
										<p class="usp__description"><?php echo $description ?></p>
									</div>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>