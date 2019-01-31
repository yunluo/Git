<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
<?php
if (git_get_option('git_singleMenu_b') || get_post_type() !== 'product') echo '<div class="breadcrumbs">' . deel_breadcrumbs() . '</div>';
if(git_get_option('git_suojin')){echo '<style type="text/css">.article-content p {text-indent: 2em;}.article-content p a,.article-content p video,.article-content table p{text-indent: 0 !important;}</style>';}
?>
<?php
if (git_get_option('git_prettify') == 'monokai') {
    echo '<style type="text/css">.prettyprint,pre.prettyprint{background-color:#272822;border:none;overflow:hidden;padding:10px 15px;}.prettyprint.linenums,pre.prettyprint.linenums{-webkit-box-shadow:inset 40px 0 0 #39382E,inset 41px 0 0 #464741;-moz-box-shadow:inset 40px 0 0 #39382E,inset 41px 0 0 #464741;box-shadow:inset 40px 0 0 #39382E,inset 41px 0 0 #464741;}.prettyprint.linenums ol,pre.prettyprint.linenums ol{margin:0 0 0 33px;}.prettyprint.linenums ol li,pre.prettyprint.linenums ol li{padding-left:12px;color:#bebec5;line-height:20px;margin-left:0;list-style:decimal;}.prettyprint .com{color:#93a1a1;}.prettyprint .lit{color:#AE81FF;}.prettyprint .pun,.prettyprint .opn,.prettyprint .clo{color:#F8F8F2;}.prettyprint .fun{color:#dc322f;}.prettyprint .str,.prettyprint .atv{color:#E6DB74;}.prettyprint .kwd,.prettyprint .tag{color:#F92659;}.prettyprint .typ,.prettyprint .atn,.prettyprint .dec,.prettyprint .var{color:#A6E22E;}.prettyprint .pln{color:#66D9EF;}</style>';
} elseif (git_get_option('git_prettify') == 'tomorrow') {
    echo '<style type="text/css">.prettyprint .pln{color:#ccc}.prettyprint .str{color:#9c9}.prettyprint .kwd{color:#c9c}.prettyprint .com{color:#999;font-style:italic}.prettyprint .typ{color:#f99157}.prettyprint .lit{color:#f99157}.prettyprint .pun{color:#ccc}.prettyprint .opn{color:#ccc}.prettyprint .clo{color:#ccc}.prettyprint .tag{color:#f2777a}.prettyprint .atn{color:#f99157}.prettyprint .atv{color:#6cc}.prettyprint .dec{color:#f99157}.prettyprint .var{color:#f2777a}.prettyprint .fun{color:#69c}pre.prettyprint{background-color:#2d2d2d;padding:10px;border:1px solid #e1e1e8}ol.linenums{color:#999;margin:0 0 0 40px}ol.linenums li{line-height:18px;padding-left:12px}.prettyprint.linenums,pre.prettyprint.linenums{box-shadow:inset 40px 0 0 #212121;color:#c5c8c6}</style>';
} elseif (git_get_option('git_prettify') == 'solarized') {
    echo '<style type="text/css">.prettyprint.pln{color:#fff}.prettyprint.str{color:#d1f1a9}.prettyprint.kwd{color:#ebbbff}.prettyprint.com{color:#7285b7;font-style:italic}.prettyprint.typ{color:#bbdaff}.prettyprint.lit{color:#ffc58f}.prettyprint.pun{color:#fff}.prettyprint.opn{color:#fff}.prettyprint.clo{color:#fff}.prettyprint.tag{color:#ff9da4}.prettyprint.atn{color:#ffc58f}.prettyprint.atv{color:#9ff}.prettyprint.dec{color:#ffc58f}.prettyprint.var{color:#ff9da4}.prettyprint.fun{color:#bbdaff}pre.prettyprint{background-color:#002451;padding:10px;border:1px solid #e1e1e8}ol.linenums{color:#7285b7;margin:0 0 0 40px}ol.linenums li{line-height:18px;padding-left:12px}.prettyprint.linenums,pre.prettyprint.linenums{box-shadow:inset 40px 0 0 #001938;color:#809189}</style>';
} elseif (git_get_option('git_prettify') == 'deepblue') {
    echo '<style type="text/css">.prettyprint .pln{color:#bd3613}.prettyprint .str{color:#269186}.prettyprint .kwd{color:#859900}.prettyprint .com{color:#586175;font-style:italic}.prettyprint .typ{color:#b58900}.prettyprint .lit{color:#2aa198}.prettyprint .pun{color:#839496}.prettyprint .opn{color:#839496}.prettyprint .clo{color:#839496}.prettyprint .tag{color:#268bd2}.prettyprint .atn{color:#586175}.prettyprint .atv{color:#2aa198}.prettyprint .dec{color:#268bd2}.prettyprint .var{color:#268bd2}.prettyprint.fun{color:red}pre.prettyprint{background-color:#042029;padding:10px;border:1px solid #e1e1e8}ol.linenums{color:#4c666c;margin:0 0 0 40px}ol.linenums li{line-height:18px;padding-left:12px}.prettyprint.linenums,pre.prettyprint.linenums{box-shadow:inset 40px 0 0 #020e13;color:#809189}</style>';
}
?>
		<?php
while (have_posts()):
    the_post(); ?>
		<header class="article-header">
			<h1 class="article-title"><a href="<?php
    the_permalink() ?>"><?php
    the_title(); ?></a></h1>
			<div class="meta">
				<?php
    $category = get_the_category();
    if ($category[0]) {
        echo '<span id="mute-category" class="muted"><i class="fa fa-list-alt"></i><a href="' . get_category_link($category[0]->term_id) . '"> ' . $category[0]->cat_name . '</a></span>';
    }
?>
				<span class="muted"><i class="fa fa-user"></i> <a href="<?php
    echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php
    echo get_the_author() ?></a></span>

    <?php
    $zhuanzai = get_post_meta($post->ID, 'git_zhuanzai_name', true);
    if ( $zhuanzai ) echo '<span class="muted"><i class="fa fa-info-circle"></i> 来源：<a rel="nofollow" target="_blank" href="' . get_post_meta($post->ID, 'git_zhuanzai_link', true) . '">' .get_post_meta($post->ID, 'git_zhuanzai_name', true) . '</a></span>'; ?>

				<span class="muted"><i class="fa fa-clock-o"></i> <?php
    echo timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))) ?></span>
				<span class="muted"><i class="fa fa-eye"></i> <?php
    deel_views('次浏览'); ?></span>
				<?php
    if (git_get_option('git_baidurecord_b') && function_exists('curl_init')) { ?><span class="muted"><i class="fa fa-flag"></i> <?php
        baidu_record(); ?></span><?php
    } ?>
				<?php
    if (comments_open()) echo '<span class="muted"><i class="fa fa-comments-o"></i> <a href="' . get_comments_link() . '">' . get_comments_number('0', '1', '%') . '个评论</a></span>'; ?>
				<?php
    if (git_get_option('git_qr_b') && !git_is_mobile()) { ?>
		 <span class="muted qrimg"><i class="fa fa-qrcode"></i> <a style="cursor:pointer;">扫描二维码</a>
		 <div><img id="qrious"></div>
		 </span>
		 <style type="text/css">.qrimg{position:relative;}.qrimg div{display:none;width:200px;}.qrimg:hover div{z-index:99999;display:block;position: absolute;left:-50px;top:35px;}</style>
		 <script src="https://cdn.bootcss.com/qrious/4.0.2/qrious.min.js"></script>
		 <script type="text/javascript">
				var qr = new QRious({
					element: document.getElementById("qrious"),
					size : 200,
					value: "<?php the_permalink(); ?>"
				});
		 </script>
		<?php
    } ?>
				<span class="muted"><?php
    edit_post_link('[编辑]'); ?></span>
			</div>
		<?php
		$jiage = get_post_meta($post->ID, 'git_product_jiage', true);
		$fahuodi = get_post_meta($post->ID, 'git_product_fahuodi', true);
		$cpjianjie = get_post_meta($post->ID, 'git_product_cpjianjie', true);
		$tblink = get_post_meta($post->ID, 'git_product_tblink', true);
		if(get_post_type() == 'product' && !defined('WC_PLUGIN_FILE')){
		    echo '<hr /><div class="products" id="products">
			<div class="product-img"><a target="_blank" rel="nofollow" href="' . get_post_meta($post->ID, 'git_product_tblink', true) . '"><img src="' . get_post_meta($post->ID, 'git_thumb', true) . '" width="360px" height="360px" alt="" /></a></div>
			<div class="product-detail">
			    <div class="product-title">
				<h2>'.get_the_title().'</h2>
				<p>产品简介：' . get_post_meta($post->ID, 'git_product_cpjianjie', true) . '</p>
			    </div>
			    <div class="product row">
				<ul>
					<li class="product-price"><span class="dt">商品售价</span><strong><em>¥</em>' . get_post_meta($post->ID, 'git_product_jiage', true) . ' <em>(元)</em></strong></li>
					<li class="product-amount"><span class="dt">商品数量</span><span class="dt-num">999</span></li>
					<li class="product-comments"><span class="dt">商品评论</span><span class="dt-num"><a href="' . get_comments_link() . '">' . get_comments_number('0', '1', '%') . '个评论</a></span></li>
					<li class="product-place"><span class="dt">商品发货地</span><span class="dt-num">' . get_post_meta($post->ID, 'git_product_fahuodi', true) . '</span></li>
					<li class="product-time"><span class="dt">发货时间</span><span class="dt-num">卖家承诺24小时内发货</span></li>
					<li class="product-market"><span class="dt">商品编号</span>' . get_the_id() . '</li>
                </ul>
			    </div>
			    <div class="clearfix"></div>
			    <div class="product-buy pull-center">
                	<a class="lhb" href="' . get_post_meta($post->ID, 'git_product_tblink', true) . '" target="_blank" rel="nofollow" ><i class="fa fa-shopping-cart"></i> 立即购买</a>
                </div></div>';}?>
		</header>
<?php
    if (git_get_option('git_adpost_01') && get_post_type() !== 'product') echo '<div class="banner banner-post">' . git_get_option('git_adpost_01') . '</div>'; ?>
<?php
    if (git_is_mobile()): ?><?php
        if (git_get_option('Mobiled_adpost_01')) echo '<div class="banner-post mobileads">' . git_get_option('Mobiled_adpost_01') . '</div>'; ?><?php
    endif; ?>
		<article class="article-content">
			<?php
    the_content(); ?>
		<?php
    wp_link_pages(array(
        'before' => '<div class="fenye">',
        'after' => '',
        'next_or_number' => 'next',
        'previouspagelink' => '<span>上一页</span>',
        'nextpagelink' => ""
    )); ?>   <?php
    wp_link_pages(array(
        'before' => '',
        'after' => '',
        'next_or_number' => 'number',
        'link_before' => '<span>',
        'link_after' => '</span>'
    )); ?>   <?php
    wp_link_pages(array(
        'before' => '',
        'after' => '</div>',
        'next_or_number' => 'next',
        'previouspagelink' => '',
        'nextpagelink' => "<span>下一页</span>"
    )); ?>
<?php if(!defined('UM_DIR')): ?>
<div class="article-social">
			<a href="javascript:;" data-action="ding" data-id="<?php
    the_ID(); ?>" id="Addlike" class="action<?php
    if (isset($_COOKIE['bigfa_ding_' . $post->ID])) echo ' actived'; ?>"><i class="fa fa-heart-o"></i>喜欢 (<span class="count"><?php
    if (get_post_meta($post->ID, 'bigfa_ding', true)) {
        echo get_post_meta($post->ID, 'bigfa_ding', true);
    } else {
        echo '0';
    } ?></span>)</a><?php
    if (git_get_option('git_bdshare_b')) echo '<span class="or"><style>.article-social .weixin:hover{background:#fff;}</style><a class="weixin" style="border-bottom:0px;font-size:15pt;cursor:pointer;">赏<div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title"><center>[' . git_get_option('git_pay') . ']</center></div><div class="popover-content"><img width="200px" height="200px" src="' . git_get_option('git_pay_qr') . '" ></div></div></div></a></span>';
    deel_share(); ?>
</div>
<?php endif; ?>
	</article>
		<?php
endwhile; ?>
		<footer class="article-footer">
			<?php
the_tags('<div class="article-tags"><i class="fa fa-tags"></i>', '', '</div>'); ?>
</footer>
	<nav class="article-nav">
			<span class="article-nav-prev"><?php
previous_post_link('<i class="fa fa-angle-double-left"></i> %link'); ?></span>
			<span class="article-nav-next"><?php
next_post_link('%link  <i class="fa fa-angle-double-right"></i>'); ?></span>
		</nav>
<?php if (git_get_option('git_auther_b') && defined('UM_DIR')) { ?>
<?php um_author_info_module(); ?>
<?php } ?>
<?php
if (git_get_option('git_auther_b') && !defined('UM_DIR')) { ?>
<div class="ab-author clr">
<div class="img"><?php
    echo get_avatar(get_the_author_meta('email') , '110'); ?></div>
<div class="ab-author-info">
<div class="words">
<div class="wordsname">关于作者：<?php
    the_author_posts_link(); ?></div>
<div class="authorde"><?php
    the_author_meta('description'); ?></div>
<div class="authorsocials">
<span class="socials-icon-wrap"><a class="ab-img ab-home" target="_blank" href="<?php
    the_author_meta('url'); ?>" title="作者主页"><i class="fa fa-home"></i>作者主页</a></span>
<?php
    if (git_get_option('git_pay_qr')) {
        echo '<span class="socials-icon-wrap"><a id="showdiv" class="ab-img ab-donate" target="_blank" href="#donatecoffee"> <i class="fa fa-coffee"></i>赞助作者 </a></span>';
    } ?>
<span class="socials-icon-wrap"><a class="ab-img ab-email" target="_blank" href="mailto:<?php
    echo get_the_author_meta('user_email'); ?>" title="给我写信"><i class="fa fa-envelope"></i></a></span>
<?php
    if (get_the_author_meta('sina_weibo')) {
        echo '<span class="socials-icon-wrap"><a class="ab-img ab-sinawb" target="_blank" href="' . get_the_author_meta('sina_weibo') . '" title="微博"><i class="fa fa-weibo"></i></a></span>';
    } ?>
<?php
    if (get_the_author_meta('twitter')) {
        echo '<span class="socials-icon-wrap"><a class="ab-img ab-twitter" target="_blank" href="' . get_the_author_meta('twitter') . '" title="Twitter"><i class="fa fa-twitter"></i></a></span>';
    } ?>
<?php
    if (get_the_author_meta('github')) {
        echo '<span class="socials-icon-wrap"><a class="ab-img ab-git" target="_blank" href="' . get_the_author_meta('github') . '" title="Git"><i class="fa fa-git"></i></a></span>';
    } ?>
<?php
    if (get_the_author_meta('baidu')) {
        echo '<span class="socials-icon-wrap"><a class="ab-img ab-weixin" target="_blank" href="https://tieba.baidu.com/home/main?un=' . get_the_author_meta('baidu') . '&ie=utf-8" id="ab-weixin-a" title="百度贴吧"><i class="fa fa-paw"></i>
</a></span>';
    } ?>
<?php
    if (get_the_author_meta('qq')) {
        echo '<span class="socials-icon-wrap"><a class="ab-img ab-qq" target="_blank" href="tencent://message/?uin=' . get_the_author_meta('qq') . '&Site=&Menu=yes" title="QQ交谈"><i class="fa fa-qq"></i></a></span>';
    } ?>
            </div>
        </div>
    </div>
</div>
<?php
} ?>
<div id="donatecoffee" style="overflow:auto;display:none;"><img width="400" height="400" alt="支持作者一杯咖啡" src="<?php echo git_get_option('git_pay_qr');?>"></div>

		<div class="related_top">
			<?php
include ('modules/related.php'); ?>
		</div>
		<?php
if (git_is_mobile()): ?>
		<?php
    if (git_get_option('Mobiled_adpost_02')) echo '<div id="comment-ad" class="banner-related mobileads">' . git_get_option('Mobiled_adpost_02') . '</div>'; ?><?php
endif; ?>
		<?php
if (git_get_option('git_adpost_02')) echo '<div id="comment-ad" class="banner banner-related">' . git_get_option('git_adpost_02') . '</div>'; ?>
		<?php
comments_template('', true); ?>
		<?php
if (git_get_option('git_adpost_03')) echo '<div class="banner banner-comment">' . git_get_option('git_adpost_03') . '</div>'; ?>
	</div>
</div>
<?php
get_sidebar();
get_footer(); ?>