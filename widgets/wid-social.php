<?php
add_action( 'widgets_init', 'd_socials' );

function d_socials() {
	register_widget( 'd_social' );
}

class d_social extends WP_Widget {
	function d_social() {
		$widget_ops = array( 'classname' => 'd_social', 'description' => '在这里显示国内常用的社交网站按钮' );
		$this->WP_Widget( 'd_social', 'G-社交按钮', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);

		echo $before_widget;
		echo '<div class="widget widget_text"><div class="textwidget"><div class="social">';
if( dopt('d_weibo_b') ) echo '<a href="'.dopt('d_weibo').'" rel="external nofollow" title="新浪微博" target="_blank"><i class="sinaweibo fa fa-weibo"></i></a>';
if( dopt('d_tqq_b') ) echo '<a  href="'.dopt('d_tqq').'" rel="external nofollow" title="腾讯微博" target="_blank"><i class="tencentweibo fa fa-tencent-weibo"></i></a>';
if( dopt('d_git_b') ) echo '<a href="'.dopt('d_git').'" rel="external nofollow" title="GIT系统" target="_blank"><i class="git fa fa-git"></i></a>';
if( dopt('d_baidu_b') ) echo '<a href="'.dopt('d_baidu').'" rel="external nofollow" title="百度贴吧" target="_blank"><i class="baidu fa fa-paw"></i></a>';
if( dopt('d_weixin_b') ) echo '<a class="weixin"><i class="weixins fa fa-weixin"></i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">订阅号“'.dopt('d_weixin').'”</div><div class="popover-content"><img src="'.dopt('d_weixin_qr').'" ></div></div></div></a>';
if( dopt('d_pay_b') ) echo '<a class="weixin"><i class="pay fa fa-paypal"></i>
</i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">支付宝“'.dopt('d_pay').'”</div><div class="popover-content"><img src="'.dopt('d_pay_qr').'" ></div></div></div></a>';
if( dopt('d_emailContact_b') ) echo '<a href="'.dopt('d_emailContact').'" rel="external nofollow" title="Email" target="_blank"><i class="email fa fa-envelope-o"></i></a>';
if( dopt('d_qqContact_b') ) echo '<a href="tencent://message/?uin='.dopt('d_qqContact').'&Site=&Menu=yes " rel="external nofollow" title="联系QQ" target="_blank"><i class="qq fa fa-qq"></i></a>';
 echo'<a href="'.dopt('d_rss').'" rel="external nofollow" target="_blank"  title="订阅本站"><i class="rss fa fa-rss"></i></a>';
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