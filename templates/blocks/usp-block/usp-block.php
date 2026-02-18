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

<?php if (have_rows('usp', 'options')): ?>
	<div class="usp-block block block--fullwidth block--padded-sm block--bg-coloured">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="usp-carousel carousel">
						<div class="usp-carousel__carousel">
							<?php while (have_rows('usp', 'options')):
								the_row();
								$icon = get_sub_field('icon');
								$title = get_sub_field('title');
								$i++;
								$delay = ($i - 1) * 0.2;
								?>
								<div class="usp__item carousel__item text-center">
									<?php echo wp_get_attachment_image($icon, 'full', false, array('class' => 'usp__img img-fluid fade-in-right', 'style' => '--delay: ' . $delay . 's;', 'loading' => 'lazy')) ?>
									<p class="usp__title fade-in-left" style="--delay: <?php echo $delay; ?>s;">
										<?php echo $title ?>
									</p>
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