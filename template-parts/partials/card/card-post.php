<?php

$defaults = array(
    "ID"        => get_the_ID(),
    "image"     => get_the_post_thumbnail_url( null, 'full' ),
    "title"     => get_the_title(),
    "content"   => get_the_excerpt(),
    "button"    => array(
        "title"     => "Read Article",
        "target"    => "_self",
        "url"       => get_the_permalink()
    ),
    "author"    => array(
        "ID"  => get_the_author_meta('ID'),
        "name"      => get_the_author_meta( "display_name" )
    ),
    "date"      => get_the_date( "d M Y" )
);

$args = wp_parse_args( $args, $defaults );

$read_time = get_reading_time($args['ID']);
$content = truncate_to_lines( $args['content'], 2 );
$card_img = get_post_thumbnail_id( $args['ID'] );

$row_class = isset($args['row_class']) ? $args['row_class'] : '';

?>

<article id="post-<?php echo $args["ID"] ?>" class="blog-article">
    <div class="blog-cards-col">
        <a href="<?php echo $args['button']['url']; ?>">
            <div class="row g-0 <?php echo esc_attr($row_class); ?>">
                <div class="col-12 col-lg-6">
                    <div class="blog-img">
                        <?php echo wp_get_attachment_image( $card_img, 'full', false, array('class'=>'blog-img img-fluid') ) ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="blog-content">
                        <div class="blog-header__date-read">
                            <span class="blog-content__author-date"><?php echo $args["date"]; ?></span> | <span class="blog-header__read-time"><?php echo $read_time; ?></span> | <span class="blog-content__author-name">By <?php echo $args["author"]["name"]; ?> </span>
                        </div>
                        <h2 class="text-block__heading"><?php echo $args['title']; ?></h2>
                        <p class="blog-content__content"><?php echo $content; ?></p>
                        <span class="btn btn--primary">Read article</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</article>
