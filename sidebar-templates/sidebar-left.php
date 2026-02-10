<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!is_active_sidebar('left-sidebar')) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod('echo_sidebar_position');
?>

<?php if ('both' === $sidebar_pos): ?>
	<div class="col-xl-3 widget-area me-4" id="left-sidebar">
	<?php else: ?>
		<div class="col-xl-3 widget-area me-4" id="left-sidebar">
		<?php endif; ?>

		<div class="shop-filters-block">
			<details class="shop-filters d-none d-xl-block accordion__item" open>
				<summary class="main-filter accordion accordion__question">
					<h2 class="accordion__question-text">Filters</h2>
				</summary>
				<div class="accordion__answer">
					<?php dynamic_sidebar('left-sidebar'); ?>
				</div>
			</details>

			<details id="shop-filters" class="shop-filters d-block d-xl-none accordion__item">
				<summary class="main-filter accordion accordion__question">
					<h2 class="accordion__question-text">Filters</h2>
				</summary>
				<div class="accordion__answer">
					<?php dynamic_sidebar('left-sidebar'); ?>
				</div>
			</details>
		</div>

	</div><!-- #left-sidebar -->