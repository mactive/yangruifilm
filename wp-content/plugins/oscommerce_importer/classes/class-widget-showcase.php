<?php
/**
 * Brand Description Widget
 *
 * When viewing a brand archive, show the current brands description + image
 *
 * @package		WooCommerce
 * @category	Widgets
 * @author		WooThemes
 */


class Showcase_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */

	public function __construct() {
		parent::__construct(
	 		'showcase_Widget', // Base ID
			__('Showcase_Widget','oscpro'), // Name
			array( 'description' => __( 'A Showcase Widget', 'oscpro' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$catslug_first 	= $instance['catslug_first']; // product_cat
		$catslug_second = $instance['catslug_second']; // product_cat
		$width = $instance['width']; // 宽高大小
		$count = $instance['count']; // 数量

		global $wpdb;

		// get the $term->term_taxonomy_id 和分类相关的产品
		$term_first = get_term_by('slug',$catslug_first,'product_cat');
		// data
		$posts_first = $wpdb->get_results( 
			" SELECT posts.post_title, posts.ID FROM {$wpdb->term_relationships} AS rel ".
			" LEFT JOIN {$wpdb->posts} AS posts ON posts.ID=rel.object_ID".
			" WHERE rel.term_taxonomy_id = $term_first->term_taxonomy_id ".
			" limit 0,$count "
		 );

		// get the $term->term_taxonomy_id 和分类相关的产品
		$term_second = get_term_by('slug',$catslug_second,'product_cat');
		// data
		$posts_second = $wpdb->get_results( 
			" SELECT posts.post_title, posts.ID FROM {$wpdb->term_relationships} AS rel ".
			" LEFT JOIN {$wpdb->posts} AS posts ON posts.ID=rel.object_ID".
			" WHERE rel.term_taxonomy_id = $term_second->term_taxonomy_id ".
			" limit 0,$count "
		 );
		

		echo $before_widget;
		echo $before_title.$title.$after_title;
		woocommerce_get_template( 'widgets/index_showcase.php', array(
			'posts_first'	=> $posts_first,
			'posts_second'	=> $posts_second,
			'width' => $width,
			'count' => $count
		), 'oscommerce_importer', untrailingslashit( plugin_dir_path( dirname( dirname( __FILE__ ) ) ) ) . '/oscommerce_importer/templates/' );


		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
  		$instance['catslug_first'] = $new_instance['catslug_first'];
  		$instance['catslug_second'] = $new_instance['catslug_second'];
  		$instance['width'] = $new_instance['width'];
  		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Showcase Slider', 'text_domain' );
		}

		// catslug_first
		if ( isset( $instance[ 'catslug_first' ] ) ) {
			$catslug_first = urldecode($instance[ 'catslug_first' ]);
		}
		else {
			$catslug_first = __( 'first cat', 'text_domain' );
		}

		// catslug_second
		if ( isset( $instance[ 'catslug_second' ] ) ) {
			$catslug_second = urldecode($instance[ 'catslug_second' ]);
		}
		else {
			$catslug_second = __( 'second cat', 'text_domain' );
		}


		if ( isset( $instance[ 'width' ] ) ) {
			$width = $instance[ 'width' ];
		}
		else {
			$width = __( '150', 'text_domain' );
		}

		if ( isset( $instance[ 'count' ] ) ) {
			$count = $instance[ 'count' ];
		}
		else {
			$count = __( '8', 'text_domain' );
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p id="catslug_first">
		    <label for="<?php echo $this->get_field_id('catslug_first'); ?>">First Category Name:</label>
		    <?php woocommerce_product_dropdown_categories();?>
		    <input class="widefat" id="<?php echo $this->get_field_id( 'catslug_first' ); ?>" name="<?php echo $this->get_field_name( 'catslug_first' ); ?>" type="text" value="<?php echo esc_attr( $catslug_first ); ?>" />
		    <script type="text/javascript">
			    jQuery(document).ready(function ($) {
			    	console.log($("#dropdown_product_cat"));
					$('#catslug_first #dropdown_product_cat').live('change', function() {
						$(this).next('input').val($(this).val());
					});	
				});	    
			</script>
		</p>


		<p id="catslug_second">
		    <label for="<?php echo $this->get_field_id('catslug_second'); ?>">Second Category Name:</label>
		    <?php woocommerce_product_dropdown_categories();?>
		    <input class="widefat" id="<?php echo $this->get_field_id( 'catslug_second' ); ?>" name="<?php echo $this->get_field_name( 'catslug_second' ); ?>" type="text" value="<?php echo esc_attr( $catslug_second ); ?>" />
		    <script type="text/javascript">
			    jQuery(document).ready(function ($) {
			    	console.log($("#dropdown_product_cat"));
					$('#catslug_second #dropdown_product_cat').live('change', function() {
						$(this).next('input').val($(this).val());
					});	
				});	    
			</script>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
		</p>
		<?php 
	}

} // class News_Widget