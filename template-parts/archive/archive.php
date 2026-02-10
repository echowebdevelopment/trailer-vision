<?php
get_template_part('template-parts/partials/header/header-archive', get_post_type());
?>
<div class="container-fluid blog-archieve__container">
    <div class="row justify-content-center">
        <div class="col-12">
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
    <?php if (have_posts()): ?>
        <div class="blog-pagination block--padded-md">
            <div class="row justify-content-center">
                <div class="col-12">
                    <?php understrap_pagination() ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
