<?php
/**********************************************************
 *
 * File:         Social Block
 * Description:  Social Block
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     10/06/24
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size');

$acf_heading = get_field('heading');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading');
$subheading = $acf_subheading ? sprintf('<p class="text-block__subheading">%1$s</p>', $acf_subheading) : '';

?>

<div class="social-media-block block block--padded-md block--fullwidth">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?php if ($heading) { ?>
					<div class="text-block__header text-center fade-in-left">
						<?php echo $heading; ?>
						<?php if ($subheading) { ?>
							<?php echo $subheading; ?>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="col-12 fade-in-right">
					<?php echo do_shortcode('[instagram-feed feed=1]') ?>
				</div>
				<div class="col-12 fade-in-bottom">
					<div class="media-social-links text-center">
						<?php echo do_shortcode('[social-media]'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>