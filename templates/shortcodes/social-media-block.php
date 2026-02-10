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
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$facebook = get_field( 'options_facebook_link', 'options' );
$instagram = get_field( 'options_instagram_link', 'options' );
$pinterest = get_field( 'options_pinterest_link', 'options' );
?>

<div class="col-12">
    <p class="social-block__follow">Follow Us</p>
    <div class="social-block__buttons">
        <a href="<?php echo $facebook; ?>" target="_blank"><i class="icon-facebook"></i></a>
        <a href="<?php echo $instagram; ?>" target="_blank"><i class="icon-insta"></i></a>
        <a href="<?php echo $pinterest; ?>" target="_blank"><i class="icon-interest"></i></a>
    </div>
</div>