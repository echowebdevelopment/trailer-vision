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

$heading_size = get_field('heading_size');
$acf_heading = get_field('heading');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$content = get_field('content');

$location_horseboxes_trailers = get_field('location_horseboxes_trailers', 'option');
$location_motorhomes_caravans = get_field('location_motorhomes_caravans', 'option');

?>

<div class="find-us-block block block--fullwidth block--bg-coloured">
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
				<?php echo $location_horseboxes_trailers; ?>

				<?php echo $location_motorhomes_caravans; ?>
			</div>
		</div>
	</div>
</div>