<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/slides.js"></script>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/slides.css">

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
        });
    </script>


<?php if ( $posts ) : ?>

    <!-- start SlidesJS slideshow -->
    <div id="slides">
    	<?php 
    		foreach($posts as $post){
                $post_meta = get_post_meta($post->ID);
                $big_img = $post_meta['wpcf-big-image'];
                $info_img = $post_meta['wpcf-info-image'];
    	?>
    		<div class="slide_cell" style="background-image:url(<?= $big_img[0] ?>);">
                <a rel="previous"> previous</a>
                <a rel="next"> next </a>
            </div>

    	<?php } ?>
    </div>
    
    <!-- <a href="#" class="controls">Play</a> -->


<?php endif; ?>

<?php echo wpautop( wptexturize( term_description() ) ); ?>
