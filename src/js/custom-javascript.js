// Add your JS customizations here
class Accordion {
	constructor(el) {
		// Store the <details> element
		this.el = el;
		// Store the <summary> element
		this.summary = el.querySelector("summary");
		// Store the <div class="content"> element
		this.content = el.querySelector(".accordion");

		// Store the animation object (so we can cancel it if needed)
		this.animation = null;
		// Store if the element is closing
		this.isClosing = false;
		// Store if the element is expanding
		this.isExpanding = false;
		// Detect user clicks on the summary element
		this.summary.addEventListener("click", (e) => this.onClick(e));
	}

	onClick(e) {
		// Stop default behaviour from the browser
		e.preventDefault();
		// Add an overflow on the <details> to avoid content overflowing
		this.el.style.overflow = "hidden";
		// Check if the element is being closed or is already closed
		if (this.isClosing || !this.el.open) {
			this.open();
			// Check if the element is being openned or is already open
		} else if (this.isExpanding || this.el.open) {
			this.shrink();
		}
	}

	shrink() {
		// Set the element as "being closed"
		this.isClosing = true;

		// Store the current height of the element
		const startHeight = `${this.el.offsetHeight}px`;
		// Calculate the height of the summary
		const endHeight = `${this.summary.offsetHeight}px`;

		// If there is already an animation running
		if (this.animation) {
			// Cancel the current animation
			this.animation.cancel();
		}

		// Start a WAAPI animation
		this.animation = this.el.animate(
			[
				// Set the keyframes from the startHeight to endHeight
				{ height: startHeight },
				{ height: endHeight },
			],
			{
				duration: 500, // Increased duration for smoother transition
				easing: "ease-in-out", // Ease-in-out for smoother animation
			},
		);

		// When the animation is complete, call onAnimationFinish()
		this.animation.onfinish = () => this.onAnimationFinish(false);
		// If the animation is cancelled, isClosing variable is set to false
		this.animation.oncancel = () => (this.isClosing = false);
	}

	open() {
		// Apply a fixed height on the element
		this.el.style.height = `${this.el.offsetHeight}px`;
		// Force the [open] attribute on the details element
		this.el.open = true;
		// Wait for the next frame to call the expand function
		window.requestAnimationFrame(() => this.expand());
	}

	expand() {
		// Set the element as "being expanding"
		this.isExpanding = true;
		// Get the current fixed height of the element
		const startHeight = `${this.el.offsetHeight}px`;
		// Calculate the open height of the element (summary height + content height)
		const endHeight = `${
			this.summary.offsetHeight + this.content.offsetHeight
		}px`;

		// If there is already an animation running
		if (this.animation) {
			// Cancel the current animation
			this.animation.cancel();
		}

		// Start a WAAPI animation
		this.animation = this.el.animate(
			[
				// Set the keyframes from the startHeight to endHeight
				{ height: startHeight },
				{ height: endHeight },
			],
			{
				duration: 500, // Increased duration for smoother transition
				easing: "ease-in-out", // Ease-in-out for smoother animation
			},
		);
		// When the animation is complete, call onAnimationFinish()
		this.animation.onfinish = () => this.onAnimationFinish(true);
		// If the animation is cancelled, isExpanding variable is set to false
		this.animation.oncancel = () => (this.isExpanding = false);
	}

	onAnimationFinish(open) {
		// Set the open attribute based on the parameter
		this.el.open = open;
		// Clear the stored animation
		this.animation = null;
		// Reset isClosing & isExpanding
		this.isClosing = false;
		this.isExpanding = false;
		// Remove the overflow hidden and the fixed height
		this.el.style.height = this.el.style.overflow = "";
	}
}

document.querySelectorAll("details").forEach((el) => {
	new Accordion(el);
});

(function ($) {
	//Sticky Menu
	$(window).scroll(function () {
		var header = $("#wrapper-navbar");
		if ($(this).scrollTop() > 0) {
			header.addClass("sticky-top");
		} else {
			header.removeClass("sticky-top");
		}
	});

	/* Lightbox Product Image */
	if ($(".lightbox-gallery").length > 0) {
		var $button = $("#single-product__gallery-btn");
		var lightboxes = document.querySelectorAll(".lightbox-gallery");

		lightboxes.forEach((lightboxes) => {
			lightGallery(lightboxes, {
				selector: ".lightbox-gallery__link",
				appendSubHtmlTo: ".lg-item",
			});
		});

		//lightGallery(document.getElementById("lightgallery"));

		$("#magic_start").on("click", () => {
			$("#lightgallery a:first-child > img").trigger("click");
		});
	}

	/* function performAction() {
		if (window.innerWidth < 1200) {
			$(".single-product__title-area-mobile").show();
			$(".single-product__title-area-desktop").hide();
		} else {
			$(".single-product__title-area-mobile").hide();
			$(".single-product__title-area-desktop").show();
		}
	}

	// Trigger the action on page load and on resize
	performAction();
	$(window).resize(function () {
		performAction();
	}); */

	/* Variables passing attributes */
	// $(".other-size-available").click(function (e) {
	// 	e.preventDefault();

	// 	let selectedOptions = {};

	// 	$(".variations select").each(function () {
	// 		let attributeName = $(this).attr("name");
	// 		let attributeValue = $(this).find("option:selected").val();

	// 		if (attributeValue && attributeValue !== "") {
	// 			selectedOptions[attributeName] = attributeValue;
	// 		}
	// 	});

	// 	// $('.wc-pao-addons-container .wc-pao-addon-wrap .selected').each(function () {
	// 	//     let fieldName = $(this).attr('data-addon-name');
	// 	//     let fieldValue = $(this).attr('data-value');

	// 	//     if (fieldName && fieldValue) {
	// 	//         selectedOptions[fieldName] = fieldValue;
	// 	//     }

	// 	// 	alert(fieldName);
	// 	// });

	// 	let queryString = $.param(selectedOptions);
	// 	let currentLink = $(this).attr("data-base-url") || $(this).attr("href");
	// 	let updatedLink = currentLink;

	// 	if (queryString) {
	// 		updatedLink = currentLink.includes("?")
	// 			? `${currentLink}&${queryString}`
	// 			: `${currentLink}?${queryString}`;
	// 	}

	// 	$(this).attr("href", updatedLink);

	// 	window.location.href = updatedLink;
	// });

	document.addEventListener("facetwp-loaded", function () {
		$.each(FWP.settings.num_choices, function (key, val) {
			var $facet = $(".facetwp-facet-" + key);
			var $wrap = $facet.closest(
				".shop-filters .widget_block details.accordion__item",
			);
			var $flyout = $facet.closest(".flyout-row");
			if ($wrap.length || $flyout.length) {
				var $which = $wrap.length ? $wrap : $flyout;
				0 === val ? $which.hide() : $which.show();
			}
		});
	});

	/**************************************/
	/* !Tiny Carousels                    */
	/**************************************/
	if ($(".usp-carousel__carousel").length > 0) {
		/* TinySlider */
		var uspSlider = tns({
			container: ".usp-carousel__carousel",
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 10000,
			autoplayButtonOutput: false,
			nav: false,
			controls: false,
			responsive: {
				0: {
					items: 1,
				},
				600: {
					items: 2,
				},
				768: {
					items: 3,
				},
				992: {
					items: 4,
				},
				1200: {
					items: 5,
				},
				1400: {
					items: 6,
				},
			},
		});
	}

	if ($(".logo-carousel__carousel").length > 0) {
		/* TinySlider */
		var logoSlider = tns({
			container: ".logo-carousel__carousel",
			mouseDrag: true,
			autoplay: true,
			gutter: 40,
			speed: 1000,
			autoplayTimeout: 2000,
			autoplayButtonOutput: false,
			nav: false,
			controls: true,
			controlsText: [
				"<i class='icon-nav-right'></i><span class='visually-hidden'>Prev</span>",
				"<i class='icon-nav-forward'></i><span class='visually-hidden'>Next</span>",
			],
			responsive: {
				0: {
					items: 2,
				},
				576: {
					items: 3,
				},
				768: {
					items: 3,
				},
				992: {
					items: 4,
				},
				1200: {
					items: 5,
				},
			},
		});
	}

	if ($(".hero-slider-carousel").length > 0) {
		/* TinySlider */
		tns({
			container: ".hero-slider-carousel",
			items: 1,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 4000,
			autoplayButtonOutput: false,
			nav: true,
			controls: false,
		});
	}

	/* !- Reviews carousel */
	if ($(".reviews-carousel__carousel").length > 0) {
		/* TinySlider */
		tns({
			container: ".reviews-carousel__carousel",
			gutter: 8,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 10000,
			autoplayButtonOutput: false,
			nav: false,
			controls: true,
			controlsText: [
				"<i class='icon-arrow-right-big'></i><span class='visually-hidden'>Prev</span>",
				"<i class='icon-arrow-left-big'></i><span class='visually-hidden'>Next</span>",
			],
			responsive: {
				0: {
					items: 1,
				},
				768: {
					items: 2,
				},
				992: {
					items: 3,
				},
				1400: {
					items: 4,
				},
			},
		});
	}

	/* !- Products carousel */
	if ($(".product-carousel__carousel").length > 0) {
		/* TinySlider */
		var productSlider = tns({
			container: ".product-carousel__carousel",
			gutter: 8,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 10000,
			autoplayButtonOutput: false,
			nav: false,
			controls: true,
			controlsText: [
				"<i class='icon-arrow-right-big'></i><span class='visually-hidden'>Prev</span>",
				"<i class='icon-arrow-left-big'></i><span class='visually-hidden'>Next</span>",
			],
			responsive: {
				0: {
					items: 1,
				},
				768: {
					items: 2,
				},
				992: {
					items: 3,
				},
				1400: {
					items: 4,
				},
			},
		});
	}

	if ($(".blog-carousel__carousel").length > 0) {
		/* TinySlider */
		tns({
			container: ".blog-carousel__carousel",
			items: 1,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 10000,
			autoplayButtonOutput: false,
			nav: false,
			controls: true,
			controlsText: [
				"<i class='icon-arrow-right-big'></i><span class='visually-hidden'>Prev</span>",
				"<i class='icon-arrow-left-big'></i><span class='visually-hidden'>Next</span>",
			],
		});
	}

	/* !- Reviews carousel */
	if ($(".brand-carousel__carousel").length > 0) {
		/* TinySlider */
		tns({
			container: ".brand-carousel__carousel",
			gutter: 8,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 10000,
			autoplayButtonOutput: false,
			nav: false,
			controls: true,
			controlsText: [
				"<i class='icon-arrow-right-big'></i><span class='visually-hidden'>Prev</span>",
				"<i class='icon-arrow-left-big'></i><span class='visually-hidden'>Next</span>",
			],
			responsive: {
				0: {
					items: 1,
				},
				768: {
					items: 2,
				},
				992: {
					items: 3,
				},
				1400: {
					items: 4,
				},
			},
		});
	}

	/* Facetwp load */
	$(document).on("facetwp-refresh", function () {
		if (FWP.loaded) {
			FWP.setHash();
			window.location.reload();
		}
	});

	$(window).on("load", function () {
		if (FWP.loaded) {
			$("html, body").animate(
				{
					scrollTop: $(".facetwp-template").offset().top - 250,
				},
				500,
			);
		}
	});

	/* !- WC Variation Swatches */
	// Remove title to disable native tooltip
	// $(".variable-item.button-variable-item").on("mouseover", function (e) {
	// 	e.stopPropagation(); // Prevent event bubbling
	// 	$(this).removeAttr("title"); // Remove title to disable native tooltip
	// });

	/* !- WC Pao Addons */
	// Hide swatches beyond the first 12
	// $(".form-row.form-row-wide.wc-pao-addon-wrap").each(function () {
	// 	let container = $(this);
	// 	let swatches = container.find(".wc-pao-addon-image-swatch");

	// 	if (swatches.length > 12) {
	// 		// Hide swatches beyond the first 7
	// 		swatches.slice(12).hide();

	// 		// Create a unique View More button for each addon
	// 		let viewMoreBtn = $(
	// 			'<span class="btn--link btn-arrow-down small" style="display:block; cursor:pointer; margin:10px 0;">View more colours</span>'
	// 		);

	// 		// Append button after swatches
	// 		container.append(viewMoreBtn);

	// 		// Toggle swatches visibility on click
	// 		viewMoreBtn.on("click", function () {
	// 			let hiddenSwatches = swatches.slice(12);
	// 			if (hiddenSwatches.is(":visible")) {
	// 				hiddenSwatches.slideUp(500);
	// 				$(this).text("View more colours");
	// 			} else {
	// 				hiddenSwatches.css("display", "inline-block").hide().slideDown(500);
	// 				$(this).text("View less colours");
	// 			}
	// 		});
	// 	}
	// });

	// $(".wc-pao-addon-name").each(function () {
	// 	var description = $(this)
	// 		.siblings(".wc-pao-addon-description")
	// 		.text()
	// 		.trim();
	// 	if (description) {
	// 		$(this).wrap('<span class="tooltip-container"></span>');
	// 		$(this).after(
	// 			'<button type="button" class="attribute-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
	// 				description +
	// 				'">?</button>'
	// 		);
	// 	}
	// });

	/* !- Sticky Add to Cart */
	var stickyBar = $(".sticky-add-to-cart");
	var addToCartBtn = $(".sticky_single_add_to_cart_button");
	var totalPriceElement = $(".sticky-add-to-cart .total-price");
	var quantityInput = $(".sticky-add-to-cart .quantity");
	var price = parseFloat(
		$(".product .price .woocommerce-Price-amount")
			.first()
			.text()
			.replace(/[^0-9.]/g, ""),
	);

	// Disable button initially for variable products
	if ($(".variations_form").length) {
		addToCartBtn.addClass("disabled").attr("disabled", true);
	}

	// Handle scroll to show/hide sticky bar
	$(window).on("scroll", function () {
		var rect = $(".single_add_to_cart_button")[0].getBoundingClientRect();

		// Show sticky bar when scrolled past the add to cart button
		if (rect.bottom <= 0) {
			stickyBar.fadeIn();
		} else {
			stickyBar.fadeOut();
		}

		// Check if the element with the class "single-product__content-custom" is in view
		var contentCustomElement = $(".single-product__content-custom");
		var contentCustomOffset = contentCustomElement.offset().top;
		var scrollPosition = $(window).scrollTop() + $(window).height();

		if (scrollPosition >= contentCustomOffset) {
			stickyBar.addClass("d-none"); // Add the class to hide sticky bar
		} else {
			stickyBar.removeClass("d-none"); // Remove the class to show sticky bar
		}
	});

	// Update price and enable button on valid variation selection
	$("form.variations_form").on("found_variation", function (event, variation) {
		// Enable the button when a valid variation is selected
		addToCartBtn.removeClass("disabled").attr("disabled", false);
	});

	// Disable button if variation selection becomes invalid
	$("form.variations_form").on("reset_data", function () {
		addToCartBtn.addClass("disabled").attr("disabled", true);
	});

	// Add to cart button click
	addToCartBtn.on("click", function (e) {
		e.preventDefault();
		if (!$(this).hasClass("disabled")) {
			$(".single_add_to_cart_button").trigger("click");
		}
	});

	// /* !- Update total price with addon */
	// // Store the previous addon prices globally
	// let prevAddonPrice = 0;
	// let selectedAddonIds = new Set(); // Store selected addon identifiers

	// function updatePrice() {
	// 	let basePriceElement = $(
	// 		".woocommerce-variation-price .woocommerce-Price-amount bdi"
	// 	);
	// 	let basePrice =
	// 		parseFloat(basePriceElement.text().replace(/[^0-9.]/g, "")) || 0;
	// 	let selectedAddons = $(".wc-pao-addon-image-swatch.selected");
	// 	let addonPrice = 0;

	// 	// If base price is 0, exit function
	// 	if (basePrice <= 0) {
	// 		// alert("Base price is 0, skipping addon calculation.");
	// 		return; // Exit the function early if the base price is 0
	// 	}

	// 	// Reset addonIds for each price update
	// 	selectedAddonIds.clear();

	// 	// Loop through each selected addon and sum their prices
	// 	selectedAddons.each(function () {
	// 		let priceText = $(this).attr("data-price") || "0";
	// 		let priceMatch = priceText.match(/£[^0-9]*([\d,]+(\.\d{1,2})?)/);

	// 		if (priceMatch) {
	// 			addonPrice += parseFloat(priceMatch[1].replace(/[^0-9.]/g, "")) || 0;
	// 		}

	// 		// Store unique identifier (e.g., data-price or another attribute)
	// 		let addonIdentifier = $(this).attr("data-price"); // Ensure this is unique
	// 		if (addonIdentifier) {
	// 			selectedAddonIds.add(addonIdentifier);
	// 		}
	// 	});

	// 	let newTotal = basePrice + addonPrice - prevAddonPrice;

	// 	// Update the variation price display
	// 	basePriceElement.html(
	// 		`<span class="woocommerce-Price-currencySymbol">£</span>${newTotal.toFixed(
	// 			2
	// 		)}`
	// 	);

	// 	// Update the previous addon price to the new total
	// 	prevAddonPrice = addonPrice;

	// 	// Debugging output: New Total Price
	// 	// alert("Base Price: " + basePrice);
	// 	// alert("Total Addon Price: " + addonPrice);
	// 	// alert("Previous Addon Price: " + prevAddonPrice);
	// 	// alert("New Total Price: " + newTotal);
	// }

	// // Listen for clicks or touch events on addon image swatches
	// $(document).on("click touchend", ".wc-pao-addon-image-swatch", function () {
	// 	let addonIdentifier = $(this).attr("data-price"); // Ensure identifier is unique

	// 	// Toggle selection based on current state
	// 	if ($(this).hasClass("selected")) {
	// 		selectedAddonIds.add(addonIdentifier);
	// 	} else {
	// 		selectedAddonIds.delete(addonIdentifier);
	// 	}

	// 	updatePrice();
	// });

	// // Ensure price updates when variation changes
	// $(document).on("found_variation", function () {
	// 	updatePrice();
	// });

	// // Preserve Addons When Variations Change
	// $(document).on(
	// 	"click",
	// 	".variable-item, .woo-variation-raw-select",
	// 	function () {
	// 		prevAddonPrice = 0;

	// 		// Wait for variation change, then restore selected addons
	// 		$(".wc-pao-addon-image-swatch").each(function () {
	// 			let addonIdentifier = $(this).attr("data-price"); // Ensure identifier is unique

	// 			// Add or remove the selected class based on previously selected addons
	// 			if (selectedAddonIds.has(addonIdentifier)) {
	// 				$(this).addClass("selected");
	// 			} else {
	// 				$(this).removeClass("selected");
	// 			}
	// 		});

	// 		updatePrice(); // Recalculate price with restored addons
	// 	}
	// );
})(jQuery);

function isElementInViewport(el) {
	const rect = el.getBoundingClientRect();
	return (
		rect.top < window.innerHeight &&
		rect.bottom > 0 &&
		rect.left < window.innerWidth &&
		rect.right > 0
	);
}

function checkVisibility() {
	const selectors = [
		".fade-in-bottom",
		".fade-in-left",
		".fade-in-right",
		".fade-in-top",
	];

	selectors.forEach((selector) => {
		document.querySelectorAll(selector).forEach((el) => {
			if (isElementInViewport(el) && !el.classList.contains("visible")) {
				el.classList.add("visible");
			}
		});
	});
}

document.addEventListener("DOMContentLoaded", () => {
	checkVisibility();
	window.addEventListener("scroll", checkVisibility);
	window.addEventListener("resize", checkVisibility);
});

document.querySelectorAll('[data-bs-toggle="pill"]').forEach((tab) => {
	tab.addEventListener("shown.bs.tab", () => {
		setTimeout(checkVisibility, 150);
	});
});

function triggerUspAnimations() {
	const uspBlock = document.querySelector(".usp-block");
	const logosBlock = document.querySelector(".logo-block");

	if (!uspBlock) return;

	if (!logosBlock) return;

	const rect = uspBlock.getBoundingClientRect();
	const isVisible = rect.top < window.innerHeight && rect.bottom > 0;

	const rectlogo = logosBlock.getBoundingClientRect();
	const isVisibleLogo =
		rectlogo.top < window.innerHeight && rectlogo.bottom > 0;

	if (isVisible || isVisibleLogo) {
		uspBlock
			.querySelectorAll(
				".fade-in-left, .fade-in-right, .fade-in-top, .fade-in-bottom",
			)
			.forEach((el) => {
				el.classList.add("visible");
			});

		logosBlock
			.querySelectorAll(
				".fade-in-left, .fade-in-right, .fade-in-top, .fade-in-bottom",
			)
			.forEach((el) => {
				el.classList.add("visible");
			});
	}
}

// Run on load
document.addEventListener("DOMContentLoaded", () => {
	triggerUspAnimations();
});

// Also run after slider init (important)
window.addEventListener("load", () => {
	triggerUspAnimations();
});

/* Floating Label */
document.addEventListener("DOMContentLoaded", function () {
	const fields = document.querySelectorAll(
		".floating-label .wpcf7-form-control",
	);

	fields.forEach((field) => {
		const wrapper = field.closest(".floating-label");

		const toggleClass = () => {
			let hasValue = false;

			if (field.tagName.toLowerCase() === "select") {
				hasValue = field.selectedIndex > 0; // ignore the first "placeholder" option
			} else {
				hasValue = field.value.trim() !== "";
			}

			wrapper.classList.toggle("has-value", hasValue);
		};

		// Run initially and when field changes
		toggleClass();
		field.addEventListener("input", toggleClass);
		field.addEventListener("change", toggleClass);
		field.addEventListener("blur", toggleClass);
	});
});
