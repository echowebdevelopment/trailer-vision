<?php
/**
 * Checkout terms and conditions area.
 *
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

if (apply_filters('woocommerce_checkout_show_terms', true) && function_exists('wc_terms_and_conditions_checkbox_enabled')) {
	do_action('woocommerce_checkout_before_terms_and_conditions');

	?>
	<div class="woocommerce-terms-and-conditions-wrapper">
		<?php
		/**
		 * Terms and conditions hook used to inject content.
		 *
		 * @since 3.4.0.
		 * @hooked wc_checkout_privacy_policy_text() Shows custom privacy policy text. Priority 20.
		 * @hooked wc_terms_and_conditions_page_content() Shows t&c page content. Priority 30.
		 */
		do_action('woocommerce_checkout_terms_and_conditions');
		?>

		<?php if (wc_terms_and_conditions_checkbox_enabled()): ?>
			<p class="form-row validate-required">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
						name="terms" <?php checked(apply_filters('woocommerce_terms_is_checked_default', isset($_POST['terms'])), true); // WPCS: input var ok, csrf ok. ?> id="terms" />
					<span
						class="woocommerce-terms-and-conditions-checkbox-text"><?php wc_terms_and_conditions_checkbox_text(); ?></span>&nbsp;<abbr
						class="required" title="<?php esc_attr_e('required', 'woocommerce'); ?>">*</abbr>
				</label>
				<input type="hidden" name="terms-field" value="1" />
			</p>


			<div class="modal fade terms-modal" id="termsModal" tabindex="-1" aria-labelledby="termsModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-close-btn">
						<a class="btn btn--transparent btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">Close</a>
					</div>
					<div class="modal-content">
						<div class="modal-body">
							<?php
							// Get the Terms & Conditions page content
							$terms_page_id = wc_get_page_id('terms'); // WooCommerce function to get Terms page ID
							if ($terms_page_id) {
								$terms_page = get_post($terms_page_id);
								echo apply_filters('the_content', $terms_page->post_content);
							} else {
								echo '<p>Terms and Conditions page not found.</p>';
							}
							?>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>
	</div>
	<?php

	do_action('woocommerce_checkout_after_terms_and_conditions');
}
