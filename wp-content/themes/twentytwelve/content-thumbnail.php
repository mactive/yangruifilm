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
			$attachment = $myposts[0];
			$thumb = wp_get_attachment_image_src( $attachment->ID, 'large' );
		?>


		<div class="video_thumbnail" style="background-image:url(<?= $thumb[0] ?>);">

		</div>
		
		
