jQuery(function($){

	/* Табы */
	$('ul.b-tabs-menu__holder').delegate('li:not(.active)', 'click', function() {
		$(this).addClass('active').siblings().removeClass('active')
			.parents('div.tabs-wrapper').find('.b-exhibition').hide().eq($(this).index()).fadeIn(150);
			
			
	var $active = $(this).parents('div.tabs-wrapper').find('.b-exhibition').eq($(this).index());
		if ($active.find('.js-slick-slider-for-2').length){
			$(".js-slick-slider-for-2").slick({
	            slidesToShow: 1,
	            slidesToScroll: 1,
	            arrows: !1,
	            fade: !0,
	            asNavFor: ".js-slick-slider-nav-2"
		    });
		    $(".js-slick-slider-nav-2").slick({
		        slidesToShow: 9,
		        slidesToScroll: 1,
		        asNavFor: ".js-slick-slider-for-2",
		        focusOnSelect: !0,
		        responsive: [{breakpoint: 950, settings: {slidesToShow: 5}}]
		    });
		}
			
		$('#form-innovetion').hide();	
	});	
	
	$('ul.b-tabs-menu__holder li:first a').addClass('active');
	$('div.tabs-wrapper').find('.b-exhibition:first').fadeIn(150);
	
	
	$('a.show_form').click(function(){
		$('div.tabs-wrapper').find('.b-exhibition').hide();
		$('#form-innovetion').fadeIn(150);
		return false;
	});
	
});