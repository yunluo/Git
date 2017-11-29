<?php get_header();
	global $wp_query;
		$curauth = $wp_query->get_queried_object();
$posts_count =  $wp_query->found_posts;
$comments_count = get_comments( array('status' => '1', 'user_id'=>$curauth->ID, 'count' => true) );
// Current user
$current_user = wp_get_current_user();
// Myself?
$oneself = $current_user->ID==$curauth->ID || current_user_can('edit_users') ? 1 : 0;
// Admin ?
$admin = $current_user->ID==$curauth->ID&&current_user_can('edit_users') ? 1 : 0;
// 页码start
$paged = max( 1, get_query_var('page') );
$number = get_option('posts_per_page', 10);
$offset = ($paged-1)*$number;
?>
<div class="content-wrap">
    <div class="content">

		<div class="mod-head" style="display: block;">
			<div class="info-left  user-online">
				<div class="portrait">
				<?php echo get_avatar($curauth->ID , '110');?>
				 </div>
			</div>
			<div class="info-right">
				<div class="user-name clearfix">
				<h2 class="yahei"><a style="color:#000;" href="<?php echo get_author_posts_url( $curauth->ID );?>"><?php echo $curauth->display_name; ?></a></h2>  </div>
				<div class="user-info clearfix">
					<div class="info">ID：<?php echo $curauth->ID; ?></div>
					<div class="birthaddr info" title="<?php echo $curauth->user_registered; ?>">注册时间：<?php echo $curauth->user_registered; ?></div>
				</div>
				<p class="personal-url">
					<span class="url-desc">简介：<?php echo $curauth->user_registered; ?></span>
				</p>
				<?php if ($oneself)
				echo '<a style="color:#555;" target="_blank" href="/wp-admin/profile.php" class="skin-setting-btn log-skin-setting bdown"><i class="fa fa-cogs"></i> 编辑资料</a>'; ?>
			</div>
		</div>


			<ul class="tabs_author">
                            <li class="active_author"><a href="#tab1_author">主页</a></li>
                            <li><a href="#tab2_author">文章</a></li>
                            <li><a href="#tab3_author">评论</a></li>
							<li><a href="#tab4_author">论坛</a></li>
							<li><a href="#tab5_author">金币</a></li>
							<li><a href="#tab6_author">消费</a></li>
                        </ul>
<!-- 标签内容开始 -->
                        <div class="tab_container_author">
                            <div id="tab1_author" class="tab_content_author">
									昵称：<?php echo $curauth->display_name; ?><br>
									ID：<?php echo $curauth->ID; ?><br>
									邮箱：<?php echo $curauth->user_email; ?><br>
									网站：<?php echo $curauth->user_url; ?><br>
									QQ：<?php echo $curauth->qq; ?><br>
									加入时间：<?php echo $curauth->user_registered; ?><br>
									昵称：<?php echo $curauth->display_name; ?><br>
									昵称：<?php echo $curauth->display_name; ?><br>
									昵称：<?php echo $curauth->display_name; ?><br>
									昵称：<?php echo $curauth->display_name; ?><br>
									昵称：<?php echo $curauth->display_name; ?><br>
									昵称：<?php echo $curauth->display_name; ?><br>
<div class="alert alert-info" role="alert">蓝色</div>
<div class="alert alert-success" role="alert">绿色</div>
<div class="alert alert-warning" role="alert">黄色</div>
<div class="alert alert-error" role="alert">红色</div>

                            </div>
                            <div id="tab2_author" class="tab_content_author" style="display:none;">
									<div class="dashboard-wrapper select-posts">
									<div class="alert alert-success" role="alert">共有 <?php echo $posts_count;?> 篇文章，仅显示前20篇文章</div>
<?php
// WP_Query arguments
$args = array(
	'post_type'              => array( 'post' ),
	'post_status'            => array( 'publish' ),
	'author'                 => $curauth->ID ,
	'posts_per_page'         => '20',
	'ignore_sticky_posts'    => true,
	'cache_results'          => true,
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		 ?>
<article class="alert">
            <h3><a href="<?php the_permalink(); ?>" title="<?php
        the_title(); ?>">
                <?php the_title(); ?>
            </a></h3>
            <p><?php
		$excerpt = $post->post_excerpt;
		if (empty($excerpt)) {
            echo deel_strimwidth(strip_tags(apply_filters('the_content', strip_shortcodes($post->post_content))) , 0, git_get_option('git_excerpt_length') ? git_get_option('git_excerpt_length') : 100 , '……');
        } else {
            echo deel_strimwidth(strip_tags(apply_filters('the_excerpt', strip_shortcodes($post->post_excerpt))) , 0, git_get_option('git_excerpt_length') ? git_get_option('git_excerpt_length') : 100 , '……');
        } ?></p>
        </article>
<?php
	}
} else {
	echo '暂无文章';
}
wp_reset_postdata();
?>
            </div>
                            </div>
                            <div id="tab3_author" class="tab_content_author" style="display:none;">
								<div class="dashboard-header">
								<p class="alert alert-success">您已发表<span><?php echo $comments_count; ?></span>条评论。</p>
								<div class="dashboard-wrapper select-comment">
<?php if(!$comments_count > 0) { ?>
				<p class="alert alert-error" role="alert">您还没发表过任何的评论。我们期待您的精彩点评。</p>
<?php }else{ ?>
<?php

	$comments_status = $oneself ? '' : 'approve';
	$all = get_comments( array('status' => '', 'user_id'=>$curauth->ID, 'count' => true) );
	$approve = get_comments( array('status' => '1', 'user_id'=>$curauth->ID, 'count' => true) );
	$pages = $oneself ? ceil($all/$number) : ceil($approve/$number);
	$comments = get_comments(array('status' => $comments_status,'order' => 'DESC','number' => $number,'offset' => $offset,'user_id' => $curauth->ID));
	if($comments){
		$comment_html = '<li class="alert alert-info">共有 '.$all.' 条评论，其中 '.$approve.' 条已获准， '.($all-$approve).' 条正等待审核。</li>';
		foreach( $comments as $comment ){
			$comment_html .= ' <li>';
			if($comment->comment_approved!=1) $comment_html .= '<small class="text-danger">这条评论正在等待审核</small>';
			$comment_html .= '<div class="sc_act"><p>'.$comment->comment_content .'</p>';
			$comment_html .= '<a href="'.htmlspecialchars( get_comment_link( $comment->comment_ID) ).'">'.$comment->comment_date.'  发表在  '.get_the_title($comment->comment_post_ID).'</a></div>';
			$comment_html .= '</li>';
		}
		if($pages>1) $comment_html .= '<li class="open-message">第 '.$paged.' 页，共 '.$pages.' 页，仅显示前 '.$number.' 条</li>';
	}
	echo '<ul class="user-comment">'.$comment_html.'</ul>';
}
?>
			</div>
							</div>

                            </div>
							<div id="tab4_author" class="tab_content_author" style="display:none;">
									论坛
                            </div>
							<div id="tab5_author" class="tab_content_author" style="display:none;">
									金币
                            </div>
							<div id="tab6_author" class="tab_content_author" style="display:none;">
									消费
                            </div>
                        </div>
<!-- 标签内容结束 -->
<style type="text/css">

.mod-head {
    background: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/authorpic.jpg') no-repeat 0 0;
}
.mod-head {
    padding-top:50px;
    position: relative;
    color: #000;
    height: 139px;
    z-index: 1;
    width: 100%;
    margin: 0 auto;
}
.mod-head .info-left {
    width: 130px;
    height: 125px;
    float: left;
    position: relative;
    margin-right: 24px;
    margin-left: 20px;
    margin: 10px 20px 0 17px;
}
.mod-head .info-left .portrait {
    text-align: center;
    width: 110px;
    height: 110px;
    padding: 6px 10px 9px;
    margin-bottom: -30px;

}
.mod-head .info-left .portrait .portrait-img,.info-left.user-online img {
    width: 110px;
    height: 110px;
	border: 5px solid #fff;
}

.mod-head .info-left .portrait span {
    width: 1px;
    overflow: hidden;
}
.user-online .picicon {
    background: -webkit-linear-gradient(#7add54,#5abc45);
    background: -moz-linear-gradient(#7add54,#5abc45);
}
.info-left .picicon {
    border-top: 2px solid #fff;
    border-left: 2px solid #fff;
    bottom: 4px;
    right: 5px;
}
.picicon {
    position: absolute;
    border-left: solid 1px #fff;
    border-top: solid 1px #fff;
    bottom: 1px;
    display: block;
    height: 6px;
    right: 1px;
    width: 6px;
    background: -webkit-linear-gradient(#dcdcdc,#acacac);
    background: -moz-linear-gradient(#dcdcdc,#acacac);
}
.mod-head .info-right {
    float: left;
    width: 49%;
	margin-top: 20px;
}
.user-name {
    line-height: 15px;
}
.clearfix {
    zoom: 1;
}
.mod-head .user-name h2 {
    font-size: 20px;
    font-weight: normal;
    float: left;
    height: 33px;
    line-height: 33px;
    margin-right: 7px;
}

.mod-head .user-info {
    width: 780px;
    overflow: hidden;
}
.mod-head .user-info .info {
    float: left;
    line-height: 23px;
    height: 23px;
    margin-right: 18px;
}
.mod-head .user-info .info {
    float: left;
    line-height: 23px;
    height: 23px;
    margin-right: 18px;
}
.mod-head .personal-url {
    height: 23px;
    line-height: 23px;
}
.mod-head .personal-url {
    line-height: 23px;
}
.detail-link {
    display: inline-block;
    margin-left: 20px;
    color: #fff;
}
.skin-setting-btn {
    position: absolute;
    right: 0;
    bottom: 0;
    padding: 4px 5px 3px 10px;
	border: 1px solid #E7E9F6;
	background-color:#F2F2F2;
    line-height: 14px;
}

/* tabbed list */
ul.tabs_author {
    padding: 0;
    position: relative;
    list-style: none;
    font-size: 16px;
    float: left;
    }
ul.tabs_author li {
    border: 1px solid #E7E9F6;
    line-height: 40px; /* = */ height: 40px;
    padding: 0;
	margin: 0;
    position: relative;
    background: #fff;
    overflow: hidden;
    float: left;
    }
ul.tabs_author li a {
    text-decoration: none;
    padding: 0 50px;
    display: block;
    outline: none;
    }

html ul.tabs_author li.active_author {
    border-left: 1px solid #E7E9F6;
    border-bottom: 1px solid #fff;
    background: #fff;
    color: #333;
    }
html body ul.tabs_author li.active_author a { font-weight: bold;background-color: #2196F3;color: #fff;}
.tab_container_author {
    background: #fff;
    position: relative;
    margin: 0 0 20px 0;
	border: 1px solid #E7E9F6;
	border-top-color: #2196F3;
    float: left;
    width: 100%;
    top: -1px;
    }
.tab_content_author {
    padding: 10px 15px 15px 15px;
    }
    .tab_content_author ul {
        padding: 0; margin: 0 0 0 15px;
        }
        .tab_content_author li { margin: 5px 0; }
@media screen and (max-width:800px) {
ul.tabs_author li a {padding: 0 11px;}
.mod-head .info-right {margin-top: 10px;}
.info-left .picicon {bottom: 22px;right: 20px;}
.mod-head .info-left .portrait .portrait-img,.info-left.user-online img {width: 90px;height: 90px;}
}
</style>
</div>
</div>
<?php wp_enqueue_script('author_tabs', get_stylesheet_directory_uri() . '/assets/js/author_tabs.js', array('jquery')); ?>
<?php get_sidebar(); get_footer();?>