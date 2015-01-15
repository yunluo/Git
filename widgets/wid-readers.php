<?php  
add_action( 'widgets_init', 'd_readers' );

function d_readers() {
	register_widget( 'd_reader' );
}

class d_reader extends WP_Widget {
	function d_reader() {
		$widget_ops = array( 'classname' => 'd_reader', 'description' => '显示近期评论频繁的网友头像等' );
		$this->WP_Widget( 'd_reader', 'Yusi-活跃读者', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$limit = $instance['limit'];
		$outer = $instance['outer'];
		$timer = $instance['timer'];
		$addlink = $instance['addlink'];
		$more = $instance['more'];
		$link = $instance['link'];

		$mo='';
		if( $more!='' && $link!='' ) $mo='<a class="btn" href="'.$link.'">'.$more.'</a>';

		echo $before_widget;
		echo $before_title.$mo.$title.$after_title; 
		echo '<ul>';
		echo dtheme_readers( $out=$outer, $tim=$timer, $lim=$limit, $addlink );;
		echo '</ul>';
		echo $after_widget;
	}
	function form($instance) {

?>
		<p>
			<label>
				标题：
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某人：
				<input class="widefat" id="<?php echo $this->get_field_id('outer'); ?>" name="<?php echo $this->get_field_name('outer'); ?>" type="text" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				几天内：
				<input class="widefat" id="<?php echo $this->get_field_id('timer'); ?>" name="<?php echo $this->get_field_name('timer'); ?>" type="number" value="<?php echo $instance['timer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['addlink'], 'on' ); ?> id="<?php echo $this->get_field_id('addlink'); ?>" name="<?php echo $this->get_field_name('addlink'); ?>">加链接
			</label>
		</p>
		<p>
			<label>
				More 显示文字：
				<input style="width:100%;" id="<?php echo $this->get_field_id('more'); ?>" name="<?php echo $this->get_field_name('more'); ?>" type="text" value="<?php echo $instance['more']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				More 链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $instance['link']; ?>" size="24" />
			</label>
		</p>

<?php
	}
}

/* 
 * 读者墙
 * dtheme_readers( $outer='name', $timer='3', $limit='14' );
 * $outer 不显示某人
 * $timer 几个月时间内
 * $limit 显示条数
*/
function dtheme_readers($out,$tim,$lim,$addlink){
	global $wpdb;
	$counts = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $tim day ) and user_id='0' and comment_author != '".$out."' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author order by cnt desc limit $lim");
	foreach ($counts as $count) {
		$c_url = $count->comment_author_url;
		if ($c_url == '') $c_url = 'javascript:;';

		if($addlink == 'on'){
			$c_urllink = ' href="'. $c_url . '"';
		}else{
			$c_urllink = '';
		}
		$type .= '<li><a title="['.$count->comment_author.'] 近期点评'. $count->cnt .'次" target="_blank"'.$c_urllink.'>'.get_avatar( $count->comment_author_email, $size = '48' , deel_avatar_default() ) .'</a></li>';
	}
	echo $type;
}

?>