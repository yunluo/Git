<?php
add_action( 'widgets_init', 'git_postlists' );

function git_postlists() {
	register_widget( 'git_postlist' );
}

class git_postlist extends WP_Widget {
	function git_postlist() {
		$widget_ops = array( 'classname' => 'git_postlist', 'description' => '图文展示（最新文章+热门文章+随机文章）' );
		$this->WP_Widget( 'git_postlist', 'Git-聚合文章', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title        = apply_filters('widget_name', $instance['title']);
		$limit        = $instance['limit'];
		$cat          = $instance['cat'];
		$orderby      = $instance['orderby'];
		$more = $instance['more'];
		$link = $instance['link'];
		$img = $instance['img'];

		$mo='';
		$style='';
		if( $more!='' && $link!='' ) $mo='<a class="btn" target="_blank" href="'.$link.'">'.$more.'</a>';
		if( !$img ) $style = ' class="nopic"';
		echo $before_widget;
		echo $before_title.$mo.$title.$after_title;
		echo '<ul'.$style.'>';
		echo dtheme_posts_list( $orderby,$limit,$cat,$img );
		echo '</ul>';
		echo $after_widget;
	}

	function form( $instance ) {
?>
		<p>
			<label>
				标题：
				<input style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排序：
				<select style="width:100%;" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
					<option value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>>评论数</option>
					<option value="date" <?php selected('date', $instance['orderby']); ?>>发布时间</option>
					<option value="rand" <?php selected('rand', $instance['orderby']); ?>>随机</option>
				</select>
			</label>
		</p>
		<p>
			<label>
				分类限制：
				<a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的">？</a>
				<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
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
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['img'], 'on' ); ?> id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>">显示图片
			</label>
		</p>

	<?php
	}
}


function dtheme_posts_list($orderby,$limit,$cat,$img) {
	$args = array(
		'order'            => DESC,
		'cat'              => $cat,
		'orderby'          => $orderby,
		'showposts'        => $limit,
		'caller_get_posts' => 1
	);
	query_posts($args);
	while (have_posts()) : the_post();
?>
<li>
<a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php if( git_get_option('git_cdnurl_b') ){ if( $img ){echo '<span class="thumbnail">';echo '<img src="';echo post_thumbnail_src();echo '?imageView2/1/w/100/h/64/q/85" alt="'.get_the_title().'" /></span>'; }else{$img = '';}}else{if( $img ){echo '<span class="thumbnail">';echo '<img src="'.get_bloginfo("template_url").'/timthumb.php?src=';echo post_thumbnail_src();echo '&h=64&w=100&q=90&zc=1&ct=1" alt="'.get_the_title().'" /></span>'; }else{$img = '';}}?><span class="text"><?php the_title(); ?></span><span class="muted"><?php the_time('Y-m-d');?></span><span class="muted"><?php comments_number('0', '1评论', '%评论'); ?></span></a>
</li>
<?php

    endwhile; wp_reset_query();
}

?>