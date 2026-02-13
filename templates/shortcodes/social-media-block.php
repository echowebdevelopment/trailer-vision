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

$facebook = get_field('options_facebook_link', 'options');
$instagram = get_field('options_instagram_link', 'options');
$linkedin = get_field('options_linkedin_link', 'options');
$youtube = get_field('options_youtube_link', 'options');
?>

<div class="col-12">
    <p class="social-block__follow">Follow us</p>
    <div class="social-block__buttons">
        <?php if ($facebook) { ?>
            <a href="<?php echo $facebook; ?>" target="_blank"><i class="icon-facebook"></i></a>
        <?php }
        if ($instagram) { ?>
            <a href="<?php echo $instagram; ?>" target="_blank"><i class="icon-insta"></i></a>
        <?php }
        if ($linkedin) { ?>
            <a href="<?php echo $linkedin; ?>" target="_blank"><i class="icon-linkedin"></i></a>
        <?php }
        if ($youtube) { ?>
            <a href="<?php echo $youtube; ?>" target="_blank"><i class="icon-youtube"></i></a>
        <?php } ?>
    </div>
</div>