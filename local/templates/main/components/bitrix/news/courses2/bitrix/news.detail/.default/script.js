jQuery(function($){

	/* Табы */
	$('ul.b-tabs-menu__holder').delegate('li:not(.active)', 'click', function() {
		$(this).addClass('active').siblings().removeClass('active')
			.parents('div.tabs-wrapper').find('.b-exhibition').hide().eq($(this).index()).fadeIn(150);
			
		$('#form-innovetion').hide();	
	});	
	
	$('ul.b-tabs-menu__holder li:first a').click();
	$('div.tabs-wrapper').find('.b-exhibition:first').fadeIn(150);
	
	
	$('a.show_form').click(function(){
		$('div.tabs-wrapper').find('.b-exhibition').hide();
		$('#form-innovetion').fadeIn(150);
		return false;
	});
});