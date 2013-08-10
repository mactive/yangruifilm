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
.entry-content{text-align:justify; font-size: 14px; line-height: 1.2em;}
</style>

<?php 
    global $post;
    $post_slug=$post->post_name;
?>

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
	// more page
	<?php if ($post_slug == 'about'): ?>

	$('.more-meta').appendTo('#more-5');
	$('#more-5').parent().nextAll().hide();
	$('.more-meta').children('a.more').click(function(){
		$('#more-5').parent().nextAll().fadeIn();
		$(this).fadeOut();

		$("html, body").animate({ scrollTop: $(this).position().top-50 }, 1000);
	});
	<?php endif; ?>

	<?php if ($post_slug == 'schedule'): ?>
		var table = $('table.calendar');
		var td_width =  $('table.calendar tbody').children('tr:eq(1)').children('td:eq(0)').width();
		console.log(td_width);
		var td_height = parseInt(td_width * 9 / 16 );

		// $('table.calendar tbody').children('tr:gt(0)').children('td').css('height',td_height+'px');


	<?php endif; ?>

})(jQuery);
</script>
	
