<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

		
		<?php 
			global $post;
			$id = $post->ID; 
			$args = array( 'post_type' => 'attachment', 'post_parent'=> $id, 'post_mime_type' => 'image/jpeg' );
			$myposts = get_posts( $args );
			// attachment
			$attachment = $myposts[0];
			// thumbnail
			$thumb = wp_get_attachment_image_src( $attachment->ID, 'large' );


			// meta
			$post_meta 	= get_post_meta($post->ID);
            $customer 	= $post_meta['wpcf-customer'][0];
            if (is_array($post_meta['wpcf-video-for-play'])) {
            	$video_play = $post_meta['wpcf-video-for-play'][0];
            }
            $video_download = $post_meta['wpcf-video-for-download'][0];
            // <?php the_permalink();
		?>


		<div class="video_thumbnail" style="background-image:url(<?= $thumb[0] ?>);">
			<div class="thunbmail_info" rel="<?= $video_play?>">
				<div class="info-title"><?php the_title(); ?> <?= $customer; ?></div>
				<div class="info-btn">
					<a class="download" href="<?=$video_download ?>" target="_blank"></a>
					<a class="share"></a>
				</div>
			</div>
		</div>
		
		
