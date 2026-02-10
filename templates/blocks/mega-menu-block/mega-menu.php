<?php

$defaults = array(
    "data" => array()
);

$args = wp_parse_args($args, $defaults);

$data = $args['data'];

?>
<div class="position-relative echo-mega-menu padding w-100 menu-body">
    <?php
    $style = $data['menu_style'];
    //var_dump( $data['link_group'] );
    
    if ($style == 'menu_style_1' || $style == 'menu_style_4') {
        $layout_class = 'col col-xl-12';
        $layout_class_2 = 'd-none';
    } else {
        $layout_class = 'col-lg-12 col-xl-7';
        $layout_class_2 = 'col-lg-12 col-xl-5';
    }
    ?>
    <div class="container <?php echo $data['menu_style'] ?>">
        <div class="row">
            <p class="h3 menu-mobile-title"><?php echo $data['title'] ?></p>
            <div class="<?php echo $layout_class ?>">
                <div class="row gx-2 extra-padding-start">
                    <?php
                    $rows = $data['link_group'];
                    if ($rows) {
                        foreach ($rows as $row) {
                            if ($style == 'menu_style_1' || $style == 'menu_style_4') {
                                $inner_layout_class = 'col-xl-3 col-lg-12 content-col';
                            } elseif ($style == 'menu_style_2') {
                                $inner_layout_class = 'col-xl-6 col-lg-12 pt-5 pb-5';
                            } else {
                                $inner_layout_class = 'col-xl-12 pt-5 pb-5 d-block d-xl-flex menu-style-3-col';
                            }
                            $main_link = '#';
                            if ($row['main_category_link']) {
                                $main_link = $row['main_category_link']['url'];
                            }
                            ?>
                            <div class="<?php echo $inner_layout_class ?>">
                                <div class="d-xl-block d-none block-feature-img">
                                    <a href="<?php echo $main_link; ?>">
                                        <?php
                                        $image = $row['featured_image'];
                                        echo wp_get_attachment_image($image, 'full', false, array('loading' => 'lazy'));
                                        ?>
                                    </a>
                                </div>
                                <div class="menu-list">
                                    <a href="<?php echo $main_link; ?>">
                                        <p class="h5"><?php echo $row['title'] ?></p>
                                    </a>
                                    <?php
                                    if ($style != 'menu_style_4') { ?>
                                        <ul>
                                            <?php if ($row['link_items']) {
                                                foreach ($row['link_items'] as $link) {
                                                    echo '<li><a href="' . $link['link_item']['url'] . '" class="btn-arrow-right">' . $link['link_item']['title'] . '</a></li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    <?php } ?>
                                    <div class="link_item-description">
                                        <?php echo $row['description'] ?>
                                    </div>
                                    <?php if ($style == 'menu_style_4') {
                                        echo '<a href="' . $row['button']['url'] . '" class="btn btn-arrow-right">' . $row['button']['title'] . '</a>';

                                    } ?>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    ?>
                </div>
            </div>
            <div class="<?php echo $layout_class_2 ?> dropdown-image">
                <?php echo wp_get_attachment_image($data['dropdown_featured_image'], 'full', "", ["class" => "d-xl-block d-none", "loading" => "lazy"]); ?>
            </div>

        </div>
    </div>
</div>
<script>

    jQuery(".nav-link").click(function () {
        jQuery('.btn-close-mega').addClass("show");
    });
    jQuery(".btn-close-mega").click(function () {
        jQuery('.btn-close-mega').removeClass("show");
    });

</script>