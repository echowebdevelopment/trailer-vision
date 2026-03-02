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

<div class="blog-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <?php the_content() ?>
            
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

                <div class="blog-share block--margin">
                    <a type="button" class="btn--share" data-bs-toggle="modal" aria-label="Open Share Model"
                        data-bs-target="#blog-slider-modal-<?php echo $post_details["ID"]; ?>">
                        <span>Share</span> <i class="icon-share"></i>
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

                                <a href="mailto:?body=<?php echo urlencode(get_permalink($post_details["ID"])) ?>"
                                    title="Share by Email">
                                    <i class="icon-email"></i>
                                </a>

                                <input type="hidden" id="hiddenField"
                                    value="<?php echo get_permalink($post_details["ID"]) ?>">
                                <a class="btn--link" onclick="copyText()"><i class="icon-copy"></i>Copy Link</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-slider-block block block--padded block--fullwidth">
    <div class="container-fluid">
        <div class="row gy-5 justify-content-center">
            <div class="col-12">
                <div class="blog-footer-header text-center fade-in-left">
                    <h2>You may also like to read</h2>
                </div>
            </div>
            <div class="col-12 col-lg-10 fade-in-left">
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
            <div class="col-12 text-center fade-in-right">
                <?php  echo sprintf('<a class="btn btn--primary" href="/blog/">More articles</a>'); ?>
            </div>
        </div>
    </div>
</div>