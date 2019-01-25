<?php get_header();
	global $wp_query;
		$curauth = $wp_query->get_queried_object();
$posts_count = $wp_query->found_posts;
$comments_count = get_comments( array('status' => '1', 'user_id'=>$curauth->ID, 'count' => true) );
// Current user
$current_user = wp_get_current_user();
// Myself?
$oneself = $current_user->ID == $curauth->ID || current_user_can('edit_users') ? 1 : 0;
// Admin?
$admin = $current_user->ID == $curauth->ID && current_user_can('edit_users') ? 1 : 0;
// 页码start
$paged = max( 1, get_query_var('page') );
$number = get_option('posts_per_page', 10);
$offset = ($paged-1)*$number;
date_default_timezone_set('Asia/Shanghai');
?>
<div class="content-wrap">
    <div class="content">
		<div class="mod-head" style="display: block;">
			<div class="info-left  user-online">
				<div class="portrait"><?php $grava = 'https://cn.gravatar.com/avatar/'.md5( strtolower( trim( $curauth->user_email ) ) ).'?s=120&d=mp&r=g';
				echo '<img src="'.$grava.'">';
				?>
				</div>
			</div>
			<div class="info-right">
				<div class="user-name clearfix">
				<h2 class="yahei"><a style="color:#000;font-weight:bold;" href="<?php echo get_author_posts_url( $curauth->ID );?>"><?php echo $curauth->display_name; ?></a></h2>
				</div>
				<div class="user-info clearfix">
					<div class="info">ID：<?php echo $curauth->ID; ?></div>
					<div class="info">联系邮箱：<?php if ($oneself) {echo $curauth->user_email;}else{echo'您没有查看权限';} ?></div>
				</div>
				<p class="personal-desc">
					<span class="url-desc">个人网站：<?php if($curauth->user_url){echo $curauth->user_url;}else{echo '该用户很懒，还没有填写网站哦。';}?></span>
				</p>
				<?php if ($oneself)
				echo '<a style="color:#555;" target="_blank" href="/wp-admin/profile.php#basic-local-avatar" class="skin-setting-btn log-skin-setting bdown"><i class="fa fa-cogs"></i> 编辑资料</a>'; ?>
			</div>
		</div>
<!-- 标签菜单开始 -->
			<ul class="tabs_author">
                            <li class="active_author"><a href="#tab1_author">主页</a></li>
                            <li><a href="#tab2_author">文章</a></li>
                            <li><a href="#tab3_author">评论</a></li>
							<li><a href="#tab5_author">金币</a></li>
                        </ul>
<!-- 标签菜单结束 -->
<!-- 标签内容开始 -->
                        <div class="tab_container_author">
                            <div id="tab1_author" class="tab_content_author">
                            	<?php
                            	$localavatar = get_user_meta($curauth->ID, 'simple_local_avatar', true);
								$githubid = get_user_meta($curauth->ID, 'github_id', true);
                            	if ($oneself && empty($localavatar)) {echo '<div class="alert alert-error">您尚未上传您的自定义头像，您当前使用的是随机头像，请点击编辑资料以上传头像</div>';}
								if ($oneself && !empty($githubid) && empty($curauth->user_email)) {echo '<div id="sc_error"><strong>重要提示：貌似您是从Github登录的用户，请 <a target="_blank" href="/wp-admin/profile.php#email">点击这里</a> 绑定邮箱，谢谢！！！</strong></div>';}

								?>
							<h2>会员资料</h2>
									<div class="alert alert-info w49">ID：<?php echo $curauth->ID; ?></div>
									<div class="alert alert-success w49">邮箱：<?php if ($oneself) {echo $curauth->user_email;}else{echo'您没有查看权限';} ?></div>
									<div class="alert alert-success w49">网站：<?php if($curauth->user_url){echo $curauth->user_url;}else{echo '该用户很懒，还没有填写网站哦。';}?></div>
									<div class="alert alert-info w49">QQ：<?php if($curauth->qq){echo $curauth->qq;}else{echo '该用户很懒，还没有填写QQ哦。';} ?></div>
									<div class="alert alert-info w49">最近登录：<?php $login = get_user_meta($curauth->ID, 'last_login', true);if ($login != ""){echo $login;} else {echo '暂未登录';}?></div>
									<div class="alert alert-success w49">加入时间：<?php echo $curauth->user_registered; ?></div>
									<div class="clearfix"></div>
									<div class="alert alert-error">简介：<?php if($curauth->description){echo $curauth->description;}else{echo '该用户很懒，还没有填写个人简介。';} ?></div>
							<h2>社交网络</h2>
									<div class="alert alert-success w49">新浪微博 ：<?php if($curauth->sina_weibo){echo $curauth->sina_weibo;}else{echo '该用户很懒，还没有填写新浪微博。';} ?></div>
									<div class="alert alert-info w49">百度ID ：<?php if($curauth->baidu){echo $curauth->baidu;}else{echo '该用户很懒，还没有填写百度ID。';} ?></div>
									<div class="alert alert-info w49">Twitter ：<?php if($curauth->twitter){echo $curauth->twitter;}else{echo '该用户很懒，还没有填写Twitter。';} ?></div>
									<div class="alert alert-success w49">GitHub ：<?php if($curauth->github){echo $curauth->github;}else{echo '该用户很懒，还没有填写GitHub。';} ?></div>
									<div class="clearfix"></div>
                            </div>
                            <div id="tab2_author" class="tab_content_author" style="display:none;">
									<div class="dashboard-wrapper select-posts">
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

$query = new WP_Query( $args );

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
		echo '<div class="alert alert-success pull-center" role="alert">共有 '.$posts_count.' 篇文章，仅显示前20篇文章，更多文章请<a href="/wp-admin/edit.php?author='.$curauth->ID.'" target="_blank">登录进入后台查看</a></div>';
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
		if($pages>1) $comment_html .= '<li class="alert alert-info pull-center">第 '.$paged.' 页，共 '.$pages.' 页，仅显示前 '.$number.' 条，更多评论请<a href="/wp-admin/edit-comments.php?user_id='.$curauth->ID.'" target="_blank">登录进入后台查看</a></li>';
	}
	echo '<ul class="user-comment">'.$comment_html.'</ul>';
}
?>
			</div>
							</div>
                            </div>
							<div id="tab5_author" class="tab_content_author" style="display:none;">
									<div class="alert alert-info" role="alert">当前拥有 <?php
								$jinbis = Points::get_user_total_points($curauth->ID, POINTS_STATUS_ACCEPTED );
								if($jinbis != ""){echo $jinbis;}else{ echo '0';}?> 金币，<?php
								$jinbis = Points::get_user_total_points($curauth->ID, POINTS_STATUS_ACCEPTED );
								if($jinbis <= 0){echo '穷逼一枚';}elseif($jinbis > 0 && $jinbis <= 100){ echo '小有余财';}else{echo '大富豪';}?></div>
								<div class="alert alert-success" role="alert">金币细节</div>
								<?php echo do_shortcode('[points_user_points_details]');?>
                            </div>
                        </div>
<!-- 标签内容结束 -->
<style type="text/css">.tab_content_author table {margin-bottom: 16px;width: 100%;border-top: solid 1px #ddd;border-left: solid 1px #ddd;text-indent: 0;}.tab_content_author table td, .tab_content_author table th {padding: 5px 10px;border-right: solid 1px #ddd;border-bottom: solid 1px #ddd;}.tab_content_author h2{border-bottom:1px solid #e7e9f6;}.w49{width:40%;float:left;margin-right:30px;}.mod-head {padding-top:50px;position:relative;font-weight:bold;color:#000;height:139px;z-index:1;width:100%;margin:0 auto;background: url('<?php echo esc_url( GIT_URL ); ?>/assets/img/authorpic.jpg') no-repeat 0 0;}.mod-head .info-left{width:130px;height:125px;float:left;position:relative;margin-right:24px;margin-left:20px;margin:10px 20px 0 17px}.mod-head .info-left .portrait{text-align:center;width:110px;height:110px;padding:6px 10px 9px;margin-bottom:-30px}.info-left.user-online img{width:110px;height:110px;border:5px solid #fff}.mod-head .info-left .portrait span{width:1px;overflow:hidden}.mod-head .info-right{float:left;width:49%;margin-top:20px}.user-name{line-height:15px}.clearfix{zoom:1}.mod-head .user-name h2{font-size:20px;font-weight:400;float:left;height:33px;line-height:33px;margin-right:7px}.mod-head .user-info{width:780px;overflow:hidden}.mod-head .user-info .info{float:left;margin-right:18px}.mod-head .personal-desc,.mod-head .user-info .info{line-height:23px;height:23px}.mod-head .personal-desc{line-height:23px}.skin-setting-btn{position:absolute;right:0;bottom:0;padding:4px 5px 3px 10px;border:1px solid #e7e9f6;background-color:#f2f2f2;line-height:14px}ul.tabs_author{list-style:none;font-size:1pc}ul.tabs_author,ul.tabs_author li{padding:0;position:relative;float:left}ul.tabs_author li{border:1px solid #e7e9f6;line-height:40px;height:40px;margin:0;background:#fff;overflow:hidden}ul.tabs_author li a{text-decoration:none;padding:0 90px;display:block;outline:0}ul.tabs_author li.active_author{border-left:1px solid #e7e9f6;border-bottom:1px solid #fff;background:#fff;color:#333}ul.tabs_author li.active_author a{font-weight:700;background-color:#2196f3;color:#fff}.tab_container_author{background:#fff;position:relative;margin:0 0 20px;border:1px solid #e7e9f6;border-top-color:#2196f3;float:left;width:100%;top:-1px}.tab_content_author{padding:10px 15px 15px}.tab_content_author ul{padding:0;margin:0 0 0 15px}.tab_content_author li{margin:5px 0}@media screen and (max-width:800px){ul.tabs_author li a{padding:0 25px}.mod-head .info-right{margin-top:10px}.info-left.user-online img{width:90px;height:90px}.w49{width:100%;margin-right:0}}
</style>
</div>
</div>
<?php wp_enqueue_script('author_tabs', GIT_URL . '/assets/js/author_tabs.js', array('jquery')); ?>
<?php get_sidebar(); get_footer();?>