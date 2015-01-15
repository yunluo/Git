<?php  
add_action( 'widgets_init', 'd_subscribes' );

function d_subscribes() {
	register_widget( 'd_subscribe' );
}

class d_subscribe extends WP_Widget {
	function d_subscribe() {
		$widget_ops = array( 'classname' => 'd_subscribe', 'description' => '显示邮箱订阅组件' );
		$this->WP_Widget( 'd_subscribe', 'Yusi-邮箱订阅', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '邮件订阅';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		$nid = empty( $instance['nid'] ) ? '' : $instance['nid'];
		$info = empty( $instance['info'] ) ? '订阅精彩内容' : $instance['info'];
		$placeholder = empty( $instance['placeholder'] ) ? 'your@email.com' : $instance['placeholder'];
		
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post">'
				.      '<p>' . $info . '</p>'
				.      '<input type="hidden" name="t" value="qf_booked_feedback" /><input type="hidden" name="id" value="' . $nid . '" />'
				.      '<input type="email" name="to" class="rsstxt" placeholder="' . $placeholder . '" value="" required /><input type="submit" class="rssbutton" value="订阅" />'
				.  '</form>';
		
		$output .= $after_widget;

		echo $output;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['nid'] = strip_tags( $new_instance['nid'] );
		$instance['info'] = strip_tags( $new_instance['info'] );
		$instance['placeholder'] = strip_tags( $new_instance['placeholder'] );

		return $instance;
	}
	function form($instance) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$nid = esc_attr( $instance['nid'] );
		$info = esc_attr( $instance['info'] );
		$placeholder = esc_attr( $instance['placeholder'] );

?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'nid' ); ?>">nId：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'nid' ); ?>" name="<?php echo $this->get_field_name( 'nid' ); ?>" type="text" value="<?php echo $nid; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'info' ); ?>">提示文字：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'info' ); ?>" name="<?php echo $this->get_field_name( 'info' ); ?>" type="text" value="<?php echo $info; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'placeholder' ); ?>">占位文字：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="text" value="<?php echo $placeholder; ?>" /></p>
		
		<p class="description">本工具基于 <a href="http://list.qq.com/" target="_blank">QQ邮件列表</a> 服务。</p>
<?php
	}
}

?>