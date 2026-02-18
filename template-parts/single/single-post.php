<?php

$current_id = get_queried_object_id();

$loop_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'post__not_in' => array($current_id),
);

$query = new WP_Query($loop_args);

?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <?php the_content() ?>
        </div>
        <div class="col-12 col-lg-12">
            <?php
            $post_details = array(
                "ID" => get_the_ID(),
                "image" => get_the_post_thumbnail_url(null, 'full'),
                "tag" => get_the_terms(get_the_ID(), "category"),
                "title" => get_the_title(),
                "button" => array(
                    "title" => "Read Article",
                    "target" => "_self",
                    "url" => get_the_permalink()
                ),
                "author" => array(
                    "name" => get_the_author_meta("display_name"),
                ),
                "date" => get_the_date("d M Y")
            );
            ?>

            <div class="blog-share">
                <a type="button" class="btn--share" data-bs-toggle="modal" aria-label="Open Share Model"
                    data-bs-target="#blog-slider-modal-<?php echo $post_details["ID"]; ?>">
                    <span>Share</span> <i class="icon-share-icon"></i>
                </a>
            </div>

            <div class="modal fade blog-slider-modal share-modal"
                id="blog-slider-modal-<?php echo $post_details["ID"]; ?>" tabindex="-1"
                aria-labelledby="blog-slider-modalLabel-<?php echo $post_details["ID"]; ?>" aria-hidden="true">
                <div class="modal-close-btn">
                    <a class="btn btn--transparent btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Close</a>
                </div>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="h3">Share</p>
                        </div>
                        <div class="modal-body social-share">
                            <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post_details["ID"])) ?>"
                                target="_blank">
                                <i class="icon-facebook"></i>
                            </a>

                            <a href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode(get_permalink($post_details["ID"])) ?>"
                                target="_blank">
                                <i class="icon-interest"></i>
                            </a>

                            <a href="mailto:?body=<?php echo urlencode(get_permalink($post_details["ID"])) ?>"
                                title="Share by Email">
                                <i class="icon-email-icon"></i>
                            </a>

                            <input type="hidden" id="hiddenField"
                                value="<?php echo get_permalink($post_details["ID"]) ?>">
                            <a class="btn--link" onclick="copyText()"><i class="icon-copy"></i>Copy Link</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reviews-slider-block block block--margin">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="reviews-slider__header blog-footer-header">
                                <div class="text-block__header m-0">
                                    <h3>You may also like to read</h3>
                                </div>
                                <div class="reviews-slider__logo-link">
                                    <?php echo sprintf('<a class="btn btn--transparent" href="/blog/">See more articles</a>'); ?>
                                </div>

                            </div>

                            <div class="blog-carousel carousel">
                                <?php if ($query->have_posts()): ?>
                                    <div class="blog-carousel__carousel blog">
                                        <?php while ($query->have_posts()):
                                            $query->the_post(); ?>
                                            <?php
                                            echo '<div>';
                                            get_template_part('template-parts/partials/card/card', get_post_type(), ['row_class' => 'flex-row-reverse']);
                                            echo '</div>';
                                            ?>

                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>