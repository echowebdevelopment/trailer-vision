<?php
/**********************************************************
 *
 * File:         Advert CTA
 * Description:  Call to action
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$acf_heading = get_field('heading');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left">%2$s</%1$s>', 'h3', $acf_heading) : '';

$content = get_field('content');

$change_background = get_field('change_background');

if ($change_background == 'plain') {
	$auxBg = 'block--bg-plain block--fullwidth';
} else {
	$auxBg = 'block--bg-coloured block--fullwidth';
}

?>
<div class="advert-cta block--padded <?php echo $auxBg; ?>">
	<div class="container-fluid">
		<div class="row text-center justify-content-center">
			<div class="col-12 col-lg-10">
				<?php echo $heading; ?>
				<?php if ($content) { ?>
					<div class="advert-cta__content fade-in-left">
						<?php echo $content; ?>
					</div>
				<?php } ?>
				<?php if (have_rows('buttons')): ?>
					<div class="block-buttons justify-content-center fade-in-left">
						<?php while (have_rows('buttons')):
							the_row(); ?>
							<?php
							$link = get_sub_field('link');
							$theme = get_sub_field('theme');
							if (empty($link)) {
								break;
							}

							echo sprintf('<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);

							?>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>