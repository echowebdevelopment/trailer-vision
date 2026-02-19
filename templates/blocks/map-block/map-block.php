<?php
/**********************************************************
 *
 * File:         Text block
 * Description:  Text block
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading = get_field('heading');

$map_link = get_field('address_map_iframe_link', 'option');


?>

<div class="map-block block block--fullwidth">

	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-3 col-xl-3 col-xxl-2 block--padded-md">
				<?php if ($heading) { ?>
					<div class="map-block-content">
						<h2 class="text-block__heading fade-in-left" style="--delay: 0.2s;">
							<?php echo $heading; ?>
						</h2>
						<?php echo do_shortcode('[company-address]'); ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-12 col-lg-9 col-xl-9 col-xxl-10">
				<?php if ($map_link) { ?>
					<div class="map-block__map">
						<div class="angled-shadow"></div>
						<?php echo $map_link; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>