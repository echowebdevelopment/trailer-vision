<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/partials/header/header-archive', get_post_type());
?>

<div class="container-fluid reviews-archieve__container block--margin-top-none block--margin-md">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="row g-5">
                <?php
                if (have_posts()) {
                    $count = 0; // Initialize counter
                
                    while (have_posts()):
                        the_post();
                        $count++;

                        // Add 'reverse-row' every other post
                        $row_class = ($count % 2 == 0) ? 'flex-row-reverse' : '';

                        echo '<div class="col-12">';
                        get_template_part('template-parts/partials/card/card', get_post_type(), ['row_class' => $row_class]);
                        echo '</div>';

                    endwhile;
                    wp_reset_postdata();
                } else { ?>
                    <div class="col-12 blog-search block--margin">
                        <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if ($wp_query->found_posts >= 4): ?>
        <div class="blog-pagination block--margin-md">
            <div class="row justify-content-center">
                <div class="col-12">
                    <?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
