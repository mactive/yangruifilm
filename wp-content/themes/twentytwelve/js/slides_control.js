
jQuery(document).ready(function ($) {
            
    /*
        Initialize SlidesJS
    */

    function currentSlide( current ) {
        $(".current_slide").text(current + " of " + $("#slides").slides("status","total") );
    }

    var _height = parseInt( $(window).height(), 10);
    var _width = parseInt($("#main").width(), 10);


    // $("#slides").slidesjs({
    //     width: _width,
    //     height: _height,
    //     slide: {
    //         interval: 800, // [Number] Interval of fade in milliseconds
    //         browserWindow: false,// [Boolean] Slide in/out from browser window, bad ass
    //         direction: "up"
    //     },
    //     navigation: {
    //       active: false,
    //       effect: "slide"
    //     }
    //   });

    $("#slides").slides({
        navigateEnd: function( current ) {
            currentSlide( current );
        },
        loaded: function(){
            currentSlide( 1 );
        },
        slide: {
            interval: 700, // [Number] Interval of fade in milliseconds
            browserWindow: false // [Boolean] Slide in/out from browser window, bad ass
        },
        navigation: false,
        pagination: false,
        direction: "up",
        width: _width,
        height: _height,
        animationComplete: function(current) {
            // Get the "current" slide number
            
            console.log(current);
        },
        animationStart: function( e ){
            alert('ddd');
        }
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
        checkAmimation();
    });
    
    $("a[rel=next]").click(function(e){
        $("#slides").slides("next");
        checkAmimation();
    });

    // finished amimation
    
    var checkAmimation = function(){
        var item = $('.slidesControl').children(':visible').find('.control');

        hideElement(item);

        $( ".slidesControl" ).promise().done(function(){
            showElement(item);
        });
    };

    /**
     * stop and show animations
     */
    
    var showElement = function( item ){

        var prevBtn = item.find('a[rel=previous]');
        var nextBtn = item.find('a[rel=next]');
        var title  = item.find('.video_title');
        var customer  = item.find('.video_customer');
        var delayTime = 300;

        console.log(title.text());


        title.delay(delayTime).fadeIn();
        customer.delay(delayTime*2).fadeIn();

        prevBtn.delay(delayTime*3).fadeIn();
        nextBtn.delay(delayTime*3).fadeIn();
    };

    var hideElement = function ( item ){

        var prevBtn = item.find('a[rel=previous]');
        var nextBtn = item.find('a[rel=next]');
        var title  = item.find('.video_title');
        var customer  = item.find('.video_customer');

        prevBtn.fadeOut();
        nextBtn.fadeOut();
        title.fadeOut();
        customer.fadeOut();
    };

    // first time init
    var cont = $('.slidesControl').children(':visible:first-child').find('.control');
    showElement(cont);

});
