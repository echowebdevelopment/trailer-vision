<?php
/**********************************************************
 *
 * File:         Photo Divider
 * Description:  Use image to separate contents
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


$bg = get_field('photo-divider--bg') ? 'block--bg-'.get_field('photo-divider--bg') : 'block--bg-none';

$classes = array();
$classes[] = $bg;
$classes[] = $bg != 'block--bg-none' ? 'block--padded-sm' : 'block--margin-sm';
$page_img = get_field('bg_image');
?>
<div class="photo-divider block--fullwidth <?php echo implode(' ', $classes); ?>" style="" >
	<?php echo wp_get_attachment_image( $page_img, 'full', false, array('class'=>'img-fluid', 'loading' => 'lazy') ) ?>
</div>
