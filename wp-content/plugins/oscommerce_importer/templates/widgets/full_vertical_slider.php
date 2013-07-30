<?php
/**
 * Show a brands description when on a taxonomy page
 */
?>
<script type="text/javascript" charset="utf-8">

jQuery(document).ready(function ($) {


});


</script>

<?php if ( $posts ) : ?>
    adfadf
<div id="sidebar" style="width: <?php _e($width); ?>px !important;">
	<ul class="news_image_slider">
	<?php 
		foreach($posts as $post){
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
