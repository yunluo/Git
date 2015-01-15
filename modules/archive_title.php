<?php if( dopt('d_adindex_02_b') ) printf('<div class="banner banner-sticky">'.dopt('d_adindex_02').'</div>'); ?>
<?php
$_author = dopt('d_post_author_b');
$_time = dopt('d_post_time_b');
$_views = dopt('d_post_views_b');
$_comment = dopt('d_post_comment_b');
?>
<?php while ( have_posts() ) : the_post(); ?>
<?php
$_thumbnail = false;
if( has_post_thumbnail() || !dopt('d_thumbnail_b') ){
	$_thumbnail = true;
}
?><?php
$s = trim(get_search_query()) ? trim(get_search_query()) : 0;
$title = get_the_title();
$content = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 260,"......",'utf-8');//300是摘要字符数，......是结束符号。
if($s){$keys = explode(" ",$s);
$title = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color:#b94a48;">\0</span>',$title);
$content = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color:#b94a48;">\0</span>',$content);
}?>
<article class="excerpt<?php echo !$_thumbnail ? ' excerpt-nothumbnail' : '' ?>">
	<header>
		<?php
			if( !is_category() ) {
				$category = get_the_category();
		        if($category[0]){
		            echo '<a class="label label-important" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'<i class="label-arrow"></i></a>';
		        }
	        };
		?>
		<h2><a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php echo $title; ?></a></h2>
	</header>
<?php if( $_thumbnail ){ ?>
<?php if( dopt('d_qiniuthumbnail_b') ){?><div class="focus"><a target="_blank" href="<?php the_permalink(); ?>"><img class="thumb" src="<?php echo post_thumbnail_src(); ?>?imageView2/1/w/200/h/123/q/85" alt="<?php the_title(); ?>" height="123" width="200" /></a></div><?php } ?>
<?php if( dopt('d_timthumbnail_b') ){?><div class="focus"><a target="_blank" href="<?php the_permalink(); ?>"><img class="thumb" src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=123&w=200&q=90&zc=1&ct=1" alt="<?php the_title(); ?>" height="123" width="200" /></a></div><?php } ?>
<?php } ?>
		<span class="note"> <?php echo $content;?></span>
<p class="auth-span">
<?php if( !is_author() && !$_author ){ ?>
		<span class="muted"><i class="fa fa-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author() ?></a></span>
	<?php } ?>
	<?php if( !$_time ){ ?><span class="muted"><i class="fa fa-clock-o"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></span><?php } ?>
	<?php if( !$_views ){ ?><span class="muted"><i class="fa fa-eye"></i> <?php deel_views('℃'); ?></span><?php } ?>
	<?php if( !$_comment ){ ?><span class="muted"><i class="fa fa-comments-o"></i> <?php
			if ( comments_open() ) echo '<a target="_blank" href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>'
		?></span><?php } ?>
<?php if( !$_like ){ ?><span class="muted">
<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' actived';?>"><i class="fa fa-heart-o"></i><span class="count"><?php if( get_post_meta($post->ID,'bigfa_ding',true) ){ echo get_post_meta($post->ID,'bigfa_ding',true); } else {echo '0';}?></span>喜欢</a></span><?php } ?></p>
</article>
<?php endwhile; wp_reset_query(); ?>
<?php deel_paging(); ?>