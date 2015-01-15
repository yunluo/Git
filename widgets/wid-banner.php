<?php  
add_action( 'widgets_init', 'd_banners' );

function d_banners() {
	register_widget( 'd_banner' );
}

class d_banner extends WP_Widget {
	function d_banner() {
		$widget_ops = array( 'classname' => 'd_banner', 'description' => '显示一个广告(包括富媒体)' );
		$this->WP_Widget( 'd_banner', 'Yusi-广告', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$code = $instance['code'];

		echo $before_widget;
		echo '<div class="d_banner_inner">'.$code.'</div>';
		echo $after_widget;
	}

	function form($instance) {
?>
		<p>
			<label>
				广告名称：
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				广告代码：
				<textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
			</label>
		</p>
<?php
	}
}

?>