<?php
/**********************************************************
 *
 * File:         FAQ Accordion
 * Description:  FAQ Accordion
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size_faq');
$subheading_size = get_field('subheading_size_faq');

$acf_heading = get_field('heading_text_faq');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text_faq');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading fade-in-left" style="--delay: 0.4s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$link_all_faqs = get_field('link_all_faqs');

$i = 1;
?>


<div class="accordion-block block block--padded-md block--bg-plain-pattern block--fullwidth">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<?php if ($heading) { ?>
					<div class="text-block__header text-center">
						<?php echo $heading; ?>
						<?php if ($subheading) { ?>
							<?php echo $subheading; ?>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="faq">
					<?php while (have_rows('questions')):
						the_row('questions');
						$i++;
						$delay = ($i - 1) * 0.2; ?>
						<details id="faq-id-<?php echo $i ?>" class="accordion__item fade-in-left"
							style="--delay: <?php echo $delay; ?>s;">
							<summary class="accordion accordion__question">
								<?php echo get_sub_field('q'); ?>
							</summary>
							<div class="accordion__answer">
								<?php echo wpautop(get_sub_field('a')); ?>
							</div>
						</details>
						<?php $i++;
					endwhile; ?>
				</div>

				<div class="block-buttons justify-content-center">
					<?php echo sprintf('<a class="btn btn--primary" href="%1$s" target="%2$s">%3$s</a>', $link_all_faqs['url'], $link_all_faqs['target'], $link_all_faqs['title']); ?>
				</div>
			</div>
		</div>

		<?php if (have_rows('questions')): ?>
			<?php
			$count = get_field('questions');
			$j = 1;
			?>
			<script type="application/ld+json">
							{
							"@context": "https://schema.org",
							"@type": "FAQPage",
							"mainEntity": [
								<?php while (have_rows('questions')):
									the_row('questions'); ?>
												{
													"@type": "Question",
													"name": "<?php echo get_sub_field('q'); ?>",
														"acceptedAnswer": {
														"@type": "Answer",
														"text": "<?php echo esc_attr(wp_strip_all_tags(get_sub_field('a'))); ?>"
													}
												}
												<?php if ($j < count($count)) {
													echo ',';
													$j++;
												} ?>
								<?php endwhile; ?>
							]
							}
						</script>
		<?php endif; ?>
	</div>
</div>