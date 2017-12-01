<?php
/**
 * Points widget.
 */
class Points_Widget extends WP_Widget {

	/**
	 * Creates a points widget.
	 */
	function __construct() {
		parent::__construct( false, $name = '用户积分排行榜' );
	}

	/**
	 * Widget output
	 * 
	 * @see WP_Widget::widget()
	 */
	function widget( $args, $instance ) {

		extract( $args );
		$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$widget_id = $args['widget_id'];
		echo $before_widget;
		if ( !empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$limit = $instance['limit'];
		$order = $instance['order'];
		$order_by = 'points';

		$pointsusers = Points::get_users_total_points( $limit, $order_by, $order, POINTS_STATUS_ACCEPTED );

		if ( sizeof( $pointsusers )>0 ) {
			echo '<ul>';
			foreach ( $pointsusers as $pointsuser ) {
				echo '<li>';
				echo '<span class="points-user-username">';
				echo get_user_meta ( $pointsuser->user_id, 'nickname', true );
				echo ':</span>';
				echo '<span class="points-user-points">';
				echo $pointsuser->total . " " . get_option('points-points_label', POINTS_DEFAULT_POINTS_LABEL);
				echo '</span>';
				echo '</li>';
			}
			echo '</ul>';
		} else {
			echo '<p>没有用户</p>';
		}

		echo $after_widget;
	}

	/**
	 * Save widget options
	 * 
	 * @see WP_Widget::update()
	 */
	function update( $new_instance, $old_instance ) {
		$settings = $old_instance;

		// title
		if ( !empty( $new_instance['title'] ) ) {
			$settings['title'] = strip_tags( $new_instance['title'] );
		} else {
			unset( $settings['title'] );
		}

		// limit
		if ( !empty( $new_instance['limit'] ) ) {
			$settings['limit'] = strip_tags( $new_instance['limit'] );
		} else {
			unset( $settings['limit'] );
		}

		// order
		if ( !empty( $new_instance['order'] ) ) {
			$settings['order'] = strip_tags( $new_instance['order'] );
		} else {
			unset( $settings['order'] );
		}

		return $settings;
	}

	/**
	 * Output admin widget options form
	 * 
	 * @see WP_Widget::form()
	 */
	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">标题:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php
		$limit = isset( $instance['limit'] ) ? esc_attr( $instance['limit'] ) : '5';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">显示用户的数量:</label> 
			<input class="" size="3" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo $limit; ?>" />
		</p>
		<?php
		$order = isset( $instance['order'] ) ? esc_attr( $instance['order'] ) : 'DESC';
		$selectdesc = ($order == 'DESC')?"selected":"";
		$selectasc = ($order == 'ASC')?"selected":"";
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>">排序:</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" >
				<option value="DESC" <?php echo $selectdesc;?> >Desc</option>
				<option value="ASC" <?php echo $selectasc;?> >Asc</option>
			</select>
		</p>
		<?php

	}
}
?>