<?php
$title = get_field( 'title_blog', 'options' ) ?: 'Latest news';
$content_blog = get_field( 'content_blog', 'options' ) ?: '';
?>

<div class="text-block block block--margin-md">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-12 col-xl-6">
                <h1 class="text-block__heading"><?php echo $title ?></h1>
                <p class=""><?php echo $content_blog ?></p>
            </div>
            <div class="col-12 col-xl-6">
                <div class="sort-search-filters">
                    <?php
                    echo do_shortcode('[facetwp facet="sorting_filter_copy"]');
                    echo do_shortcode('[facetwp facet="blog_search"]');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>