<?php
add_action( 'widgets_init', 'git_slides' );

function git_slides() {
	register_widget( 'git_slide' );
}

class git_slide extends WP_Widget {
	function git_slide() {
		$widget_ops = array( 'classname' => 'git_slide', 'description' => '侧边栏小幻灯片' );
		$this->WP_Widget( 'git_slide', 'Git-幻灯片(风格一)', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$img1 = $instance['img1'];
		$link1 = $instance['link1'];
		$ttitle1 = $instance['ttitle1'];
		$img2 = $instance['img2'];
		$link2 = $instance['link2'];
		$ttitle2 = $instance['ttitle2'];
		$img3 = $instance['img3'];
		$link3 = $instance['link3'];
		$ttitle3 = $instance['ttitle3'];
		$img4 = $instance['img4'];
		$link4 = $instance['link4'];
		$ttitle4 = $instance['ttitle4'];
		echo $before_widget;
		echo '<div id="wowslider-container1"><div class="ws_images"><ul>';
		echo '<li><a target="_blank" href="'.$link1.'" title="'.$ttitle1.'" ><img src="'.$img1.'" ></a></li>';
		echo '<li><a target="_blank" href="'.$link2.'" title="'.$ttitle2.'" ><img src="'.$img2.'" ></a></li>';
		echo '<li><a target="_blank" href="'.$link3.'" title="'.$ttitle3.'" ><img src="'.$img3.'" ></a></li>';
		echo '<li><a target="_blank" href="'.$link4.'" title="'.$ttitle4.'" ><img src="'.$img4.'" ></a></li>';
		echo '</ul></div></div>';
		echo $after_widget;
	}

	function form($instance) {
?>
		<p>
			<label>
				幻灯一图片：<span class="git_tip">360×149</span>
				<input id="<?php echo $this->get_field_id('img1'); ?>" name="<?php echo $this->get_field_name('img1'); ?>" type="text" value="<?php echo $instance['img1']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				幻灯一链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link1'); ?>" name="<?php echo $this->get_field_name('link1'); ?>" type="url" value="<?php echo $instance['link1']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				幻灯一标题：
				<input id="<?php echo $this->get_field_id('ttitle1'); ?>" name="<?php echo $this->get_field_name('ttitle1'); ?>" type="text" value="<?php echo $instance['ttitle1']; ?>" class="widefat" />
			</label>
		</p><hr />
		<p>
			<label>
				幻灯二图片：<span class="git_tip">360×149</span>
				<input id="<?php echo $this->get_field_id('img2'); ?>" name="<?php echo $this->get_field_name('img2'); ?>" type="text" value="<?php echo $instance['img2']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				幻灯二链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link2'); ?>" name="<?php echo $this->get_field_name('link2'); ?>" type="url" value="<?php echo $instance['link2']; ?>" size="24" />
			</label>
		</p>
				<p>
			<label>
				幻灯二标题：
				<input id="<?php echo $this->get_field_id('ttitle2'); ?>" name="<?php echo $this->get_field_name('ttitle2'); ?>" type="text" value="<?php echo $instance['ttitle2']; ?>" class="widefat" />
			</label>
		</p><hr />
		<p>
			<label>
				幻灯三图片：<span class="git_tip">360×149</span>
				<input id="<?php echo $this->get_field_id('img3'); ?>" name="<?php echo $this->get_field_name('img3'); ?>" type="text" value="<?php echo $instance['img3']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				幻灯三链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link3'); ?>" name="<?php echo $this->get_field_name('link3'); ?>" type="url" value="<?php echo $instance['link3']; ?>" size="24" />
			</label>
		</p>
				<p>
			<label>
				幻灯三标题：
				<input id="<?php echo $this->get_field_id('ttitle3'); ?>" name="<?php echo $this->get_field_name('ttitle3'); ?>" type="text" value="<?php echo $instance['ttitle3']; ?>" class="widefat" />
			</label>
		</p><hr />
		<p>
			<label>
				幻灯四图片：<span class="git_tip">360×149</span>
				<input id="<?php echo $this->get_field_id('img4'); ?>" name="<?php echo $this->get_field_name('img4'); ?>" type="text" value="<?php echo $instance['img4']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				幻灯四链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link4'); ?>" name="<?php echo $this->get_field_name('link4'); ?>" type="url" value="<?php echo $instance['link4']; ?>" size="24" />
			</label>
		</p>
				<p>
			<label>
				幻灯四标题：
				<input id="<?php echo $this->get_field_id('ttitle4'); ?>" name="<?php echo $this->get_field_name('ttitle4'); ?>" type="text" value="<?php echo $instance['ttitle4']; ?>" class="widefat" />
			</label>
		</p><hr />
<?php
	}
}

?>