<?php

$defaults = array(
    "data" => array()
);

$args = wp_parse_args($args, $defaults);

$data = $args['data'];

$mobile_menu_name = $data['mobile_menu_name'];
?>

<div class="echo-mega-menu menu-body postion-relative">
    <div class="menu-body">

        <div class="row d-block d-xl-none">
            <div class="col-12">
                <div class="text-end">
                    <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false">
                        <i class="icon-cross"></i>
                    </button>
                </div>
                <div class="offcanvas-header p-0">
                    <span class="title"><?php echo $mobile_menu_name ?></span>
                    <button class="btn-close-mega p-0" type="button" data-bs-dismiss="dropdown"
                        aria-label="<?php esc_attr_e('Close menu', 'understrap'); ?>">
                        <i class="icon-nav-right"></i>Back
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-0">
            <?php
            $about = $data['main_menu'];

            $about_title = $about['heading'];
            $about_subheading = $about['content'];
            $link = $about['link'];
            ?>
            <div class="col-12 col-lg-3">
                <div class="bg-square-main-image menu-heading block--padded">
                    <p class="h2 about-title text--white"><?php echo $about_title ?></p>
                    <div class="about-subtitle text--white"><?php echo $about_subheading ?></div>
                    <?php if ($link): ?>
                        <?php echo sprintf('<a class="btn btn--menu-link" href="%1$s" target="%2$s">%3$s</a>', $link['url'], $link['target'], $link['title']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="menu-content block--padded">
                    <?php if ($about['menus']): ?>
                        <div class="row gy-3">
                            <?php foreach ($about['menus'] as $about_menu): ?>
                                <div class="col-12 col-md-6 col-lg-4 col-xl-<?php echo $about_menu['number_of_columns_on_desktop'] ?: 4; ?> header-menu">
                                    <?php if ($about_menu['main_title']): ?>
                                        <p class="mega-menu-title"><?php echo esc_html($about_menu['main_title']); ?></p>
                                    <?php endif; ?>
                                    <?php
                                    wp_nav_menu(array(
                                        'menu' => $about_menu['menu_to_show'],
                                        'container' => false,
                                        'menu_class' => 'acf-menu',
                                        'fallback_cb' => false
                                    ));
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    jQuery(".btn-close-mega").click(function () {
        jQuery('.offcanvas-body .echo-menu-shortcode').removeClass("show");
    });
</script>