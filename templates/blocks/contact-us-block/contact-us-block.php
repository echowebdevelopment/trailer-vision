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

$heading_size = get_field( 'heading_size_contact' );

$acf_heading = get_field( 'heading_contact' );
$heading = $acf_heading ? sprintf( '<%1$s class="text-block__heading mb-0">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$content = get_field('content_contact');
$contact_form = get_field('form_contact');
$map_iframe = get_field('map_iframe', 'option');
?>

<div class="contact-us-block block--fullwidth block block--margin">
	<div class="container-fluid">
		<div class="row g-5 justify-content-between">
			<div class="col-12 col-xl-5">
				<div class="contact-header">
					<i class="icon-customer-service"></i><?php echo $heading; ?>
				</div>
				<p class="contact-content"><?php echo $content; ?></p>
				<?php echo do_shortcode('[contact-form-7 id="' . $contact_form . '" title="Contact Us Form"]'); ?>
			</div>
			<div class="col-12 col-xl-6">

				<div class="contact-us-information">
					<div class="row">
						<div class="col-12">
							<h4>How to contact us</h4>
						</div>
						<div class="col-12 col-md-6">
							<?php echo do_shortcode('[phone-number]');
							echo do_shortcode('[email-address]');
							echo do_shortcode('[opening-times]') ?>
							<p class="outside-times">
								Outside these times please leave a voicemail message and we will return your call on our
								return.
							</p>
						</div>
						<div class="col-12 col-md-6">
							<?php echo do_shortcode('[company-address]');
							echo do_shortcode('[get-directions]') ?>
						</div>

					</div>
				</div>
				<div class="col-12">
					<?php echo $map_iframe; ?>
				</div>

			</div>
		</div>
	</div>
</div>