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
                        <i class="icon-back-arrow"></i>Back
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-0">
            <?php
                $about = $data['main_menu'];

                $about_title = $about['heading'];
                $about_subheading = $about['content'];
                ?>
                <div class="col-3 d-none d-xl-block">
                    <div class="bg-square-main-image menu-heading block--padded">
                        <span class="title"><?php echo $mobile_menu_name ?></span>
                        <p class="h2 about-title text--white"><?php echo $about_title ?></p>
                        <div class="about-subtitle text--white"><?php echo $about_subheading ?></div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="bg-square-grey-image menu-content block--padded">
                        <?php if ($about['menus']): ?>
                            <div class="row gy-3 justify-content-xl-end">
                                <?php foreach ($about['menus'] as $about_menu): ?>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-4 header-menu">
                                        <p><?php echo esc_html($about_menu['main_title']); ?></p>
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