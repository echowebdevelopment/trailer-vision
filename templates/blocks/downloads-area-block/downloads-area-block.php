<?php
/**********************************************************
 *
 * File:         Text block
 * Description:  Text block
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$acf_heading = get_field('heading');
$heading = $acf_heading ? sprintf('<h2 class="text-block__heading fade-in-left" style="--delay: 0.2s;">%1s</h2>', $acf_heading) : '';

$feature_area_title = get_field('feature_area_title');
$feature_document_image = get_field('feature_document_image');
$feature_document_link = get_field('feature_document_link');

$trade_catalogue_title = get_field('trade_catalogue_title');
$trade_document_content = get_field('trade_document_content');
$trade_area_link = get_field('trade_area_link');

?>

<div class="download-area-block block block--margin">
	<div class="row g-5 justify-content-center">
		<div class="col-12 col-xl-7">
			<?php if ($heading) { ?>
				<div class="text-block__header">
					<?php echo $heading; ?>
				</div>
			<?php } ?>
			<?php if( have_rows('download_section') ): ?>
				<div class="downoad-lists">
                    <?php while( have_rows('download_section') ): 
						the_row(); 
						$secton_title = get_sub_field('section_title');
						?>
                        <div>
                            <h3><?php echo $secton_title; ?></h3>
                            <?php if( have_rows('documents') ): ?>
                                <ul>
                                <?php  while( have_rows('documents') ): 
									the_row(); 
									$doc_name = get_sub_field('name_of_document');
									$link = get_sub_field('link_to_document');
									?>
									<a href="<?php echo $link['url']; ?>" target="_blank">
										<li>
											<h4><?php echo $doc_name; ?></h4>
											<span><?php echo $link['title']; ?><i class="icon-download"></i></span>
										</li>
									</a>
                                <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>    

                    <?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>
		<div class="col-12 col-xl-3">
			<div class="sticky-block">
				<?php if ($feature_area_title) { ?>
					<h2 class="fade-in-left" style="--delay: 0.2s;"><?php echo $feature_area_title; ?></h2>
				<?php } ?>
				<?php if ($feature_document_image) { ?>
					<?php echo wp_get_attachment_image($feature_document_image, 'full', false, array('class' => 'img-fluid image-shadow fade-in-left', 'style' => '--delay: 0.4s;', 'loading' => 'lazy')); ?>
				<?php } ?>
				<?php if ($feature_document_link) { ?>
					<a href="<?php echo $feature_document_link['url']; ?>" target="_blank" class="btn btn--primary btn--download fade-in-left" style="--delay: 0.4s;">
						<?php echo $feature_document_link['title']; ?>
					</a>
				<?php } ?>

				<hr class="block--margin-sm separator--thin">

				<?php if ($trade_catalogue_title) { ?>
					<h2 class="fade-in-left" style="--delay: 0.2s;"><?php echo $trade_catalogue_title; ?></h2>
				<?php } ?>
				<?php if ($trade_document_content) { ?>
					<p class="fade-in-left" style="--delay: 0.4s;">
						<?php echo $trade_document_content; ?>
					</p>
				<?php } ?>
				<?php if ($trade_area_link) { ?>
					<a href="<?php echo $trade_area_link['url']; ?>" target="_blank" class="btn btn--primary fade-in-left" style="--delay: 0.4s;">
						<?php echo $trade_area_link['title']; ?>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>