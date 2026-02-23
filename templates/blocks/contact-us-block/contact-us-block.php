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
$heading = $acf_heading ? sprintf( '<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$content = get_field('content_contact');
$contact_form = get_field('form_contact');
?>

<div class="contact-us-block block--fullwidth block block--padded block--bg-coloured">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-5">
				<div class="contact-us-information">
					<div class="text-block__header fade-in-right">
						<?php echo $heading; ?>
						<p class="contact-content"><?php echo $content; ?></p>
					</div>
					<div class="site-footer__contact-details fade-in-right">
						<?php echo do_shortcode('[phone-number]');
						echo do_shortcode('[email-address]');
						echo do_shortcode('[opening-times]') ?>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-5">
				<?php echo do_shortcode('[contact-form-7 id="' . $contact_form . '" title="Contact Us Form"]'); ?>
			</div>
		</div>
	</div>
</div>