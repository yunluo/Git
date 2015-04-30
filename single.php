<?php
get_header(); ?>
<div class="content-wrap">
	<div class="content">
<?php
if (git_get_option('git_singlecode')) echo git_get_option('git_singlecode'); ?>
<style type="text/css">.article-content h2 {border-left: 8px solid #00A67C;border-bottom: 1px solid #00A67C;}.article-content blockquote:before {display:none !important;}.article-content h3 {border-left: 2px solid #0095ff;background-color:#fbfbfb}input{padding:0px 20px;height : 30px;}</style>
<?php
if (git_get_option('git_singleMenu_b')) echo '<div class="breadcrumbs">' . deel_breadcrumbs() . '</div>'; ?>
<?php
if (git_get_option( 'git_prettify' ) == 'monokai' ) { echo '<style type="text/css">.prettyprint,pre.prettyprint{background-color:#272822;border:none;overflow:hidden;padding:10px 15px;}.prettyprint.linenums,pre.prettyprint.linenums{-webkit-box-shadow:inset 40px 0 0 #39382E,inset 41px 0 0 #464741;-moz-box-shadow:inset 40px 0 0 #39382E,inset 41px 0 0 #464741;box-shadow:inset 40px 0 0 #39382E,inset 41px 0 0 #464741;}.prettyprint.linenums ol,pre.prettyprint.linenums ol{margin:0 0 0 33px;}.prettyprint.linenums ol li,pre.prettyprint.linenums ol li{padding-left:12px;color:#bebec5;line-height:20px;margin-left:0;list-style:decimal;}.prettyprint .com{color:#93a1a1;}.prettyprint .lit{color:#AE81FF;}.prettyprint .pun,.prettyprint .opn,.prettyprint .clo{color:#F8F8F2;}.prettyprint .fun{color:#dc322f;}.prettyprint .str,.prettyprint .atv{color:#E6DB74;}.prettyprint .kwd,.prettyprint .tag{color:#F92659;}.prettyprint .typ,.prettyprint .atn,.prettyprint .dec,.prettyprint .var{color:#A6E22E;}.prettyprint .pln{color:#66D9EF;}</style>';
}elseif(git_get_option( 'git_prettify' ) == 'tomorrow' ) { echo '<style type="text/css">.prettyprint .pln{color:#ccc}.prettyprint .str{color:#9c9}.prettyprint .kwd{color:#c9c}.prettyprint .com{color:#999;font-style:italic}.prettyprint .typ{color:#f99157}.prettyprint .lit{color:#f99157}.prettyprint .pun{color:#ccc}.prettyprint .opn{color:#ccc}.prettyprint .clo{color:#ccc}.prettyprint .tag{color:#f2777a}.prettyprint .atn{color:#f99157}.prettyprint .atv{color:#6cc}.prettyprint .dec{color:#f99157}.prettyprint .var{color:#f2777a}.prettyprint .fun{color:#69c}pre.prettyprint{background-color:#2d2d2d;padding:10px;border:1px solid #e1e1e8}ol.linenums{color:#999;margin:0 0 0 40px}ol.linenums li{line-height:18px;padding-left:12px}.prettyprint.linenums,pre.prettyprint.linenums{box-shadow:inset 40px 0 0 #212121;color:#c5c8c6}</style>';
}elseif(git_get_option( 'git_prettify' ) == 'solarized' ) { echo '<style type="text/css">.prettyprint.pln{color:#fff}.prettyprint.str{color:#d1f1a9}.prettyprint.kwd{color:#ebbbff}.prettyprint.com{color:#7285b7;font-style:italic}.prettyprint.typ{color:#bbdaff}.prettyprint.lit{color:#ffc58f}.prettyprint.pun{color:#fff}.prettyprint.opn{color:#fff}.prettyprint.clo{color:#fff}.prettyprint.tag{color:#ff9da4}.prettyprint.atn{color:#ffc58f}.prettyprint.atv{color:#9ff}.prettyprint.dec{color:#ffc58f}.prettyprint.var{color:#ff9da4}.prettyprint.fun{color:#bbdaff}pre.prettyprint{background-color:#002451;padding:10px;border:1px solid #e1e1e8}ol.linenums{color:#7285b7;margin:0 0 0 40px}ol.linenums li{line-height:18px;padding-left:12px}.prettyprint.linenums,pre.prettyprint.linenums{box-shadow:inset 40px 0 0 #001938;color:#809189}</style>';
}elseif(git_get_option( 'git_prettify' ) == 'deepblue' ) { echo '<style type="text/css">.prettyprint .pln{color:#bd3613}.prettyprint .str{color:#269186}.prettyprint .kwd{color:#859900}.prettyprint .com{color:#586175;font-style:italic}.prettyprint .typ{color:#b58900}.prettyprint .lit{color:#2aa198}.prettyprint .pun{color:#839496}.prettyprint .opn{color:#839496}.prettyprint .clo{color:#839496}.prettyprint .tag{color:#268bd2}.prettyprint .atn{color:#586175}.prettyprint .atv{color:#2aa198}.prettyprint .dec{color:#268bd2}.prettyprint .var{color:#268bd2}.prettyprint.fun{color:red}pre.prettyprint{background-color:#042029;padding:10px;border:1px solid #e1e1e8}ol.linenums{color:#4c666c;margin:0 0 0 40px}ol.linenums li{line-height:18px;padding-left:12px}.prettyprint.linenums,pre.prettyprint.linenums{box-shadow:inset 40px 0 0 #020e13;color:#809189}</style>';}
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
				<time class="muted"><i class="fa fa-clock-o"></i> <?php
    echo timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))) ?></time>
				<span class="muted"><i class="fa fa-eye"></i> <?php
    deel_views('次浏览'); ?></span>
				<?php
    if (git_get_option('git_baidurecord_b')&& function_exists('curl_init')) { ?><span class="muted"><i class="fa fa-flag"></i> <?php
        baidu_record(); ?></span><?php
    } ?>
				<?php
    if (comments_open()) echo '<span class="muted"><i class="fa fa-comments-o"></i> <a href="' . get_comments_link() . '">' . get_comments_number('0', '1', '%') . '个评论</a></span>'; ?>
				<?php
    if (git_get_option('git_qr_b') && !G_is_mobile()) { ?><span class="muted"><i class="fa fa-qrcode"></i> <a style="cursor : pointer;" onMouseOver="document.all.qr.style.visibility=''" onMouseOut="document.all.qr.style.visibility='hidden'">扫描二维码</a>
				<span id="qr" style="visibility: hidden;"><img style="position:absolute;z-index:99999;" src="http://s.jiathis.com/qrcode.php?url=<?php
        the_permalink(); ?>"/></span></span><?php
    } ?>
				<span class="muted"><?php
    edit_post_link('[编辑]'); ?></span>
			</div>
		</header>
<?php
    if (git_get_option('git_adpost_01')) echo '<div class="banner banner-post">' . git_get_option('git_adpost_01') . '</div>'; ?>
<?php
    if (wp_is_mobile()): ?><?php
        if (git_get_option('Mobiled_adpost_01')) echo '<div class="banner-post">' . git_get_option('Mobiled_adpost_01') . '</div>'; ?><?php
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

<div class="article-social">
			<a href="javascript:;" data-action="ding" data-id="<?php
    the_ID(); ?>" id="Addlike" class="action<?php
    if (isset($_COOKIE['bigfa_ding_' . $post->ID])) echo ' actived'; ?>"><i class="fa fa-heart-o"></i>喜欢 (<span class="count"><?php
    if (get_post_meta($post->ID, 'bigfa_ding', true)) {
        echo get_post_meta($post->ID, 'bigfa_ding', true);
    } else {
        echo '0';
    } ?></span>)</a><?php
    if (git_get_option('git_bdshare_b')) echo '<span class="or">or</span>';
    deel_share(); ?>
</div>
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

		<div class="related_top">
			<?php
include ('modules/related.php'); ?>
		</div>
		<?php
if (wp_is_mobile()): ?>
		<?php
    if (git_get_option('Mobiled_adpost_02')) echo '<div id="comment-ad" class="banner-related">' . git_get_option('Mobiled_adpost_02') . '</div>'; ?><?php
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
if (!G_is_mobile()) { ?>
<?php
    get_sidebar(); ?>
<?php
} ?>
<?php
get_footer(); ?>