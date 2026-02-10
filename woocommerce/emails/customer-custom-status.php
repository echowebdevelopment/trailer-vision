<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Customer Custom Status Email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-custom-status.php.
 */

do_action('woocommerce_email_header', $email_heading, $email);

?>

<p><?php echo wp_kses_post($email_content); ?></p>

<?php
do_action('woocommerce_email_footer', $email);
?>
