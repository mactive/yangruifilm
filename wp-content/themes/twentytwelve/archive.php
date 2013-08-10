<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>


			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', 'thumbnail' );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

	<div class="overlay">

		<!--[if !IE 6]><!-->
		<div id="media_area">
			<a class="overlay-close"></a>

			<div id="mediaplayer" class="videoplayer">
			</div>
		</div>
		<!--<![endif]-->
	</div>

	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/archive-videowork.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/jwplayer/jwplayer.js"></script>
	<script type="text/javascript">
	
	(function($){

		// videowork layout 
		var options = {
		    mainBody: $('#content')
		};
		archive_videowork.init(options);



		// play and download
		var video_width  = $(window).width() * 0.8;
		var video_height = video_width * 9 / 16;

		$('a.play').on('click',function( e ){
			console.log($(this).attr('rel'));
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

	})(jQuery);


	</script>


<?php get_footer(); ?>