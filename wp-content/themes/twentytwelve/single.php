<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<style type="text/css">
    .site-content{
        width: 100%;
        padding: 0;
    }
    .slide_cell .control{ margin-top:  0px; }
    .slide_cell .control .video_info .video_title { display: block;}
    .slide_cell .control .video_info .video_customer { display: block;}
</style>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<input type="hidden" id="single_post" value="true">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<script type="text/javascript">
(function($){
    $('.slide_cell').height($('.wrapper').height());
    $(window).resize(function() {
        $('.slide_cell').height($('.wrapper').height());
    });


})(jQuery);
</script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/jwplayer/jwplayer.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/video_work.js"></script>


<?php get_footer(); ?>