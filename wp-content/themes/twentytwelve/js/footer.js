(function($){


    $('.slide_1').height($('.wrapper').height());

	var win_height = $(window).height();
	var menu_height = $('#site-navigation').height();
	var _margin_top = ( win_height - menu_height) * 0.5;


	//just for single page
	var big_img = $('input#single_post').val();
	if (big_img == 'true') {
		$('#site-navigation').css('margin-top', _margin_top + 'px');

		// for single 
		$('#content').height(win_height);
		$('.site-content').css({
	    	"width": "100%",
	    	"padding": "0"
	  	});

	  	$('.slide_cell .control').css({
	  		"margin":"0px 80px"
	  	});
	};


})(jQuery);