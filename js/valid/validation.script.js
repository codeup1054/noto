$(document).ready(function() {
	
	$(".contactform").validationEngine('attach');
	//for forms
	$('.contactform').submit(function() { 
		if ( $(this).validationEngine('validate') ) {
			$(this).ajaxSubmit();
			$(this).clearForm();
			$.arcticmodal('close');
			$('#modal_end').arcticmodal();
			setTimeout("$.arcticmodal('close')", 4000);
		}
		return false;
	}); 

	function isElementInViewport(){
		var scrollTop = $(window).scrollTop();
		var viewportHeight = $(window).height()-200;
		$('.head').each(function(){
			var top = $(this).offset().top;
			if(scrollTop + viewportHeight >= top ){
				setTimeout("$('.mikrofon').animate({top:'40px'}, 1750, 'easeOutExpo')", 1500);

			}
		});
	}
	$(isElementInViewport);
	$(window).scroll(isElementInViewport);

	isMobDevice = (/iphone|ipad|Android|webOS|iPod|BlackBerry|Windows Phone|ZuneWP7/gi).test(navigator.appVersion);

	
	
	
	
	
	
	
	
	
});

