<?php
/**********************************************************
 *
 * File:         Contact Us
 * Description:  Contact Us
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$acf_heading = get_field('heading_newsletter', 'option');
$heading = $acf_heading ? sprintf('<h2 class="text-block__heading">%1$s</h2>', $acf_heading) : '';

$content = get_field('content_newsletter', 'option');
$tagline = get_field('tagline_newsletter', 'option');

$contact_form = get_field('newsletter_form_newsletter', 'option');
?>

<div class="newsletter-block block--fullwidth block block--padded">
	<div class="corner-pulse"></div>
	<div class="container-fluid">
		<div class="row justify-content-between align-items-center fade-in-right">
			<div class="col-12 col-lg-4">
				<?php if ($heading) { ?>
					<div class="text-block__header">
						<?php echo $heading; ?>
						<?php if ($content) { ?>
							<div class="newsletter-content">
								<h4><?php echo $content; ?></h4>
							</div>
						<?php } ?>
						<?php if ($tagline) { ?>
							<div class="newsletter-tagline">
								<p><i class="icon-email"></i><?php echo $tagline; ?></p>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-12 col-lg-6">
				<?php echo do_shortcode('[contact-form-7 id="' . $contact_form . '" title="Contact Us Form"]'); ?>
			</div>
		</div>
	</div>
</div>