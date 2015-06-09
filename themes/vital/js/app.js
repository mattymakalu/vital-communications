/* ---- Vital Scripts ----------------------------------------------------- */
/* ------------------------------------------------------------------------ */
/* ---- Simon Kitson, kitsimons.com --------------------------------------- */

// ---- Globals
	var cl = {
		path: {
			images: 'images/'
		},
		breakpoint: {
			small: 640,
			medium: 920,
			large: 1200
		}
	}

// ---- Foundation
	$(document).foundation();

// ---- Utility functions

	// ---- Check if element exists
	$.fn.exists = function() {
		return $(this).length > 0;
	};

	// ---- Window size
	function updateWindowSize() {
		winW = $(window).width();
		winH = $(window).height();
	}
	updateWindowSize();
	$(window).resize(updateWindowSize);

	// ---- SVG fallback
	if(!Modernizr.svg) {
		$('img[src$=".svg"]').each(function() {
			var $this = $(this);
			$this.attr('src', $this.data('fallback'));
		});
		
	}

// ---- Header Nav Menu
var $headerNavMenu = $('.header--nav ul');
var $headerNavMenuButton = $('.header--nav-menu');

$headerNavMenuButton.on('click', function(e) {
	e.preventDefault();
	$headerNavMenu.toggleClass('open');
	$headerNavMenuButton.toggleClass('open');
});

// ---- Packery Grid
var $packeryContainer;
var itemSelector = '.item';

function initPackery() {
	// Init
	$packeryContainer.packery({
		itemSelector: itemSelector/*,
		gutter: 10*/
	});

}

$(document).ready(function() {

	// ---- Packery Grid
	if($('.packery-container').exists()) {
		$packeryContainer = $('.packery-container');
		initPackery();
	}

});