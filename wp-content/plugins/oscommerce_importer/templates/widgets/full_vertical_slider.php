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

            $("#slides").slides({
                navigateEnd: function( current ) {
                    currentSlide( current );
                },
                loaded: function(){
                    currentSlide( 1 );
                },
                navigation: true,
                direction: "up"
            });
            
            /*
                Play/stop button
            */
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
                <img src="http://www.slidesjs.com/img/example-slide-350-1.jpg" width="780" height="300" alt="Slide 1">
                
                <img src="http://www.slidesjs.com/img/example-slide-350-2.jpg" width="780" height="300" alt="Slide 2">

                <img src="http://www.slidesjs.com/img/example-slide-350-3.jpg" width="780" height="300" alt="Slide 3">

                <img src="http://www.slidesjs.com/img/example-slide-350-4.jpg" width="780" height="300" alt="Slide 4">

        </div>

<div id="sidebar" style="width: <?php _e($width); ?>px !important;">
	<ul class="news_image_slider">
	<?php 
		foreach($posts as $post){
            $post_meta = get_post_meta($post->ID);



			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
			$url = $thumb['0'];
	?>
		<li>
            <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>" style="background-image:url(<?php echo $url; ?>);">
            <b>

                <?php
                    $short_title = get_post_meta($post->ID,'short_title');
                    if (empty($short_title[0])) {
                        echo $post->post_title;
                    }else{
                        echo $short_title[0];
                    }

                ?>
            </b>
            </a>
        </li>
	<?php } ?>
	</ul>
</div>


<?php endif; ?>

<?php echo wpautop( wptexturize( term_description() ) ); ?>
