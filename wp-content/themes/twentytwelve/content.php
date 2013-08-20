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

			$post_meta = get_post_meta($post->ID);
            $big_img = $post_meta['wpcf-big-image'];
            // $info_img = $post_meta['wpcf-info-image'];
            $customer   = $post_meta['wpcf-customer'][0];
            if (is_array($post_meta['wpcf-video-for-play'])) {
                $video_play = $post_meta['wpcf-video-for-play'][0];
            }
			// echo $big_img[0];
		?>

		<div class="slide_cell">
            <div class="control">
                <div class="video_info" rel="<?= $video_play ?>">
                    <span class="video_title"><?= $post->post_title ?></span>
                    <span class="video_customer"><?= $customer ?></span>

                </div>
            </div>
            <div class="slide_cell_bg" rel="<?= $video_play ?>" style="background-image:url(<?= $big_img[0] ?>);">
            </div>
        </div>
