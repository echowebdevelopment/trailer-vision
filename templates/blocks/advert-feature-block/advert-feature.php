<?php
/**********************************************************
 *
 * File:         Advert Feature
 * Description:  
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$layout = get_field('layout');

$link = get_field('button');
$featured = get_field('featured_image');

if ($layout == 'full-width') {
	$classes = 'advert-feature-full';
} else {
	$classes = 'advert-feature-inset';
}
?>

<div class="advert-feature-block block--padded-sm block--fullwidth <?php echo $classes; ?>">
	<div class="container-fluid">
		<div class="row">
			<?php if ($layout == 'inset') { ?>
				<div class="advert-feature-container col-11 col-lg-10 block--padded-md">
					<div class="angled-shadow"></div>
					<div class="corner-pulse"></div>
					<div class="row">
					<?php } ?>
					<div class="col-12 col-lg-5 advert-feature__content">
						<p class="section-tagline fade-in-left"><?php echo get_field('tagline'); ?></p>
						<h3 class="section-title fade-in-left"><?php echo get_field('title'); ?></h3>
						<div class="section-content fade-in-left">
							<?php echo get_field('description'); ?>
							<a href="<?php echo $link['url'] ?>" class="btn btn--primary">
								<?php echo $link['title'] ?>
							</a>
						</div>
					</div>
					<div class="col-12 col-lg-6 advert-feature__image">
						<?php echo wp_get_attachment_image($featured, 'full', false, array('class' => 'img-fluid image-shadow fade-in-right', 'loading' => 'lazy')) ?>
					</div>
					<?php if ($layout == 'inset') { ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>