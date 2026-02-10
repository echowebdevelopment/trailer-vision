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
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$banner_layout = get_field('layout');
$bg = get_field('video-block--bg') ? 'block--bg-'.get_field('page-title--bg') : 'block--bg-none';

$classes = array();
$classes[] = 'layout--' . $banner_layout;
$classes[] = $bg;
$classes[] = $bg != 'block--bg-none' ? 'block--padded-sm' : 'block--margin-sm';
$video = get_field('video');
$link = get_field('button');

if( $video  ) { 
    $iframe = $video ;
    // Use preg_match to find iframe src.
    preg_match('/src="(.+?)"/', $iframe, $matches);
    $src = $matches[1];

    // Add extra parameters to src and replace HTML.
    $params = array(
        'controls'  => 0,
        'hd'        => 1,
        'autohide'  => 1
    );
    $new_src = add_query_arg($params, $src);
    $iframe = str_replace($src, $new_src, $iframe);

    // Add extra attributes to iframe HTML.
    $attributes = 'frameborder="0"';
    $iframe = '<video ' . $attributes . ' style="width:100%" id="myvideo"><source src="' . $src . '"  type="video/mp4"></video><div class="controls"><button id="play-pause" class="btn btn-arrow-right">Play</button></div>';
}

?>
<div class="video-block block--fullwidth <?php echo implode(' ', $classes); ?>" >
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 p-5">
				<h3 class="section-title"><?php echo get_field('title'); ?></h3>
				<?php echo get_field('description'); ?>

				<?php if( $video ) {
                    echo  do_shortcode('<div class="video-container">'.$iframe.'</div>');
                 } else { ?>
                    
                 <?php } ?>
			</div>
		</div>
	</div>
</div>
<script>
        const video = document.getElementById('myvideo');
        const playPauseButton = document.getElementById('play-pause');

        playPauseButton.addEventListener('click', function() {
            if (video.paused) {
                video.play();
                playPauseButton.textContent = 'Pause';
                playPauseButton.classList.add('hide');
            } else {
                video.pause();
                playPauseButton.textContent = 'Play';
                playPauseButton.classList.remove('hide');
            }
        });
    </script>