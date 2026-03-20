<?php
$title = get_field('title_reviews', 'options') ?: 'Latest reviews';
$content_blog = get_field('content_reviews', 'options') ?: '';
?>

<div class="text-block block block--margin-md">
    <div class="container-fluid">
        <div class="row align-items-end justify-content-center">
            <div class="col-12 col-lg-5">
                <h1 class="text-block__heading"><?php echo $title ?></h1>
                <p class=""><?php echo $content_blog ?></p>
            </div>
            <div class="col-12 col-lg-5">
                <div class="sort-search-filters">
                    <?php
                    echo do_shortcode('[facetwp facet="blog_sorting_filter"]');
                    ?>
                </div>
            </div>
            <div class="col-12 col-lg-10 d-none d-lg-block">
                <hr class="separator separator--thin">
            </div>
        </div>
    </div>
</div>