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

<div class="blog-header-block page-header-block block block--fullwidth">
	<div class="row g-0">
		<div class="col-12 col-lg-6 page-header-block__content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<div class="breadcrumbs fade-in-left">', '</div>');
			} ?>
			<h1 class="text-block__heading fade-in-left"><?php echo $args['title']; ?></h1>
			<div class="blog-header__date-read fade-in-left">
				<span class="blog-content__author-name"><?php echo wp_get_attachment_image( 291, 'full', false, array('class'=>'img-fluid') ) ?> By <?php echo $args["author"]["name"]; ?> </span> |
				<span class="blog-content__author-date"><?php echo $args["date"]; ?></span> | 
				<span class="blog-header__read-time"><?php echo $read_time; ?></span>
			</div>
		</div>
		<div class="col-12 col-lg-6 page-header-block__image">
			<?php echo wp_get_attachment_image($card_img, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
		</div>
	</div>
</div>