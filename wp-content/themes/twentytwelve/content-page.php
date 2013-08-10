<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<style type="text/css">
.wrapper{background: #fff !important;}
.site-content{width: 90%; padding:3% 5%; font-size: 14px;}
.entry-content{text-align:justify; font-size: 14px; line-height: 1.2em;}
</style>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
<!-- 			<h1 class="entry-title"><?php the_title(); ?></h1>
 -->		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

	</article><!-- #post -->



<script type="text/javascript">
(function($){
	$('.more-meta').appendTo('#more-5');
	$('#more-5').parent().nextAll().hide();
	$('.more-meta').children('a.more').click(function(){
		$('#more-5').parent().nextAll().fadeIn();
		$(this).fadeOut();

		$("html, body").animate({ scrollTop: $(this).position().top-50 }, 1000);
	});

})(jQuery);
</script>
	
