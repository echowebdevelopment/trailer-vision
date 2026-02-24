<?php
/**********************************************************
 *
 * File:         Popup
 * Description:  
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     14/11/2022
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$run_popup = get_option('options_run_popup');

$image = get_option('options_popup_image');
$content = get_option('options_popup_content');
$type_of_popup = get_option('options_type_of_popup');
$image_link = get_option('options_image_link');

$start_date = esc_html(get_option('options_popup_begining_date'));
$end_date = esc_html(get_option('options_popup_end_date'));
$cookie_lifetime = esc_html(get_option('options_cookie_lifetime')) ?: '1';

$start = strtotime($start_date);
$end = strtotime($end_date);
$today = strtotime(date('Ymd'));

$auxType = '';
$auxCol = '';
$auxBtn = '';

if ($type_of_popup == 'image') {
	$auxType = 'image';
	$auxCol = 'col-12';
	$auxBtn = 'btn--popup-close';
} elseif ($type_of_popup == 'content') {
	$auxType = 'content';
	$auxCol = 'col-12';
} else {
	$auxType = 'both';
}

$img = wp_get_attachment_image($image, 'full', false, array('class' => 'popup__img', 'loading' => 'eager'));

if ($run_popup && (($today >= $start) && ($today <= $end))) { ?>

	<div class="popupS">
		<div class="popup__inner">
			<div class="row align-items-center">
				<?php if ($auxType == 'image' || $auxType == 'both') { ?>
					<div class="<?php echo $auxCol ?: 'col-12 col-lg-6' ?>">
						<?php if ($image_link) { ?>
							<a class="popup-link" href="<?php echo $image_link['url'] ?>"
								target="<?php echo $image_link['target'] ?>">
							<?php } ?>
							<?php echo $img; ?>
							<?php if ($image_link) { ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ($auxType == 'content' || $auxType == 'both') { ?>
					<div class="<?php echo $auxCol ?: 'col-12 col-lg-6' ?>">
						<div class="popup-content">
							<?php echo $content; ?>
							<?php if (have_rows('buttons', 'option')): ?>
								<div class="block-buttons mt-4">
									<?php while (have_rows('buttons', 'option')):
										the_row(); ?>
										<?php
										$link = get_sub_field('link');
										$theme = get_sub_field('theme');
										if (empty($link)) {
											break;
										}

										echo sprintf('<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);

										?>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<button type="button" class="popup__closeS close <?php echo $auxBtn; ?>" aria-label="Close">
				Close <i class="icon-cross"></i>
			</button>
		</div>
	</div>

	<script type="text/javascript" defer>
		// https://www.codexworld.com/cookie-consent-popup-with-javascript/

		// Close popup
		function closeEventPopup() {
			document.querySelector('.popupS').classList.remove('popupS--active');
		}

		// Create cookie
		function setCookie(cname, cvalue, exdays) {
			const d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			let expires = "expires=" + d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		// Delete cookie
		function deleteCookie(cname) {
			const d = new Date();
			d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
			let expires = "expires=" + d.toUTCString();
			document.cookie = cname + "=;" + expires + ";path=/";
		}

		// Read cookie
		function getCookie(cname) {
			let name = cname + "=";
			let decodedCookie = decodeURIComponent(document.cookie);
			let ca = decodedCookie.split(';');
			for (let i = 0; i < ca.length; i++) {
				let c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}

		// Set cookie consent
		function acceptCookieConsent() {
			deleteCookie('user_cookie_consent');
			setCookie('user_cookie_consent', 1, <?php echo $cookie_lifetime; ?>);
			closeEventPopup();
		}

		let cookie_consent = getCookie("user_cookie_consent");

		if (cookie_consent != "") {
			closeEventPopup();
		} else {
			setTimeout(() => {
				document.querySelector(".popupS").classList.add("popupS--active");
				console.log('Welcome back!');
			}, 1000);
		}

		// Close button
		document.querySelector(".popup__closeS").addEventListener("click", (e) => {
			deleteCookie('user_cookie_consent');
			setCookie('user_cookie_consent', 1, <?php echo $cookie_lifetime; ?>);
			closeEventPopup();
		});

		document.querySelector(".btn").addEventListener("click", (e) => {
			deleteCookie('user_cookie_consent');
			setCookie('user_cookie_consent', 1, <?php echo $cookie_lifetime; ?>);
			closeEventPopup();
		});

		document.querySelector(".popup-link").addEventListener("click", (e) => {
			deleteCookie('user_cookie_consent');
			setCookie('user_cookie_consent', 1, <?php echo $cookie_lifetime; ?>);
			closeEventPopup();
		});

		// Close on overlay click 
		// https://linguinecode.com/post/how-to-close-popup-by-clicking-outside-with-javascript
		const popupQuerySelector = ".popup__inner";

		document.addEventListener("click", (e) => {
			// Check if the filter list parent element exist
			const isClosest = e.target.closest('.popup__inner');
			const cookieBannerOld = e.target.closest('#cookie-law-info-bar');
			const cookieBanner = e.target.closest('.cky-consent-container');

			// If `isClosest` equals falsy & popup has the class `show`
			// then hide the popup
			if (!isClosest && !cookieBanner && !cookieBannerOld && document.querySelector('.popupS').classList.contains('popupS--active')) {
				deleteCookie('user_cookie_consent');
				setCookie('user_cookie_consent', 1, <?php echo $cookie_lifetime; ?>);
				closeEventPopup();
			}

		});

	</script>

<?php } ?>