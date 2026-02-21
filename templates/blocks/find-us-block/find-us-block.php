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

$tab_1_text = get_field('tab_1_text') ?: 'Horseboxes & Trailers';
$tab_2_text = get_field('tab_2_text') ?: 'Motorhomes & Caravans';

$location_horseboxes_trailers = get_field('location_horseboxes_trailers', 'option');
$location_motorhomes_caravans = get_field('location_motorhomes_caravans', 'option');

?>

<div class="find-us-block block block--fullwidth block--bg-coloured block--padded-md">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<?php if ($heading) { ?>
					<?php echo $heading; ?>
				<?php } ?>
				<?php if ($content) { ?>
					<?php echo $content; ?>
				<?php } ?>
			</div>
			<div class="col-12 col-lg-10">
				<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">
							<?php echo $tab_1_text; ?>
						</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">
							<?php echo $tab_2_text; ?>
						</button>
					</li>
				</ul>

				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="tab1" role="tabpanel">
						<?php echo $location_horseboxes_trailers; ?>
					</div>

					<div class="tab-pane fade" id="tab2" role="tabpanel">
						<?php echo $location_motorhomes_caravans; ?>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>