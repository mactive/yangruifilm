(function($){

    var win_height = $(window).height();

    // for single 
    $('#content').height(win_height);
    $('.slide_cell').height(win_height);
    $('.site-content').css({
        "width": "100%",
        "padding": "0"
    });

    $('.slide_cell .control').css({
        "margin":"0px 80px"
    });

    $('.video_title, .video_customer').css({
        "display": "block"
    });

    $(window).resize(function() {
        var win_height = $(window).height();
        $('#content').height(win_height);
        $('.slide_cell').height(win_height);
    });

})(jQuery);