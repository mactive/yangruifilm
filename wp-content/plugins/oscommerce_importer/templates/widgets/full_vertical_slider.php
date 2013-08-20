<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/slides.css">
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/slides.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/jwplayer/jwplayer.js"></script>


<?php if ( $posts ) : ?>

    <!-- start SlidesJS slideshow -->
    <div id="slides">
    	<?php 
    		foreach($posts as $post){
                $post_meta = get_post_meta($post->ID);
                $big_img = $post_meta['wpcf-big-image'];
                // $info_img = $post_meta['wpcf-info-image'];
                $customer   = $post_meta['wpcf-customer'][0];
                if (is_array($post_meta['wpcf-video-for-play'])) {
                    $video_play = $post_meta['wpcf-video-for-play'][0];
                }
    	?>
    		<div class="slide_cell">
                <div class="control">
                    <a class="prev_btn" rel="previous"></a>
                    <div class="video_info" rel="<?= $video_play ?>">
                        <span class="video_title"><?= $post->post_title ?></span>
                        <span class="video_customer"><?= $customer ?></span>
                    </div>
                    <a class="next_btn" rel="next"> </a>
                </div>
                <div class="slide_cell_bg" rel="<?= $video_play ?>" style="background-image:url(<?= $big_img[0] ?>);"></div>
            </div>

    	<?php } ?>
    </div>
    

    <div class="overlay">

        <!--[if !IE 6]><!-->
        <div id="media_area">
            <a class="overlay-close"></a>

            <div id="mediaplayer" class="videoplayer">
            </div>
        </div>
        <!--<![endif]-->
    </div>

    <script>
        /*
            Get the curent slide
        */

        jQuery(document).ready(function ($) {
            /*
                Initialize SlidesJS
            */

            function currentSlide( current ) {
                $(".current_slide").text(current + " of " + $("#slides").slides("status","total") );
            }

            var _height = parseInt($("#main").height(), 10);
            var _width = parseInt($("#main").width(), 10);

            console.log(_height+" "+ _width);

            $("#slides").slides({
                navigateEnd: function( current ) {
                    currentSlide( current );
                },
                loaded: function(){
                    currentSlide( 1 );
                },
                navigation: false,
                pagination: false,
                direction: "up",
                width: _width,
                height: _height
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
                console.log($(this).attr('rel'));
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
            console.log(marginOffset);
            $("#media_area").css('margin', marginOffset/2+'px auto');
            $("#media_area").css({'width':video_width+'px','':video_height+'px'});

            // close 
            $('a.overlay-close').click(function(){
                $('div.overlay').fadeOut();
            })


        });
    </script>


<?php endif; ?>

<?php echo wpautop( wptexturize( term_description() ) ); ?>
