jQuery(document).ready(function ($) {
    
    var template = 
        '<div class="overlay">'+
        '<a class="overlay-close"></a>'+
        '<div id="media_area">'+
        '    <div id="mediaplayer" class="videoplayer">'+
        '    </div>'+
        '</div>'+
        '</div>';
    $('body').append(template);

    // play and download
    var video_width  = $(window).width() * 0.6;
    var video_height = video_width * 9 / 16;

    $('div.slide_cell_bg, div.video_info').on('click',function( e ){
        // console.log($(this).attr('rel'));
        $('div.overlay').children('#media_area').show();
        $('div.overlay').fadeIn();

        jwplayer("mediaplayer").setup({
            flashplayer: "http://www.yangruifilms.com/wp-content/themes/twentytwelve/jwplayer/player.swf",
            width:video_width,
            height:video_height,
            levels: [
                {file: $(this).attr('rel')}
            ],
            autostart: true
        });
    });

    //jwplayer().getPlugin("controlbar").hide();
    var marginYOffset = ($(window).height() - video_height)/2;
    $("#media_area").css('margin', marginYOffset+'px auto');
    $("#media_area").css({'width':video_width+'px','':video_height+'px'});

    // close 
    $('a.overlay-close, .overlay').click(function(){
        $('div.overlay').fadeOut();
    })

    $(window).resize(function() {
        var marginYOffset = ($(window).height() - video_height)/2;
        $("#media_area").css('margin', marginYOffset+'px auto');
    });

});