<?php
$defaults = array(
	"ID" => get_the_ID(),
	"image" => get_the_post_thumbnail_url(null, 'full'),
	"title" => get_the_title(),
	"content" => get_the_content(),
	"button" => array(
		"title" => "Read Article",
		"target" => "_self",
		"url" => get_the_permalink()
	),
	"author" => array(
		"ID" => get_the_author_meta('ID'),
		"name" => get_the_author_meta("display_name")
	),
	"date" => get_the_date("d M Y")
);

$args = wp_parse_args($args, $defaults);

$read_time = get_reading_time($args['ID']);
$card_img = get_post_thumbnail_id($args['ID']);
?>

<div class="page-header-block block--fullwidth layout--half-image">
	<?php echo wp_get_attachment_image($card_img, 'full', false, array('class' => 'layout--half-image__bg')) ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-5 p-4 p-lg-5">
				<div class="single-product__breadbrumb">
					<?php if (function_exists('woocommerce_breadcrumb')) {
						woocommerce_breadcrumb();
					} ?>
				</div>
				<h1 class="section-title mb-5"><?php echo $args['title']; ?></h1>
				<div class="blog-header__date-read">
					<span class="blog-header__read-time"><?php echo $read_time; ?></span> |
					<span class="blog-content__author-date"><?php echo $args["date"]; ?></span> |
					<span class="blog-content__author-name">By <?php echo $args["author"]["name"]; ?> </span>
				</div>

			</div>
			<div class="col-lg-6 col-xl-7">

			</div>
		</div>
	</div>
</div>