<?php
/**********************************************************
 *
 * File:         Advert CTA
 * Description:  Call to action
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$link = get_field('button');
$icon = get_field('icon_cta');
?>
<div class="advert-cta block--margin advert-layout--<?php echo get_field('layout') ?>">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 advert-cta__container">

				<h4 class="section-title">
					<?php if ($icon) {
						echo wp_get_attachment_image(get_field('icon_cta'), 'full', false, array('class' => 'usp__img img-fluid', 'loading' => 'lazy'));
					}
					echo get_field('title'); ?>
				</h4>
				<a href="<?php echo $link['url'] ?>"
					class="btn btn--transparent btn-arrow-right"><?php echo $link['title'] ?></a>
			</div>
		</div>
	</div>
</div>