<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/jwplayer/jwplayer.js"></script>

        <script>
        /*
            Get the curent slide
        */

        jQuery(document).ready(function ($) {

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

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<input type="hidden" id="single_post" value="true">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	
	<div class="overlay">

        <!--[if !IE 6]><!-->
        <div id="media_area">
            <a class="overlay-close"></a>

            <div id="mediaplayer" class="videoplayer">
            </div>
        </div>
        <!--<![endif]-->
    </div>

<?php get_footer(); ?>