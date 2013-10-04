(function($){
    // $('.slide_1').height($('.wrapper').height());

	// var menu_height = $('#site-navigation').height();
	// var _margin_top = ( win_height - menu_height) * 0.5;
	
	// $('#site-navigation').css('margin-top', _margin_top + 'px');


	//just for single page
	$('.site-header').height($(window).height());
	$(window).resize(function() {
		$('.site-header').height($(window).height());
	});

})(jQuery);