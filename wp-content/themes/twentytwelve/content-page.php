<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php 
    global $post;
    $post_slug=$post->post_name;
?>
<style type="text/css">
.wrapper{background: #fff !important;}
</style>



	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
<!-- 			<h1 class="entry-title"><?php the_title(); ?></h1>
 -->	</header>

		<div class="entry-content">
			<?php if ($post_slug == 'contact'): ?>
				<div class="contact-form">
					<span class="input-title">留下邮箱地址，即可订阅更新的作品信息</span><br>
					<span class="input-title"> 邮件地址： </span><input type="text" size="30" plaseholder="输入Email地址">	 
					<span class="input-title"> 姓名：</span> <input type="text" size="10" plaseholder="输入姓名">
					<input type="submit" value="订阅">
				</div>
				<div class="contact-info">
					<div class="wechat">
						<img src="<?php bloginfo( 'template_url' ); ?>/img/wechat.png" /> 
					</div>
					<div class="info-text">
						+86 18911072107   /   yangrui@yangruifilms.com</div>
				</div>
			<?php else: ?>
				<?php the_content(); ?>
			<?php endif; ?>


		</div><!-- .entry-content -->
	</article><!-- #post -->



<script type="text/javascript">
(function($){
	// more page
	<?php if ($post_slug == 'about'): ?>
	
		var more_meta = $('<a class="more">more</a>');
		more_meta.appendTo('#more-5');
		$('#more-5').parent().nextAll().hide();
		$('#more-5').children('a.more').on('click',function(){
			$('#more-5').parent().nextAll().fadeIn();
			$(this).fadeOut();
			$("html, body").animate({ scrollTop: $(this).position().top-10 }, 1000);
		});

	<?php endif; ?>

	<?php if ($post_slug == 'schedule'): ?>
		
		var table = $('table.calendar');
		var td_width =  $('table.calendar tbody').children('tr:eq(1)').children('td:eq(0)').width();
		var td_height = parseInt(td_width * 9 / 16 );

		// $('table.calendar tbody').children('tr:gt(0)').children('td').css('height',td_height+'px');

	<?php endif; ?>

})(jQuery);
</script>

<?php if ($post_slug == 'contact'): ?>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/single_resize.js"></script>
<?php endif; ?>

