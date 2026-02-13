<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('echo_container_type');
?>

<footer class="site-footer block border-top-secondary block--bg-primary" id="site-footer">

	<div class="site-footer__primary block--padded-md">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row">
				<div class="site-footer__logo col-12 col-lg-4 block--padded-sm">
					<?php dynamic_sidebar('footer-col-1'); ?>asd
				</div>
				<div class="site-footer__menu col-12 col-md-4 col-lg-2 block--padded-sm">
					<?php dynamic_sidebar('footer-col-2'); ?>asd
				</div>
				<div class="site-footer__menu col-12 col-md-4 col-lg-2 block--padded-sm">
					<?php dynamic_sidebar('footer-col-3'); ?>asd
				</div>
				<div class="site-footer__menu col-12 col-md-4 col-lg-4 block--padded-sm">
					<?php dynamic_sidebar('footer-col-4'); ?>asd
				</div>
			</div>
		</div>
	</div>

	<div class="site-footer__payment-icons block--padded-sm">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row align-items-center justify-content-center text-center site-footer__payment-icons-row">
				<?php dynamic_sidebar('footer-payment-icons'); ?>
			</div>
		</div>
	</div><!-- .site-info -->

	<div class="site-footer__disclaimer block--bg-primary">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row text-center site-footer__disclaimer-row">
				<?php dynamic_sidebar('footer-disclaimer'); ?>
			</div>
		</div>
	</div><!-- .site-info -->

	<span style="display:none;">website uptime string</span>
</footer><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
	function copyText() {
		// Get the hidden field
		const hiddenField = document.getElementById('hiddenField');

		// Create a temporary textarea element to hold the text to be copied
		const tempTextarea = document.createElement('textarea');
		tempTextarea.value = hiddenField.value;
		document.body.appendChild(tempTextarea);

		// Select the text and copy it to the clipboard
		tempTextarea.select();
		document.execCommand('copy');

		// Remove the temporary textarea
		document.body.removeChild(tempTextarea);

		// Show a message indicating that the text was copied
		alert("Text copied!");
	}

	function copyTextLoop() {
		// Find the closest modal
		const modal = event.target.closest('.modal');

		// Find the hidden field within this modal
		const hiddenField = modal.querySelector('.hiddenField');

		// Create a temporary textarea element to hold the text to be copied
		const tempTextarea = document.createElement('textarea');
		tempTextarea.value = hiddenField.value;
		document.body.appendChild(tempTextarea);

		// Select the text and copy it to the clipboard
		tempTextarea.select();
		document.execCommand('copy');

		// Remove the temporary textarea
		document.body.removeChild(tempTextarea);

		// Show a message indicating that the text was copied
		alert("Text copied!");
	}

	jQuery(function ($) {
		// Initialize Bootstrap tooltips (works on hover automatically)
		$('[data-bs-toggle="tooltip"]').tooltip();

		// Optional: Handle click event to show tooltip manually
		$(document).on('click', '.attribute-tooltip', function (e) {
			e.preventDefault(); // Prevent default action
			$(this).tooltip('show'); // Show tooltip manually
		});
	});

</script>

</body>

</html>