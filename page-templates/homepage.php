<?php
/**
 * Template Name: Homepage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper pt-0" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main id="primary" class="site-main">
                
                <?php if( have_rows('layout') ) : 
                    while ( have_rows('layout') ) : the_row();
                        $files = scandir(dirname(__FILE__). '/' . '../' . 'flexible-parts/');
                        $section = str_replace('.php', '', $files);
        
                        foreach($section as $content) : 
        
                            if( get_row_layout() == $content ) :
        
                                get_template_part('flexible-parts/'.$content);                
                                        
                            endif;
        
                        endforeach;
        
                    endwhile; 
                endif; ?>

            </main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
