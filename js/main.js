(function ($) {
	jQuery(document).ready(function (){
		// Initialize tinyNav to make main menu select (jump nav)
		$("nav .menu").tinyNav({
			header: 'Menu'
		});
		// $(".utility-nav li ul").removeClass('showmenu');
		// Responsive videos with fitVids
		$(".main-container").fitVids();
		// Add responsive class to table. Makes responsibe tables possible.
		$("table").addClass("responsive");
	});
	// Dropdown menu functionality for utility-nav
	$(function() {
		$(".utility-nav li.dropdown").click(function(){
			$('ul',this).toggleClass('showmenu');
		});
	});
}) (jQuery);


