<aside class="sidebar">
<div class="widget widget_text"><div class="textwidget"><div class="social">
<?php if( dopt('d_tqq_b') || dopt('d_weibo_b') || dopt('d_facebook_b') || dopt('d_twitter_b') ){ ?>
<?php if( dopt('d_weibo_b') ) echo '<a href="'.dopt('d_weibo').'" rel="external nofollow" title="新浪微博" target="_blank"><i class="sinaweibo fa fa-weibo"></i></a>'; ?>
<?php if( dopt('d_tqq_b') ) echo '<a  href="'.dopt('d_tqq').'" rel="external nofollow" title="腾讯微博" target="_blank"><i class="tencentweibo fa fa-tencent-weibo"></i></a>'; ?>
<?php if( dopt('d_twitter_b') ) echo '<a href="'.dopt('d_twitter').'" rel="external nofollow" title="Twitter" target="_blank"><i class="twitter fa fa-twitter"></i></a>'; ?>
<?php if( dopt('d_facebook_b') ) echo '<a href="'.dopt('d_facebook').'" rel="external nofollow" title="Facebook" target="_blank"><i class="facebook fa fa-facebook"></i></a>'; ?>
<?php if( dopt('d_weixin_b') ) echo '<a class="weixin"><i class="weixins fa fa-weixin"></i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">订阅号“'.dopt('d_weixin').'”</div><div class="popover-content"><img src="'.get_bloginfo('template_url').'/img/weixin.gif" ></div></div></div></a>';?>
<?php if( dopt('d_emailContact_b') ) echo '<a href="'.dopt('d_emailContact').'" rel="external nofollow" title="Email" target="_blank"><i class="email fa fa-envelope-o"></i></a>'; ?>
<?php if( dopt('d_qqContact_b') ) echo '<a href="tencent://message/?uin='.dopt('d_qqContact').'&Site=&Menu=yes " rel="external nofollow" title="联系QQ" target="_blank"><i class="qq fa fa-qq"></i></a>'; ?>
<?php echo'<a href="'.dopt('d_rss').'" rel="external nofollow" target="_blank"  title="订阅本站"><i class="rss fa fa-rss"></i></a>'; ?>

<?php } ?>
</div></div></div>

<?php
if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sitesidebar')) : endif;

if (is_single()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_postsidebar')) : endif;
}
else if (is_page()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_pagesidebar')) : endif;
}
else if (is_home()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sidebar')) : endif;
}
else {
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_othersidebar')) : endif;
}
?>
</aside>