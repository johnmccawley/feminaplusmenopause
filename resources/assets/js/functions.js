$(document).ready(function(e) {

	// Mobile nav functionality
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

	// Form submission manipulation
	$("form#newsletter-form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serializeArray();

		$.post("../inc/newsletter.do.php", formData).done(function(response){
			$('.failure-message').hide();
			if (response.success == true) {
				$('.failure-message').hide();
				$('#newsletter-form').fadeOut(function() {
					$('.success-message').fadeIn();
					ga('send', 'event', 'Forms', 'submit', 'Newsletter Sign up');
				});
			} else {
				$('.failure-message').fadeIn();
			}
		});
	});

	$("form#giveaway-form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serializeArray();

		$.post("../inc/giveaway.do.php", formData).done(function(response){
			$('.failure-message').hide();
			if (response.success == true) {
				$('.failure-message').hide();
				$('#giveaway-form').fadeOut(function() {
					$('.success-message').fadeIn();
					ga('send', 'event', 'Forms', 'submit', 'Can Handle Giveaway');
				});
			} else {
				$('.failure-message').fadeIn();

			}
		});

	});

	// Form submission manipulation
	$("form#contact-form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serializeArray();
		var form = $(this);
		$(form).find('input:submit').val('SENDING...').attr("disabled", true);

		$('#contact-form .error').removeClass('error');

		$.post("inc/contact.do.php", formData).done(function(response){

			if(response.errors){
				$(form).find('input:submit').val('SUBMIT').attr("disabled", false);
				$.each( response.errors, function( key, value ) {
					$('#contact-form  #' + value).addClass('error');
				});
			}

			if(response.success == true){
				$(form).trigger('reset');
				$(form).find('input:submit').val('SUBMIT').attr("disabled", false);
				$("#message-container").removeClass('error').addClass('success').html(response.message).fadeIn();
				ga('send', 'event', 'Forms', 'submit', 'Retailer Contact');
			}

			if(response.success == false){
				$(form).find('input:submit').val('SUBMIT').attr("disabled", false);
				$("#message-container").removeClass('success').addClass('error').html(response.message).fadeIn();
			}

		});
	});

	$("form#giveaway-claim").submit(function (e) {

		e.preventDefault();
		var formData = $(this).serializeArray();
		var form = $(this);
		$(form).find('input:submit').val('SENDING...').attr("disabled", true);

		$('form#giveaway-claim .error').removeClass('error');
		$("#message-container").html('').hide();

		$.post("inc/giveaway-claim.do.php", formData).done(function(response){

			if(response.errors){
				$(form).find('input:submit').val('CLAIM OFFER').attr("disabled", false);
				$.each( response.errors, function( i, value ) {
					$('#giveaway-claim  #' + value).addClass('error');
				});
			}

			if(response.success == true){
				$(form).trigger('reset');
				$(form).find('input:submit').val('SUBMIT').attr("disabled", false);
				$("#message-container").removeClass('error').addClass('success').html(response.message).fadeIn();
				ga('send', 'event', 'Forms', 'submit', 'Can Handle Claim');

			}

			if(response.success == false){
				$(form).find('input:submit').val('SUBMIT').attr("disabled", false);
				if(response.messages.length > 0){
					$.each( response.messages, function (i, value) {
						$("#message-container").append("<p>" + value + "</p>");
					});
					$("#message-container").removeClass('success').addClass('error').fadeIn();
				}
			}

		});
	});

});
