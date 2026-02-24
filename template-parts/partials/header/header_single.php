<?php
$title = get_field('title_blog', 'options') ?: 'Latest articles';
$content_blog = get_field('content_blog', 'options') ?: '';
?>

<div class="text-block block block--margin-top-md block--margin-bottom-sm">
    <div class="container-fluid">
        <div class="row align-items-end">
            <div class="col-12 col-lg-6">
                <h1 class="text-block__heading"><?php echo $title ?></h1>
                <p class=""><?php echo $content_blog ?></p>
            </div>
            <?php if (have_posts()): ?>
                <div class="col-12 col-lg-6">
                    <div class="sort-search-filters">
                        <?php
                        echo do_shortcode('[facetwp facet="blog_sorting_filter"]');
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <hr class="separator separator--thin">
            </div>
        </div>
    </div>
</div>