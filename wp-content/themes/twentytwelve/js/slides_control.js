
jQuery(document).ready(function ($) {
            
    /*
        Initialize SlidesJS
    */

    function currentSlide( current ) {
        $(".current_slide").text(current + " of " + $("#slides").slides("status","total") );
    }

    var _height = parseInt( $(window).height(), 10);
    var _width = parseInt($("#main").width(), 10);

    $("#slides").slides({
        navigateEnd: function( current ) {
            currentSlide( current );
        },
        loaded: function(){
            currentSlide( 1 );
        },
        slide: {
            interval: 800, // [Number] Interval of fade in milliseconds
            browserWindow: false // [Boolean] Slide in/out from browser window, bad ass
        },
        navigation: false,
        pagination: false,
        direction: "up",
        width: _width,
        height: _height
    });
    
    $(window).resize(function() {
        var _height = parseInt( $(window).height(), 10);
        var _width = parseInt($("#main").width(), 10);
        $('.slidesContainer').width('100%');
        $('.slidesContainer').height(_height);
        $('.slidesControl').width('100%').height('100%');
    });


    /*
        Play/stop button
    */
    // button hover
    var offset_dis = "5px";
    var offset_dur = 200 ;
    $("a[rel=previous]").hover(
        function(){
            $(this).filter(':not(:animated)').animate({
                top: '0px'
            },offset_dur);
        },
        function() {
            $(this).animate({
                top: offset_dis
            },offset_dur);
        }
    );

    $("a[rel=next]").hover(
        function(){
            $(this).filter(':not(:animated)').animate({
                bottom: '0px'
            },offset_dur);
        },
        function() {
            $(this).animate({
                bottom: offset_dis
            },offset_dur);
        }
    );
    

    $("a[rel=previous]").click(function(e){
        $("#slides").slides("previous");
    });
    
    $("a[rel=next]").click(function(e){
        $("#slides").slides("next");
    });


    $(".controls").click(function(e) {
        e.preventDefault();
        
        // Example status method usage
        var slidesStatus = $("#slides").slides("status","state");
        
        if (!slidesStatus || slidesStatus === "stopped") {

            // Example play method usage
            $("#slides").slides("play");

            // Change text
            $(this).text("Stop");
        } else {
            
            // Example stop method usage
            $("#slides").slides("stop");
            
            // Change text
            $(this).text("Play");
        }
    });


    // play and download
    var video_width  = $(window).width() * 0.8;
    var video_height = video_width * 9 / 16;

    $('div.slide_cell_bg, div.video_info').on('click',function( e ){
        // console.log($(this).attr('rel'));
        $('div.overlay').children('#media_area').show();
        $('div.overlay').fadeIn();

        jwplayer("mediaplayer").setup({
            flashplayer: "<?php bloginfo( 'template_url' ); ?>/jwplayer/player.swf",
            width:video_width,
            height:video_height,
            levels: [
                {file: $(this).attr('rel')}
            ],
            autostart: true
        });
    });

    //jwplayer().getPlugin("controlbar").hide();
    var marginOffset = $(window).height() - video_height;
    // console.log(marginOffset);
    $("#media_area").css('margin', marginOffset/2+'px auto');
    $("#media_area").css({'width':video_width+'px','':video_height+'px'});

    // close 
    $('a.overlay-close').click(function(){
        $('div.overlay').fadeOut();
    })


});
