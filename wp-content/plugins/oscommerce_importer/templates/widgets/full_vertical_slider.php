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

<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/slides_control.js"></script>


<?php endif; ?>

<?php echo wpautop( wptexturize( term_description() ) ); ?>
