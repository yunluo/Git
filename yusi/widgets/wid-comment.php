<?php  
add_action( 'widgets_init', 'd_comments' );

function d_comments() {
	register_widget( 'd_comment' );
}

class d_comment extends WP_Widget {
	function d_comment() {
		$widget_ops = array( 'classname' => 'd_comment', 'description' => '显示网友最新评论（头像+名称+评论）' );
		$this->WP_Widget( 'd_comment', 'Yusi-最新评论', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$limit = $instance['limit'];
		$outer = $instance['outer'];
		$outpost = $instance['outpost'];
		$more = $instance['more'];
		$link = $instance['link'];

		$mo='';
		if( $more!='' && $link!='' ) $mo='<a class="btn" href="'.$link.'">'.$more.'</a>';
		
		echo $before_widget;
		echo $before_title.$mo.$title.$after_title; 
		echo '<ul>';
		echo mod_newcomments( $limit,$outpost,$outer );
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
				排除某用户ID：
				<input class="widefat" id="<?php echo $this->get_field_id('outer'); ?>" name="<?php echo $this->get_field_name('outer'); ?>" type="number" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某文章ID：
				<input class="widefat" id="<?php echo $this->get_field_id('outpost'); ?>" name="<?php echo $this->get_field_name('outpost'); ?>" type="text" value="<?php echo $instance['outpost']; ?>" />
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

function mod_newcomments( $limit,$outpost,$outer ){
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_post_ID!='".$outpost."' AND user_id!='".$outer."' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
	$comments = $wpdb->get_results($sql);
	foreach ( $comments as $comment ) {
		$output .= '<li><a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="'.$comment->post_title.'上的评论">'.str_replace(' src=', ' data-original=', get_avatar( $comment->comment_author_email, $size = '36' , deel_avatar_default())).' <div class="muted"><i>'.strip_tags($comment->comment_author).'</i>'.timeago( $comment->comment_date_gmt ).'说：'.str_replace(' src=', ' data-original=', convert_smilies(strip_tags($comment->com_excerpt))).'</div></a></li>';
	}
	
	echo $output;
};

?>