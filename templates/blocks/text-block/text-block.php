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

$heading_size = get_field( 'heading_size' );
$heading_center = get_field( 'heading_center' );
$number_of_columns  = get_field( 'number_of_columns_text' );

$acf_heading = get_field( 'heading_text' );
$heading = $acf_heading ? sprintf( '<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field( 'subheading_text' );
$subheading = $acf_subheading ? sprintf( '<div class="text-block__subheading">%1$s</div>', wpautop($acf_subheading)) : '';

$lead_paragraph = get_field( 'lead_paragraph_text' );
$content  = get_field( 'content_text' );

$auxCol = 'text--one-columns';
$auxCenter = '';
$auxaMargin = 'mb-0';

if( $number_of_columns == 2 ) {
	$auxCol = 'text--two-columns';
}

if( $heading_center == 'yes' ) {
	$auxCenter = 'text-center';
}

if( $content ) {
	$auxaMargin = '';
}

?>

<div class="text-block block block--margin">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12">
				<?php if( $heading ) { ?>
					<div class="text-block__header <?php echo $auxCenter . ' ' . $auxaMargin; ?>">
						<?php echo $heading; ?>
						<?php if( $subheading ) { ?>
							<?php echo $subheading; ?>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if( $content ) { ?>
					<div class="<?php echo $auxCol; ?>">
						<?php if( $lead_paragraph ) { ?>
							<p class="lead"><?php echo $lead_paragraph; ?></p>
						<?php } ?>
						<?php echo $content; ?>
						<?php if ( have_rows('buttons_text') ) : ?>
							<div class="block-buttons">
								<?php while ( have_rows('buttons_text') ) : the_row(); ?>
									<?php
										$link   = get_sub_field('link');
										$theme  = get_sub_field('theme');
										if ( empty($link) ) { break; }

										echo sprintf('<a class="btn btn--%1$s btn-arrow-right" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);

									?>
									<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
