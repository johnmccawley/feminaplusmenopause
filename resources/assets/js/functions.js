$(document).ready(function() {

    // Product tabs
    $(".tabs a").click(function(event) {
		event.preventDefault(event);
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });

    // Mobile navigation
	$(function() {
		$('#mobile-nav-btn, #menu-overlay').click(function() {
			toggleNav();
		});
	});

	function toggleNav() {
		if ($('#site-wrapper').hasClass('show-nav')) {
			// Do things on Nav Close
			$('#site-wrapper').removeClass('show-nav');
			$('#menu-overlay').fadeOut();
			$('#menu-close').hide();
			$('#menu-open').fadeIn();
		} else {
			// Do things on Nav Open
			$('#menu-overlay').fadeIn();
			$('#site-wrapper').addClass('show-nav');
			$('#menu-open').hide();
			$('#menu-close').fadeIn();
		}
	}

	// Address check
	$("#address-checkbox").click(function(){
		if($("#address-checkbox").is(':checked')){
			$("#shipping-info").slideUp()
		} else {
			$("#shipping-info").slideDown();
		}
	});

	// FAQ
	$(".question-box").click(function() {
		if( $(this).find('.answer').is(":visible") ){
			$(this).find('.answer').slideUp();
		} else {
			$(this).find('.answer').slideDown();
		}
	});

});
