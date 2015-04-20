<?php
add_action( 'widgets_init', 'git_socials' );

function git_socials() {
	register_widget( 'git_social' );
}

class git_social extends WP_Widget {
	function git_social() {
		$widget_ops = array( 'classname' => 'git_social', 'description' => '在这里显示国内常用的社交网站按钮' );
		$this->WP_Widget( 'git_social', 'Git-社交按钮', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);

		echo $before_widget;
		echo '<div class="widget widget_text"><div class="textwidget"><div class="social">';
if( git_get_option('git_weibo') ) echo '<a href="'.git_get_option('git_weibo').'" rel="external nofollow" title="新浪微博" target="_blank"><i class="sinaweibo fa fa-weibo"></i></a>';
if( git_get_option('git_tqq') ) echo '<a  href="'.git_get_option('git_tqq').'" rel="external nofollow" title="腾讯微博" target="_blank"><i class="tencentweibo fa fa-tencent-weibo"></i></a>';
if( git_get_option('git_git') ) echo '<a href="'.git_get_option('git_git').'" rel="external nofollow" title="GIT系统" target="_blank"><i class="git fa fa-git"></i></a>';
if( git_get_option('git_baidu') ) echo '<a href="'.git_get_option('git_baidu').'" rel="external nofollow" title="百度贴吧" target="_blank"><i class="baidu fa fa-paw"></i></a>';
if( git_get_option('git_weixin') ) echo '<a class="weixin"><i class="weixins fa fa-weixin"></i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">订阅号“'.git_get_option('git_weixin').'”</div><div class="popover-content"><img src="'.git_get_option('git_weixin_qr').'" ></div></div></div></a>';
if( git_get_option('git_pay') ) echo '<a class="weixin"><i class="pay fa fa-paypal"></i>
</i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">支付宝“'.git_get_option('git_pay').'”</div><div class="popover-content"><img src="'.git_get_option('git_pay_qr').'" ></div></div></div></a>';
if( git_get_option('git_emailContact') ) echo '<a href="'.git_get_option('git_emailContact').'" rel="external nofollow" title="Email" target="_blank"><i class="email fa fa-envelope-o"></i></a>';
if( git_get_option('git_qqContact') ) echo '<a href="tencent://message/?uin='.git_get_option('git_qqContact').'&Site=&Menu=yes " rel="external nofollow" title="联系QQ" target="_blank"><i class="qq fa fa-qq"></i></a>';
 echo'<a href="'.git_get_option('git_rss').'" rel="external nofollow" target="_blank"  title="订阅本站"><i class="rss fa fa-rss"></i></a>';
echo '</div></div></div>';
		echo $after_widget;
	}

	function form($instance) {
?>
		<p>显示一组社交图标，详细设置请至主题后台设置</p>
<?php
	}
}

?>