<?php
/**********************************************************
 *
 * File:         Page Title
 * Description:  Title block banner
 * Author:       Echo Web Solutions
 * Version:      v0.2
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$banner_layout = get_field('layout');
$bg = get_field('page-title--bg') ? 'block--bg-' . get_field('page-title--bg') : 'block--bg-none';

$classes = array();
$classes[] = 'layout--' . $banner_layout;
$classes[] = $bg;
$classes[] = $bg != 'block--bg-none';
$page_img = get_field('bg_image') ?: 9678;
$link = get_field('button');
?>
<div class="page-header-block block--fullwidth <?php echo implode(' ', $classes); ?>">
	<?php echo wp_get_attachment_image($page_img, 'full', false, array('class' => 'layout--' . $banner_layout . '__bg', 'loading' => 'eager')) ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-5 p-4 p-lg-5">
				<div class="single-product__breadbrumb">
					<?php if (function_exists('woocommerce_breadcrumb')) {
						woocommerce_breadcrumb();
					} ?>
				</div>
				<h1 class="section-title"><?php echo get_field('title'); ?></h1>
				<?php if (get_field('description')) { ?>
					<?php echo get_field('description'); ?>
				<?php } ?>
				<?php if ($link) { ?>
					<a href="<?php echo $link['url'] ?>" class="btn btn--primary btn-arrow-down">
						<?php echo $link['title'] ?>
					</a>

				<?php } ?>
			</div>
			<div class="col-lg-6 col-xl-7">

			</div>
		</div>
	</div>
</div>