(function($){


    $('.slide_1').height($('.wrapper').height());

	var win_height = $(window).height();
	var menu_height = $('#site-navigation').height();
	var _margin_top = ( win_height - menu_height) * 0.6;


	$('#site-navigation').css('margin-top', _margin_top + 'px');


})(jQuery);