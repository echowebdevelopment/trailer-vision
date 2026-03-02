<?php

$defaults = array(
    "ID" => get_the_ID(),
    "image" => get_the_post_thumbnail_url(null, 'full'),
    "title" => get_the_title(),
    "content" => get_the_excerpt(),
    "button" => array(
        "title" => "Read Article",
        "target" => "_self",
        "url" => get_the_permalink()
    ),
    "author" => array(
        "ID" => get_the_author_meta('ID'),
        "name" => get_the_author_meta("display_name")
    ),
    "date" => get_the_date("d M Y"),
    "category" => get_the_category(),
);

$args = wp_parse_args($args, $defaults);

$rating = get_field('number_of_stars', get_the_ID());
$review_subject = get_field('review_subject', get_the_ID());
$video_url = get_field('video_url', get_the_ID());

$images = get_field('gallery', get_the_ID());

$i = 1;

$row_class = isset($args['row_class']) ? $args['row_class'] : '';
?>

<article id="post-<?php echo $args["ID"] ?>" class="review-article lightbox-gallery">
    <div class="reviews-carousel__item carousel__item">
        <div class="row g-5 <?php echo esc_attr($row_class); ?>">
            <div class="col-12 col-lg-6">
                <div class="reviews-carousel__block">
                    <div class="reviews-carousel__block-content">
                        <?php echo get_the_content(); ?>
                    </div>
                    <div class="reviews-carousel__block-stars">
                        <?php if ($rating == 4) {
                            for ($k = 0; $k < $rating; $k++) { ?>
                                <i class="icon-star-solid"></i>
                            <?php } ?>
                            <i class="icon-star-solid grey-out"></i>
                        <?php } else {
                            for ($k = 0; $k < $rating; $k++) { ?>
                                <i class="icon-star-solid"></i>
                            <?php }
                        } ?>
                    </div>
                    <div class="reviews-carousel__block-footer">
                        <span class="reviews-carousel__block-author">
                            <?php echo get_the_title(); ?>
                        </span>
                        |
                        <span class="reviews-carousel__block-subject">
                            <?php echo $review_subject; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="row g-2">
                    <?php if ($video_url) { ?>
                        <div class="col-12">
                            <div class="video-container fade-in-bottom">
                                <?php echo wp_oembed_get( $video_url ); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($images): ?>
                        <?php foreach ($images as $image_id):
                            $i++;
                            $delay = ($i - 1) * 0.1; ?>
                            <div class="col-6 fade-in-bottom" style="--delay: <?php echo $delay; ?>s;">
                                <a href="<?php echo wp_get_attachment_image_url( $image_id, '' ); ?>" class="lightbox-gallery__link">
                                    <?php echo wp_get_attachment_image($image_id, 'full', false, array('class' => 'gallery-img img-fluid', 'loading' => 'lazy')); ?>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article>