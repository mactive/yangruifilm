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
		<?php 
			global $query_string;
			query_posts( $query_string . '&order=DESC' );
		?>
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
		<a class="overlay-close"></a>

		<!--[if !IE 6]><!-->
		<div id="media_area">
			<div id="mediaplayer" class="videoplayer">
			</div>
		</div>
		<!--<![endif]-->

		<div id="share_area">
			<div class="share-cell weibo_share">

			</div>
<!-- 			<div class="share-cell tecent_share">
			</div>
			<div class="share-cell">
				Others
			</div> -->
			
		</div>
	</div>

	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/jwplayer/jwplayer.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/archive-videowork.js"></script>

	<script type="text/javascript">
	
		(function($){

		    // videowork layout 
		    var options = {
		        mainBody: $('#content')
		    };
		    archive_videowork.init(options);


		    // play and download
		    var video_width  = $(window).width() * 0.6;
		    var video_height = video_width * 9 / 16;

		    $('div.thunbmail_info > .info_bg').on('click',function( e ){
		      // console.log($(this).attr('rel'));
		      $('div.overlay').css('height',$(window).height());
		      $('div.overlay').children('#media_area').show();
		      $('div.overlay').children('#share_area').hide();
		      $('div.overlay').css('top',$(window).scrollTop());


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
		    var marginYOffset = ($(window).height() - video_height)/2;
		    $("#media_area").css('margin', marginYOffset+'px auto');
		    $("#media_area").css({'width':video_width+'px','':video_height+'px'});

		    $(window).resize(function() {
		        var marginYOffset = ($(window).height() - video_height)/2;
		        $("#media_area").css('margin', marginYOffset+'px auto');
		    });

		    $('div.info-btn > .share').on('click',function( e ){
		    	e.preventDefault();
		    	var _url = $(this).attr('rel');
		    	var _title = "杨锐导演 -- 作品 " + $(this).attr('title');

		      $('div.overlay').children('#media_area').hide();
		      $('div.overlay').children('#share_area').show();
		      $('div.overlay').fadeIn();

		      $("#share_area").css('margin', marginOffset/2+'px auto');
		   	  $("#share_area").css({'width':video_width+'px','':video_height+'px'});

		   	  //========================================
		   	  // weibo code
		   	  //========================================

			  var _w = 142 , _h = 66;
			  var param = {
			    url:_url,
			    type:'4',
			    count:'1', /**是否显示分享数，1显示(可选)*/
			    appkey:'', /**您申请的应用appkey,显示分享来源(可选)*/
			    title: _title, /**分享的文字内容(可选，默认为所在页面的title)*/
			    pic:'', /**分享图片的路径(可选)*/
			    ralateUid:'2342823483', /**关联用户的UID，分享微博会@该用户(可选)*/
			    language:'zh_cn', /**设置语言，zh_cn|zh_tw(可选)*/
			    dpc:1
			  }
			  var temp = [];
			  for( var p in param ){
			    temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
			  };
			  $('.weibo_share').html('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://service.weibo.com/staticjs/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>');
						
			  $('.weibo_share').append('<br><br><br>Sina Weibo');

			  //========================================
		   	  // tencent code
		   	  //========================================

		   	  var tecent_html = '<a href="http://share.v.t.qq.com/index.php?c=share&a=index&url=';
				tecent_html+= _url +'&title=' + _title ;
				tecent_html+= '"><img src="http://open.t.qq.com/apps/share/images/s/b32.png" alt=""></a>';

		   	  $('.tecent_share').html(tecent_html);
		   	  $('.tecent_share').append('<br><br><br>Tencent Weibo');
		

		    });
		    


		    // close 
		    $('a.overlay-close, .overlay').click(function(){
		      $('div.overlay').fadeOut();
		    })

		  })(jQuery);

	</script>

<?php get_footer(); ?>