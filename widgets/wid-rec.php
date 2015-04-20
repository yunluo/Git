<?php
add_action( 'widgets_init', 'git_recs' );

function git_recs() {
	register_widget( 'git_rec' );
}

class git_rec extends WP_Widget {
	function git_rec() {
		$widget_ops = array( 'classname' => 'git_rec', 'description' => '五个推荐块' );
		$this->WP_Widget( 'git_rec', 'Git-推荐模块', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$atitle1 = $instance['atitle1'];
		$alink1 = $instance['alink1'];
		$aclass01 = $instance['aclass1'];
		$atitle2 = $instance['atitle2'];
		$alink2 = $instance['alink2'];
		$aclass02 = $instance['aclass2'];
		$atitle3 = $instance['atitle3'];
		$alink3 = $instance['alink3'];
		$aclass03 = $instance['aclass3'];
		$atitle4 = $instance['atitle4'];
		$alink4 = $instance['alink4'];
		$aclass04 = $instance['aclass4'];
		$atitle5 = $instance['atitle5'];
		$alink5 = $instance['alink5'];
		$aclass05 = $instance['aclass5'];
		echo $before_widget;
		echo '<a target="_blank" class="'.$aclass01.'" href="'.$alink1.'" title="'.$atitle1.'" >'.$atitle1.'</a>';
		echo '<a target="_blank" class="'.$aclass02.'" href="'.$alink2.'" title="'.$atitle2.'" >'.$atitle2.'</a>';
		echo '<a target="_blank" class="'.$aclass03.'" href="'.$alink3.'" title="'.$atitle3.'" >'.$atitle3.'</a>';
		echo '<a target="_blank" class="'.$aclass04.'" href="'.$alink4.'" title="'.$atitle4.'" >'.$atitle4.'</a>';
		echo '<a target="_blank" class="'.$aclass05.'" href="'.$alink5.'" title="'.$atitle5.'" >'.$atitle5.'</a>';
		echo $after_widget;
	}

	function form($instance) {
?>
		<p>
			<label>
				第一文字：<input style="width:200px;" id="<?php echo $this->get_field_id('atitle1'); ?>" name="<?php echo $this->get_field_name('atitle1'); ?>" type="text" value="<?php echo $instance['atitle1']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第一链接：<input style="width:200px;" id="<?php echo $this->get_field_id('alink1'); ?>" name="<?php echo $this->get_field_name('alink1'); ?>" type="url" value="<?php echo $instance['alink1']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第一样式：<select style="width:200px;" id="<?php echo $this->get_field_id('aclass1'); ?>" name="<?php echo $this->get_field_name('aclass1'); ?>" >
					<option value="aclass01" <?php selected('aclass01', $instance['aclass1']); ?>>黑色</option>
					<option value="aclass02" <?php selected('aclass02', $instance['aclass1']); ?>>蓝色</option>
					<option value="aclass03" <?php selected('aclass03', $instance['aclass1']); ?>>红色</option>
					<option value="aclass04" <?php selected('aclass04', $instance['aclass1']); ?>>黄色</option>
					<option value="aclass05" <?php selected('aclass05', $instance['aclass1']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第二文字：<input style="width:200px;" id="<?php echo $this->get_field_id('atitle2'); ?>" name="<?php echo $this->get_field_name('atitle2'); ?>" type="text" value="<?php echo $instance['atitle2']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第二链接：<input style="width:200px;" id="<?php echo $this->get_field_id('alink2'); ?>" name="<?php echo $this->get_field_name('alink2'); ?>" type="url" value="<?php echo $instance['alink2']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第二样式：<select style="width:200px;" id="<?php echo $this->get_field_id('aclass2'); ?>" name="<?php echo $this->get_field_name('aclass2'); ?>" >
					<option value="aclass01" <?php selected('aclass01', $instance['aclass2']); ?>>黑色</option>
					<option value="aclass02" <?php selected('aclass02', $instance['aclass2']); ?>>蓝色</option>
					<option value="aclass03" <?php selected('aclass03', $instance['aclass2']); ?>>红色</option>
					<option value="aclass04" <?php selected('aclass04', $instance['aclass2']); ?>>黄色</option>
					<option value="aclass05" <?php selected('aclass05', $instance['aclass2']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第三文字：<input style="width:200px;" id="<?php echo $this->get_field_id('atitle3'); ?>" name="<?php echo $this->get_field_name('atitle3'); ?>" type="text" value="<?php echo $instance['atitle3']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第三链接：<input style="width:200px;" id="<?php echo $this->get_field_id('alink3'); ?>" name="<?php echo $this->get_field_name('alink3'); ?>" type="url" value="<?php echo $instance['alink3']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第三样式：<select style="width:200px;" id="<?php echo $this->get_field_id('aclass3'); ?>" name="<?php echo $this->get_field_name('aclass3'); ?>" >
					<option value="aclass01" <?php selected('aclass01', $instance['aclass3']); ?>>黑色</option>
					<option value="aclass02" <?php selected('aclass02', $instance['aclass3']); ?>>蓝色</option>
					<option value="aclass03" <?php selected('aclass03', $instance['aclass3']); ?>>红色</option>
					<option value="aclass04" <?php selected('aclass04', $instance['aclass3']); ?>>黄色</option>
					<option value="aclass05" <?php selected('aclass05', $instance['aclass3']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第四文字：<input style="width:200px;" id="<?php echo $this->get_field_id('atitle4'); ?>" name="<?php echo $this->get_field_name('atitle4'); ?>" type="text" value="<?php echo $instance['atitle4']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第四链接：<input style="width:200px;" id="<?php echo $this->get_field_id('alink4'); ?>" name="<?php echo $this->get_field_name('alink4'); ?>" type="url" value="<?php echo $instance['alink4']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第四样式：<select style="width:200px;" id="<?php echo $this->get_field_id('aclass4'); ?>" name="<?php echo $this->get_field_name('aclass4'); ?>" >
					<option value="aclass01" <?php selected('aclass01', $instance['aclass4']); ?>>黑色</option>
					<option value="aclass02" <?php selected('aclass02', $instance['aclass4']); ?>>蓝色</option>
					<option value="aclass03" <?php selected('aclass03', $instance['aclass4']); ?>>红色</option>
					<option value="aclass04" <?php selected('aclass04', $instance['aclass4']); ?>>黄色</option>
					<option value="aclass05" <?php selected('aclass05', $instance['aclass4']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />

		<p>
			<label>
				第五文字：<input style="width:200px;" id="<?php echo $this->get_field_id('atitle5'); ?>" name="<?php echo $this->get_field_name('atitle5'); ?>" type="text" value="<?php echo $instance['atitle5']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第五链接：<input style="width:200px;" id="<?php echo $this->get_field_id('alink5'); ?>" name="<?php echo $this->get_field_name('alink5'); ?>" type="url" value="<?php echo $instance['alink5']; ?>" />
			</label>
		</p>
		<p>
			<label>
				第五样式：<select style="width:200px;" id="<?php echo $this->get_field_id('aclass5'); ?>" name="<?php echo $this->get_field_name('aclass5'); ?>" >
					<option value="aclass01" <?php selected('aclass01', $instance['aclass5']); ?>>黑色</option>
					<option value="aclass02" <?php selected('aclass02', $instance['aclass5']); ?>>蓝色</option>
					<option value="aclass03" <?php selected('aclass03', $instance['aclass5']); ?>>红色</option>
					<option value="aclass04" <?php selected('aclass04', $instance['aclass5']); ?>>黄色</option>
					<option value="aclass05" <?php selected('aclass05', $instance['aclass5']); ?>>绿色</option>
				</select>
			</label>
		</p><hr />


<?php
	}
}

?>