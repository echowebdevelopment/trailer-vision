<?php
/**********************************************************
 *
 * File:         Advert Feature
 * Description:  Showcase Product
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$link = get_field('button');
$featured = get_field('featured_image');	
?>
<div class="advert-feature block--margin advert-layout--<?php echo get_field('layout') ?>" >
	<div class="container-fluid advert-feature__container">
		<div class="row">
			<div class="col-lg-6 advert-feature__image">
				<?php echo wp_get_attachment_image( $featured, 'full', false, array('class'=>'', 'loading' => 'lazy') ) ?>
			</div>
			<div class="col-lg-6 advert-feature__content">
				<h5 class="section-tagline"><?php echo get_field('tagline'); ?></h5>
				<h3 class="section-title"><?php echo get_field('title'); ?></h3>
				<?php echo get_field('description'); ?>

				<a href="<?php echo $link['url'] ?>" class="btn btn--primary btn-arrow-right"><?php echo $link['title'] ?></a>
			</div>
		</div>
	</div>
</div>
