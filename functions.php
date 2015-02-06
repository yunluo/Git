<?php

add_action( 'after_setup_theme', 'deel_setup' );

include('admin/G.php');
include('widgets/index.php');

function deel_setup(){

	//去除头部冗余代码
	remove_action( 'wp_head',   'feed_links_extra', 3 );
	remove_action( 'wp_head',   'rsd_link' );
	remove_action( 'wp_head',   'wlwmanifest_link' );
	remove_action( 'wp_head',   'index_rel_link' );
	remove_action( 'wp_head',   'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head',   'wp_generator' );
	//
	add_theme_support( 'custom-background' );
	//隐藏admin Bar
	add_filter('show_admin_bar','hide_admin_bar');

	//关键字
	if( dopt('d_keywords_b') ){
	add_action('wp_head','deel_keywords');
	}

	//页面描述 d_description
	if( dopt('d_description_b') ){
	add_action('wp_head','deel_description');
	}
	function left_admin_footer_text($text) {
	$text = '感谢使用<a target="_blank" href=http://googlo.me/ >乐趣公园修改版主题</a>进行创作';
	return $text;
	}
	add_filter('admin_footer_text','left_admin_footer_text');
	//阻止站内PingBack
	if( dopt('d_pingback_b') ){
		add_action('pre_ping','deel_noself_ping');
	}

	// 友情链接扩展
	add_filter ( 'pre_option_link_manager_enabled', '__return_true' );

	//评论回复邮件通知
	add_action('comment_post','comment_mail_notify');

	//自动勾选评论回复邮件通知，不勾选则注释掉
	add_action('comment_form','deel_add_checkbox');

	//评论表情改造，如需更换表情，img/smilies/下替换
	add_filter('smilies_src','deel_smilies_src',1,10);

	//移除自动保存和修订版本
	if( dopt('d_autosave_b') ){
		add_action('wp_print_scripts','deel_disable_autosave' );
		remove_action('pre_post_update','wp_save_post_revision' );
	}

	//去除自带js
	wp_deregister_script( 'l10n' );

	//修改默认发信地址
	add_filter('wp_mail_from', 'deel_res_from_email');
	add_filter('wp_mail_from_name', 'deel_res_from_name');

	//缩略图设置
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(220, 150, true);

	add_editor_style('editor-style.css');

	//定义菜单
	if (function_exists('register_nav_menus')){
		register_nav_menus( array(
			'nav' => __('网站导航'),
			'pagemenu' => __('页面导航')
		));
	}

}

if (function_exists('register_sidebar')){
	register_sidebar(array(
		'name'          => '全站侧栏',
		'id'            => 'widget_sitesidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title"><h2>',
		'after_title'   => '</h2></div>'
	));
	register_sidebar(array(
		'name'          => '首页侧栏',
		'id'            => 'widget_sidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title"><h2>',
		'after_title'   => '</h2></div>'
	));
	register_sidebar(array(
		'name'          => '分类/标签/搜索页侧栏',
		'id'            => 'widget_othersidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title"><h2>',
		'after_title'   => '</h2></div>'
	));
	register_sidebar(array(
		'name'          => '文章页侧栏',
		'id'            => 'widget_postsidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title"><h2>',
		'after_title'   => '</h2></div>'
	));
	register_sidebar(array(
		'name'          => '页面侧栏',
		'id'            => 'widget_pagesidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title"><h2>',
		'after_title'   => '</h2></div>'
	));
}


function deel_breadcrumbs(){
    if( !is_single() ) return false;
    $categorys = get_the_category();
    $category = $categorys[0];

    return '<a title="返回首页" href="'.get_bloginfo('url').'"><i class="fa fa-home"></i></a> <small>></small> '.get_category_parents($category->term_id, true, ' <small>></small> ').'<span class="muted">'.get_the_title().'</span>';
}

// 取消原有jQuery，加载自定义jQuery
function footerScript() {
    if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
 	wp_register_script( 'jquery',''.get_bloginfo('template_directory').'/js/jquery.min.js', false,'1.0');
	wp_enqueue_script( 'jquery' );
        wp_register_script( 'default', get_template_directory_uri() . '/js/jquery.js', false, '1.0', dopt('d_jquerybom_b') ? true : false );
        wp_enqueue_script( 'default' );
	wp_register_style( 'style', get_template_directory_uri() . '/style.css',false,'1.0' );
	wp_enqueue_style( 'style' );
    }
}
add_action( 'wp_enqueue_scripts', 'footerScript' );

if ( ! function_exists( 'deel_paging' ) ) :
function deel_paging() {
    $p = 4;
    if ( is_singular() ) return;
    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ( $max_page == 1 ) return;
    echo '<div class="pagination"><ul>';
    if ( empty( $paged ) ) $paged = 1;
    // echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> ';
    echo '<li class="prev-page">'; previous_posts_link('上一页'); echo '</li>';

    if ( $paged > $p + 1 ) p_link( 1, '<li>第一页</li>' );
    if ( $paged > $p + 2 ) echo "<li><span>&middot;&middot;&middot;</span></li>";
    for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
        if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"active\"><span>{$i}</span></li>" : p_link( $i );
    }
    if ( $paged < $max_page - $p - 1 ) echo "<li><span> ... </span></li>";
    //if ( $paged < $max_page - $p ) p_link( $max_page, '&raquo;' );
    echo '<li class="next-page">'; next_posts_link('下一页'); echo '</li>';
    // echo '<li><span>共 '.$max_page.' 页</span></li>';
    echo '</ul></div>';
}
function p_link( $i, $title = '' ) {
    if ( $title == '' ) $title = "第 {$i} 页";
    echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "'>{$i}</a></li>";
}
endif;

function deel_strimwidth($str ,$start , $width ,$trimmarker ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}

function dopt($e){
		return stripslashes(get_option($e));
	}

if ( ! function_exists( 'deel_views' ) ) :
function deel_record_visitors(){
	if (is_singular())
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID)
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'deel_record_visitors');

function deel_views($after=''){
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  echo $views, $after;
}
endif;
//baidu分享
$dHasShare = false;
function deel_share(){
	if( !dopt('d_bdshare_b') ) return false;
  echo '<span class="action action-share bdsharebuttonbox"><i class="fa fa-share-alt"></i>分享 (<span class="bds_count" data-cmd="count" title="累计分享0次">0</span>)<div class="action-popover"><div class="popover top in"><div class="arrow"></div><div class="popover-content"><a href="#" class="sinaweibo fa fa-weibo" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_qzone fa fa-star" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="tencentweibo fa fa-tencent-weibo" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="qq fa fa-qq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_renren fa fa-renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin fa fa-weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_more fa fa-ellipsis-h" data-cmd="more"></a></div></div></div></span>';
  global $dHasShare;
  $dHasShare = true;
}

function deel_avatar_default(){
  return get_bloginfo('template_directory').'/img/default.png';
}

//评论头像缓存
function deel_avatar($avatar) {
  $tmp = strpos($avatar, 'http');
  $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  $tmp = strpos($g, 'avatar/') + 7;
  $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  $w = get_bloginfo('wpurl');
  $e = ABSPATH .'avatar/'. $f .'.png';
  $t = dopt('d_avatarDate')*24*60*60;
  if ( !is_file($e) || (time() - filemtime($e)) > $t )
	copy(htmlspecialchars_decode($g), $e);
  else
	$avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
  if ( filesize($e) < 500 )
	copy(get_bloginfo('template_directory').'/img/default.png', $e);
  return $avatar;
}if( dopt('d_avatar_b') ){
add_filter('get_avatar','deel_avatar');
}
//头像SSL链接
function get_ssl_avatar($avatar) {
  $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
    return $avatar;
  }if( dopt('d_avatar_ssl') ){
add_filter('get_avatar', 'get_ssl_avatar');
}
//七牛头像镜像(奶子提供)
function v7v3_get_avatar($avatar) {
 $avatar = str_replace(array("www.gravatar.com","secure.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),
"cd.v7v3.com",$avatar);
 return $avatar;
}if( dopt('d_avatar_qn') ){
add_filter( 'get_avatar', 'v7v3_get_avatar', 10, 3 );
}
//多说头像镜像
function duoshuo_avatar($avatar) {
 $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
 return $avatar;
}if( dopt('d_avatar_ds') ){
 add_filter( 'get_avatar', 'duoshuo_avatar', 10, 3 );
 }
//关键字
function deel_keywords() {
  global $s, $post;
  $keywords = '';
  if ( is_single() ) {
	if ( get_the_tags( $post->ID ) ) {
	  foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
	}
	foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
	$keywords = substr_replace( $keywords , '' , -2);
  } elseif ( is_home () )    { $keywords = dopt('d_keywords');
  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
  } elseif ( is_category() ) { $keywords = single_cat_title('', false);
  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
	echo "<meta name=\"keywords\" content=\"$keywords\">\n";
  }
}

//网站描述
function deel_description() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
	if( !empty( $post->post_excerpt ) ) {
	  $text = $post->post_excerpt;
	} else {
	  $text = $post->post_content;
	}
	$description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
	if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = dopt('d_description'); // 首頁要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { $description = trim(strip_tags(category_description()));
  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' );
  echo "<meta name=\"description\" content=\"$description\">\n";
}

function hide_admin_bar($flag) {
	return false;
}

//最新发布加new 单位'小时'
function deel_post_new($timer='48'){
  $t=( strtotime( date("Y-m-d H:i:s") )-strtotime( $post->post_date ) )/3600;
  if( $t < $timer ) echo "<i>new</i>";
}

//修改评论表情调用路径
function deel_smilies_src ($img_src, $img, $siteurl){
	return get_bloginfo('template_directory').'/img/smilies/'.$img;
}

//阻止站内文章Pingback
function deel_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}

//移除自动保存
function deel_disable_autosave() {
  wp_deregister_script('autosave');
}

//修改默认发信地址
function deel_res_from_email($email) {
	$wp_from_email = get_option('admin_email');
	return $wp_from_email;
}
function deel_res_from_name($email){
	$wp_from_name = get_option('blogname');
	return $wp_from_name;
}
//评论回应邮件通知
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
	$wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
	$wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
	$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
	$to = trim(get_comment($parent_id)->comment_author_email);
	$subject = 'Hi，您在 [' . get_option("blogname") . '] 的留言有人回复啦！';
	$message = '
	<div style="color:#333;font:100 14px/24px microsoft yahei;">
	  <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
	  <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
	   . trim(get_comment($parent_id)->comment_content) . '</p>
	  <p>' . trim($comment->comment_author) . ' 给您的回应:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
	   . trim($comment->comment_content) . '<br /></p>
	  <p>点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整內容</a></p>
	  <p>欢迎再次光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	  <p style="color:#999">(此邮件由系统自动发出，请勿回复.)</p>
	</div>';
	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
	//echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}

//自动勾选
function deel_add_checkbox() {
  echo '<label for="comment_mail_notify" class="checkbox inline" style="padding-top:0"><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked"/>有人回复时邮件通知我</label>';
}


//时间显示方式‘xx以前’
function time_ago( $type = 'commennt', $day = 7 ) {
  $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
  if (time() - $d('U') > 60*60*24*$day) return;
  echo ' (', human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前)';
}

function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

//评论样式
function deel_comment_list($comment, $args, $depth) {
  echo '<li '; comment_class(); echo ' id="comment-'.get_comment_ID().'">';

  //头像
  echo '<div class="c-avatar">';
  echo str_replace(' src=', ' data-original=', get_avatar( $comment->comment_author_email, $size = '54' , deel_avatar_default()));

  //内容
  echo '<div class="c-main" id="div-comment-'.get_comment_ID().'">';
	echo str_replace(' src=', ' data-original=', convert_smilies(get_comment_text()));

	if ($comment->comment_approved == '0'){
	  echo '<span class="c-approved">您的评论正在排队审核中，请稍后！</span><br />';
	}
	//信息
	echo '<div class="c-meta">';
		echo '<span class="c-author">'.get_comment_author_link().'</span>';
		if ($comment->user_id == '1')
		echo '<img src="'.get_bloginfo('template_directory').'/img/webmaster.png" id="comment_is_admin" title="博主大人">&nbsp;&nbsp;';
		echo get_comment_time('Y-m-d H:i '); echo time_ago();
		if ($comment->comment_approved !== '0'){
			echo comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
		echo edit_comment_link(__('(编辑)'),' - ','');
	  }
	echo '</div>';

  echo '</div></div>';
}

//欲思@添加钮Download
function DownloadUrl($atts, $content = null) {
	extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a class="dl" href="'.$href.'" target="_blank" rel="nofollow"><i class="fa fa-cloud-download"></i>'.$content.'</a>';
	}
add_shortcode("dl", "DownloadUrl");
//欲思@添加钮git
function GithubUrl($atts, $content=null) {
   extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a class="dl" href="'.$href.'" target="_blank" rel="nofollow"><i class="fa fa-github-alt"></i>'.$content.'</a>';
}
add_shortcode('gt' , 'GithubUrl' );
//欲思@添加钮Demo
function DemoUrl($atts, $content=null) {
   extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a class="dl" href="'.$href.'" target="_blank" rel="nofollow"><i class="fa fa-external-link"></i>'.$content.'</a>';
}
add_shortcode('dm' , 'DemoUrl' );

//欲思@添加编辑器快捷按钮
add_action('admin_print_scripts', 'my_quicktags');
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/js/my_quicktags.js',
        array('quicktags')
    );
    };

//评论过滤
function refused_spam_comments( $comment_data ) {
$pattern = '/[一-龥]/u';
$jpattern ='/[ぁ-ん]+|[ァ-ヴ]+/u';
if(!preg_match($pattern,$comment_data['comment_content'])) {
err('写点汉字吧，博主外语很捉急！You should type some Chinese word!');
}
if(preg_match($jpattern, $comment_data['comment_content'])){
err('日文滚粗！Japanese Get out！日本語出て行け！ You should type some Chinese word！');
}
return( $comment_data );
}
if( dopt('d_spamComments_b') ){
add_filter('preprocess_comment','refused_spam_comments');
}


//点赞
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
    $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
        update_post_meta($id, 'bigfa_ding', 1);
    }
    else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }

    echo get_post_meta($id,'bigfa_ding',true);

    }

    die;
}
//最热排行
function hot_posts_list($days=7, $nums=10) {
    global $wpdb;
    $today = date("Y-m-d H:i:s");
    $daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) );
	$result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' ORDER BY comment_count DESC LIMIT 0 , $nums");
    $output = '';
    if(empty($result)) {
        $output = '<li>暂无数据</li>';
    } else {
        $i = 1;
        foreach ($result as $topten) {
            $postid = $topten->ID;
            $title = $topten->post_title;
            $commentcount = $topten->comment_count;
            if ($commentcount != 0) {
              $output .= '<li><p><span class="post-comments">评论 ('.$commentcount.')</span><span class="muted"><a href="javascript:;" data-action="ding" data-id="'.$postid.'" id="Addlike" class="action';
	if(isset($_COOKIE['bigfa_ding_'.$postid])) $output .=' actived';
	$output .='"><i class="fa fa-heart-o"></i><span class="count">';
	if( get_post_meta($postid,'bigfa_ding',true) ){
		$output .=get_post_meta($postid,'bigfa_ding',true);
 	} else {$output .='0';}
	$output .='</span>赞</a></span></p><span class="label label-'.$i.'">'.$i.'</span><a href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a></li>';
                $i++;
            }
        }
    }
    echo $output;
}
//在 WordPress 编辑器添加“下一页”按钮
add_filter('mce_buttons','add_next_page_button');
function add_next_page_button($mce_buttons) {
	$pos = array_search('wp_more',$mce_buttons,true);
	if ($pos !== false) {
		$tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
		$tmp_buttons[] = 'wp_page';
		$mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
	}
	return $mce_buttons;
}

//判断手机广告
function G_is_mobile() {
    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        return false;
    } elseif ( ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false  && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') === false) // many mobile devices (all iPh, etc.)
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
            return true;
    } else {
        return false;
    }
}

//欲思@搜索结果排除所有页面
function search_filter_page($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','search_filter_page');
// 更改后台字体
function Bing_admin_lettering(){
    echo'<style type="text/css">
        * { font-family: "Microsoft YaHei" !important; }
        i, .ab-icon, .mce-close, i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page, .qt-fullscreen, .star-rating .star { font-family: dashicons !important; }
        .mce-ico { font-family: tinymce, Arial !important; }
        .fa { font-family: FontAwesome !important; }
        .genericon { font-family: "Genericons" !important; }
        .appearance_page_scte-theme-editor #wpbody *, .ace_editor * { font-family: Monaco, Menlo, "Ubuntu Mono", Consolas, source-code-pro, monospace !important; }
        </style>';
}
add_action('admin_head', 'Bing_admin_lettering');
//欲思@添加相关文章图片文章
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');

//输出缩略图地址
function post_thumbnail_src(){
    global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0];   //获取该图片 src
		if(empty($post_thumbnail_src)){	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 10);
			echo get_bloginfo('template_url');
			echo '/img/pic/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//echo '/img/thumbnail.png';
		}
	};
	echo $post_thumbnail_src;
}

// 背景图设置
add_theme_support ( 'custom-background', array (
		'default-image' => '%s/img/bg.png'
) );

//禁用谷歌字体
function coolwp_remove_open_sans_from_wp_core() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
if( dopt('d_fuckziti_b') ){
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );
}

//免插件去除Category
if( dopt('d_category_b') ){
add_action( 'load-themes.php',  'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
}
function no_category_base_refresh_rules() {
	global $wp_rewrite;
	$wp_rewrite -> flush_rules();
}

// Remove category base
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
	global $wp_rewrite, $wp_version;
	if (version_compare($wp_version, '3.4', '<')) { 	} else {           $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
	}
}
// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
	//var_dump($category_rewrite); // For Debugging
	$category_rewrite = array();
	$categories = get_categories(array('hide_empty' => false));
	foreach ($categories as $category) {
		$category_nicename = $category -> slug;
		if ($category -> parent == $category -> cat_ID)// recursive recursion
			$category -> parent = 0;
		elseif ($category -> parent != 0)
			$category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
		$category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
	}
	// Redirect support from Old Category Base
	global $wp_rewrite;
	$old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
	$old_category_base = trim($old_category_base, '/');
	$category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';

	//var_dump($category_rewrite); // For Debugging
	return $category_rewrite;
}

// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
	$public_query_vars[] = 'category_redirect';
	return $public_query_vars;
}

// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
	//print_r($query_vars); // For Debugging
	if (isset($query_vars['category_redirect'])) {
		$catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
		status_header(301);
		header("Location: $catlink");
		exit();
	}
	return $query_vars;
}

//添加文章版权信息
function copyright($content) {
if(is_single()||is_feed()) {
$content.='<hr /><div class="open-message"  style="border:#00a67c 1px solid;border-radius:5px 5px 5px 5px;">&nbsp;&nbsp;<i class="fa fa-bullhorn"></i>乐趣公园，版权所有丨如未注明，均为原创丨本网站采用<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" rel="nofollow" target="_blank" title="BY-NC-SA授权协议">BY-NC-SA</a>协议进行授权，转载请注明转自：<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_permalink().'</a></div>';
}
return $content;
}
add_filter ('the_content', 'copyright');

//fancybox图片灯箱效果
function fancybox ($content)
{ global $post;
$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>(.*?)<\/a>/i";
$replacement = '<a$1href=$2$3.$4$5 rel="box" class="fancybox"$6>$7</a>';
$content = preg_replace($pattern, $replacement, $content);
return $content;
}
if( dopt('d_fancybox_b') ){
add_filter('the_content', 'fancybox');
}

//WordPress文字标签关键词自动内链
$match_num_from = 1;		//一篇文章中同一個標籤少於幾次不自動鏈接
$match_num_to = 6;		//一篇文章中同一個標籤最多自動鏈接幾次
function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}
function tag_link($content){
	global $match_num_from,$match_num_to;
		$posttags = get_the_tags();
		if ($posttags) {
			usort($posttags, "tag_sort");
			foreach($posttags as $tag) {
				$link = get_tag_link($tag->term_id);
				$keyword = $tag->name;
				$cleankeyword = stripslashes($keyword);
				$url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('查看更多关于 %s 的文章'))."\"";
				$url .= ' target="_blank"';
				$url .= ">".addcslashes($cleankeyword, '$')."</a>";
				$limit = rand($match_num_from,$match_num_to);
				$content = preg_replace( '|(<a[^>]+>)(.*)<pre.*?>('.$ex_word.')(.*)<\/pre>(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
				$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
				$cleankeyword = preg_quote($cleankeyword,'\'');
				$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
				$content = preg_replace($regEx,$url,$content,$limit);
				$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
			}
		}
	return $content;
}
if( dopt('d_autolink_b') ){
add_filter('the_content','tag_link',1);
}

//输出WordPress表情
function fa_get_wpsmiliestrans(){
    global $wpsmiliestrans;
    $wpsmilies = array_unique($wpsmiliestrans);
    foreach($wpsmilies as $alt => $src_path){
        $output .= '<a class="add-smily" data-smilies="'.$alt.'"><img class="wp-smiley" src="'.get_bloginfo('template_directory').'/img/smilies/'.rtrim($src_path, "gif").'gif" /></a>';
    }
    return $output;
}

add_action('media_buttons_context', 'fa_smilies_custom_button');
function fa_smilies_custom_button($context) {
    $context .= '<style>.smilies-wrap{background:#fff;border: 1px solid #ccc;box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.24);padding: 10px;position: absolute;top: 60px;width: 375px;display:none}.smilies-wrap img{height:24px;width:24px;cursor:pointer;margin-bottom:5px} .is-active.smilies-wrap{display:block}</style><a id="insert-media-button" style="position:relative" class="button insert-smilies add_smilies" title="添加表情" data-editor="content" href="javascript:;">添加表情</a><div class="smilies-wrap">'. fa_get_wpsmiliestrans() .'</div><script>jQuery(document).ready(function(){jQuery(document).on("click", ".insert-smilies",function() { if(jQuery(".smilies-wrap").hasClass("is-active")){jQuery(".smilies-wrap").removeClass("is-active");}else{jQuery(".smilies-wrap").addClass("is-active");}});jQuery(document).on("click", ".add-smily",function() { send_to_editor(" " + jQuery(this).data("smilies") + " ");jQuery(".smilies-wrap").removeClass("is-active");return false;});});</script>';
    return $context;
}

//使用短代码添加回复后可见内容开始
function reply_to_read($atts, $content=null){
	extract(shortcode_atts(array("notice" => '<blockquote><p class="reply-to-read" style="color: blue;">注意：本段内容须成功“<a href="'. get_permalink().'#respond" title="回复本文">回复本文</a>”后“<a href="javascript:window.location.reload();" title="刷新本页">刷新本页</a>”方可查看！</p></blockquote>'), $atts));
	if(is_super_admin()){
		return $content;	//如果用户是管理员则直接显示内容
	}
	$email = null;
	$user_ID = (int)wp_get_current_user()->ID;
	if($user_ID > 0){
		$email = get_userdata($user_ID)->user_email;	//如果用户已经登入则从用户信息中取得邮箱
	}else if(isset($_COOKIE['comment_author_email_'.COOKIEHASH])){
		$email = str_replace('%40', '@', $_COOKIE['comment_author_email_'.COOKIEHASH]);		//如果用户尚未登入但COOKIE内储存有邮箱信息
	}else{
		return $notice;		//如无法获取邮箱则返回提示信息
	}
	if(empty($email)){
		return $notice;		//如邮箱为空则返回提示信息
	}
	global $wpdb;
	$post_id = get_the_ID();	//获取文章的ID
	$query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
	if($wpdb->get_results($query)){
		return $content;		//查询到对应的评论即正常显示内容
	}else{
		return $notice;			//否则返回提示信息
	}
}
add_shortcode('reply', 'reply_to_read');

//编辑器添加框架按钮
function GenerateIframe( $atts ) {
    extract( shortcode_atts( array(
        'href' => '',
        'height' => '400px',
        'width' => '810px',
    ), $atts ) );

    return '<iframe src="'.$href.'" width="'.$width.'" height="'.$height.'"> <p>您的浏览器不支持框架</p></iframe>';
}
add_shortcode('iframe', 'GenerateIframe');
//后台图标LOGO链接
function custom_loginlogo_url($url) {
return '<?php site_url(); ?>';
}


/*
 * 强制阻止WordPress代码转义，关于代码高亮可以看这里http://googlo.me/2986.html
 */
function dangopress_esc_html($content)
{
    $regex = '/(<pre\s+[^>]*?class\s*?=\s*?[",\'].*?prettyprint.*?[",\'].*?>)(.*?)(<\/pre>)/sim';
    return preg_replace_callback($regex, dangopress_esc_callback, $content);
}

function dangopress_esc_callback($matches)
{
    $tag_open = $matches[1];
    $content = $matches[2];
    $tag_close = $matches[3];

    //$content = htmlspecialchars($content, ENT_NOQUOTES, get_bloginfo('charset'));
    $content = esc_html($content);

    return $tag_open . $content . $tag_close;
}
add_filter('the_content', 'dangopress_esc_html', 2);
add_filter('comment_text', 'dangopress_esc_html', 2);

//首页隐藏一些分类
function exclude_category_home( $query ) {
	if ( $query->is_home ) {
		$query->set( 'cat', '-'.get_option('d_blockcat_1').',-'.get_option('d_blockcat_2').'' );//隐藏10和20这两个分类
		}
	return $query;
		}
		if( dopt('d_blockcat_b') ){
add_filter( 'pre_get_posts', 'exclude_category_home' );
}

//后台日志阅读统计
add_filter('manage_posts_columns', 'postviews_admin_add_column');
function postviews_admin_add_column($columns){
$columns['views'] = __('阅读');
return $columns;
}
add_action('manage_posts_custom_column','postviews_admin_show',10,2);
function postviews_admin_show($column_name,$id){
if ($column_name != 'views')
return;
$post_views = get_post_meta($id, "views",true);
echo $post_views;
}
/*短代码信息框 开始*/
/*绿色提醒框*/
function toz($atts, $content=null){
    return '<div id="sc_notice">'.$content.'</div>';
}
add_shortcode('v_notice','toz');
/*红色提醒框*/
function toa($atts, $content=null){
    return '<div id="sc_error">'.$content.'</div>';
}
add_shortcode('v_error','toa');
/*黄色提醒框*/
function toc($atts, $content=null){
    return '<div id="sc_warn">'.$content.'</div>';
}
add_shortcode('v_warn','toc');
/*灰色提醒框*/
function tob($atts, $content=null){
    return '<div id="sc_tips">'.$content.'</div>';
}
add_shortcode('v_tips','tob');
/*蓝色提醒框*/
function tod($atts, $content=null){
    return '<div id="sc_blue">'.$content.'</div>';
}
add_shortcode('v_blue','tod');
/*蓝边文本框*/
function toe($atts, $content=null){
    return '<div  class="sc_act">'.$content.'</div>';
}
add_shortcode('v_act','toe');
/*橙色文本框*/
function tof($atts, $content=null){
    return '<div id="sc_organge">'.$content.'</div>';
}
add_shortcode('v_organge','tof');
/*青色文本框*/
function tog($atts, $content=null){
    return '<div id="sc_qing">'.$content.'</div>';
}
add_shortcode('v_qing','tog');
/*粉色文本框*/
function toh($atts, $content=null){
    return '<div id="sc_pink">'.$content.'</div>';
}
add_shortcode('v_pink','toh');
/*绿色按钮*/
function toi($atts, $content=null) {
   extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a class="greenbtn" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';
}
add_shortcode('gb' , 'toi' );
/*蓝色按钮*/
function toj($atts, $content=null) {
   extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a class="bluebtn" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';
}
add_shortcode('bb' , 'toj' );
/*黄色按钮*/
function tok($atts, $content=null) {
   extract(shortcode_atts(array("href" => 'http://'), $atts));
	return '<a class="yellowbtn" href="'.$href.'" target="_blank" rel="nofollow">'.$content.'</a>';
}
add_shortcode('yb' , 'tok' );
/*添加音乐按钮*/
function tol($atts, $content=null){
    return '<audio style="width:100%;max-height:40px;" src="'.$content.'" controls preload loop>您的浏览器不支持HTML5的 audio 标签，无法为您播放！</audio>';
}
add_shortcode('music','tol');
/* 短代码信息框 完毕*/
//为WordPress添加展开收缩功能
function xcollapse($atts, $content = null){
	extract(shortcode_atts(array("title"=>""),$atts));
	return '<div style="margin: 0.5em 0;">
		<div class="xControl">
			<span class="xTitle">'.$title.'</span>
			<a href="javascript:void(0)" class="collapseButton xButton">展开/收缩▼</a>
			<div style="clear: both;"></div>
		</div>
		<div class="xContent" style="display: none;">'.$content.'</div>
	</div>';
}
add_shortcode('collapse', 'xcollapse');

//自动为文章内链接生成超链接
add_filter('the_content', 'make_clickable');

// add youku using iframe
function wp_iframe_handler_youku( $matches, $attr, $url, $rawattr ) {
    // If the user supplied a fixed width AND height, use it
    if ( !empty($rawattr['width']) && !empty($rawattr['height']) ) {
        $width  = (int) $rawattr['width'];
        $height = (int) $rawattr['height'];
    } else {
        list( $width, $height ) = wp_expand_dimensions( 480, 400, $attr['width'], $attr['height'] );
    }
    $iframe = '<iframe width='. esc_attr($width) .' height='. esc_attr($height) .' src="http://player.youku.com/embed/'. esc_attr($matches[1]) .'" frameborder=0 allowfullscreen></iframe>';
    return apply_filters( 'iframe_youku', $iframe, $matches, $attr, $url, $ramattr );
}
wp_embed_register_handler( 'youku_iframe', '#http://v.youku.com/v_show/id_(.*?).html#i', 'wp_iframe_handler_youku' );
// add tudou using iframe
function wp_iframe_handler_tudou( $matches, $attr, $url, $rawattr ) {
    // If the user supplied a fixed width AND height, use it
    if ( !empty($rawattr['width']) && !empty($rawattr['height']) ) {
        $width  = (int) $rawattr['width'];
        $height = (int) $rawattr['height'];
    } else {
        list( $width, $height ) = wp_expand_dimensions( 480, 400, $attr['width'], $attr['height'] );
    }
    $iframe = '<iframe width='. esc_attr($width) .' height='. esc_attr($height) .' src="http://www.tudou.com/programs/view/html5embed.action?code='. esc_attr($matches[1]) .'" frameborder=0 allowfullscreen></iframe>';
    return apply_filters( 'iframe_tudou', $iframe, $matches, $attr, $url, $ramattr );
}
wp_embed_register_handler( 'tudou_iframe', '#http://www.tudou.com/programs/view/(.*?)/#i', 'wp_iframe_handler_tudou' );
wp_embed_unregister_handler('youku');
wp_embed_unregister_handler('tudou');

//后台快捷键回复
add_action('admin_footer', 'hui_admin_comment_ctrlenter');
function hui_admin_comment_ctrlenter(){
    echo '<script type="text/javascript">
        jQuery(document).ready(function($){
            $("textarea").keypress(function(e){
                if(e.ctrlKey&&e.which==13||e.which==10){
                    $("#replybtn").click();
                }
            });
        });
    </script>';
};

//评论链接重写
function add_redirect_comment_link($text = ''){
    $text=str_replace('href="', 'href="'.get_option('home').'/?r=', $text);
    $text=str_replace("href='", "href='".get_option('home')."/?r=", $text);
    return $text;
}
function redirect_comment_link(){
    $redirect = $_GET['r'];
    if($redirect){
        if(strpos($_SERVER['HTTP_REFERER'],get_option('home')) !== false){
            header("Location: $redirect");
            exit;
        }
        else {
            header("Location: ".bloginfo('url')."/");
            exit;
        }
    }
}
add_action('init', 'redirect_comment_link');
add_filter('get_comment_author_link', 'add_redirect_comment_link', 5);
add_filter('comment_text', 'add_redirect_comment_link', 99);

//获取所有站点分类id
function Bing_show_category() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { //调用菜单
		$output = '<span>'.$category->name."=(<em>".$category->term_id.'</em>)</span>&nbsp;&nbsp;';
		echo $output;
	}
}

//新文章同步到新浪微博
function post_to_sina_weibo($post_ID) {

   /* 此处修改为通过文章自定义栏目来判断是否同步 */
   if(get_post_meta($post_ID,'weibo_sync',true) == 1) return;

   $get_post_info = get_post($post_ID);
   $get_post_centent = get_post($post_ID)->post_content;
   $get_post_title = get_post($post_ID)->post_title;
   if ($get_post_info->post_status == 'publish' && $_POST['original_post_status'] != 'publish') {
       $appkey=''.get_option('d_wbapky_b').''; /* 此处是你的新浪微博appkey */
       $username=''.get_option('d_wbuser_b').'';
       $userpassword=''.get_option('d_wbpasd_b').'';
       $request = new WP_Http;
       $keywords = "";

       /* 获取文章标签关键词 */
       $tags = wp_get_post_tags($post_ID);
       foreach ($tags as $tag ) {
          $keywords = $keywords.'#'.$tag->name."#";
       }

       /* 修改了下风格，并添加文章关键词作为微博话题，提高与其他相关微博的关联率 */
       $status = '【' . strip_tags( $get_post_title ).'】:'.mb_strimwidth(strip_tags( apply_filters('the_content', $get_post_centent)),0, 180,'...') .$keywords. ' 查看全文:' . get_permalink($post_ID) ;

       /* 获取特色图片，如果没设置就抓取文章第一张图片 */
       if (has_post_thumbnail()) {
          $url = get_post_thumbnail_url($post->ID);

       /* 抓取第一张图片作为特色图片，需要主题函数支持 */
       } else if(function_exists('catch_first_image')) {
          $url = catch_first_image();
       }
       /* 判断是否存在图片，定义不同的接口 */
       if(!empty($url)){
           $api_url = 'https://api.weibo.com/2/statuses/upload_url_text.json'; /* 新的API接口地址 */
           $body = array('status' => $status,'source' => $appkey,'url' => $url);
       } else {
           $api_url = 'https://api.weibo.com/2/statuses/update.json';
           $body = array('status' => $status,'source' => $appkey);
       }
       $headers = array('Authorization' => 'Basic ' . base64_encode("$username:$userpassword"));
       $result = $request->post($api_url, array('body' => $body,'headers' => $headers));

       /* 若同步成功，则给新增自定义栏目weibo_sync，避免以后更新文章重复同步 */
       add_post_meta($post_ID, 'weibo_sync', 1, true);
    }
}
if( dopt('d_sinasync_b') ){
add_action('publish_post', 'post_to_sina_weibo', 0);
}

//自动下载外部图片开始
function save_post_fix($content){
   global $wpdb;
    $post_id = get_the_ID();
    $upload_dir = wp_upload_dir();
    $path = $upload_dir["url"];
    $realPath = $upload_dir["path"];
    $pathbase = $upload_dir["baseurl"].'/';

   if(!is_dir($realPath)){
    mkdirs($realPath);
    }

    $pagelink=array();
    $pattern_page = '/<img([\s\S]*?)src=\\\\[\"|\'](.*?)\\\\[\"|\']([\s\S]*?)>/i';
    preg_match_all($pattern_page, $content, $pagelink[]);
    foreach ($pagelink[0][2] as $key => $value) {
    $pic_url = $value;
    $url_feter = parse_url($pic_url);
    if(stripos($url_feter["host"],"'.get_bloginfo('url').'")){ //此处修改成自己的网址
    continue;
    }else{
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_HEADER,1);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch,CURLOPT_URL,$pic_url);
    $hd = curl_exec($ch);
   if(!empty($hd) && !(stripos($hd,'Content-Length: image/png')||stripos($hd,'Content-Length: image/jpg'))){
    $fp =file_get_contents($pic_url);
    $pic_name =basename($url_feter["path"]);
    $savePath = $realPath.'/'.$pic_name;
    $fullPath = $path.'/'.$pic_name;
    if(file_exists($savePath)){
    $savePath = $realPath.'/'.str_replace('.','_'.date("YmdHis").'.' ,$pic_name);
    $fullPath = $path.'/'.str_replace('.','_'.date("YmdHis").'.' ,$pic_name);
    }

   if(file_put_contents($savePath,$fp)){
    $content = str_replace($pic_url, $fullPath, $content);
    $pic_xiangdui = str_replace($pathbase,'',$fullPath);
    $wpdb->query("INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES ('{$post_id}', '_wp_attached_file' ,'{$pic_xiangdui}')");
    $picInfo =array();
    $picInfo['file'] = $pic_xiangdui;
    $picInfo['width'] = $picSize[0];
    $picInfo['height'] = $picSize[1];
    $picInfo['sizes'] = array();
    $picInfo['image_meta'] = array(
    'aperture' => '0',
    'credit'	=> '',
    'camera'	=>'',
    'caption' =>'',
    'created_timestamp' =>'0',
    'copyright' =>'0',
    'focal_length' =>'0',
    'iso'	=>'0',
    'shutter_speed' =>'0',
    'title' => ''
    );
    $picStr = serialize($picInfo);
    $wpdb->query("INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES ('{$post_id}', '_wp_attachment_metadata' ,'{$picStr}')");

    $daytime= date("Y-m-d H:i:s");
    $daytimegmt =date("Y-m-d H:i:s",strtotime('-8 hours'));
    list($pictitle)=explode('.',$pic_name);
    $wpdb->query("
    INSERT INTO wp_posts (post_author, post_date, post_date_gmt,post_content,post_title,post_excerpt,
    post_status,comment_status,ping_status,post_password,post_name,to_ping,pinged,post_modified,post_modified_gmt,
    post_content_filtered,post_parent,guid,menu_order,post_type,post_mime_type,comment_count) VALUES (
    '1','{$daytime}','{$daytimegmt}','','{$pictitle}','','inherit','open','open','','{$pictitle}','','',
    '{$daytime}','{$daytimegmt}','','0','{$fullPath}','0','attachment','".$picSize['mime']."','0')");
    }
    }

    }
    }
    return $content;
    }
if( dopt('d_yuanpic_b') ){
add_filter( 'content_save_pre', 'save_post_fix');
}

//百度收录提示
function baidu_check($url){
    global $wpdb;
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $baidu_record  = get_post_meta($post_id,'baidu_record',true);
    if( $baidu_record != 1){
        $url='http://www.baidu.com/s?wd='.$url;
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $rs=curl_exec($curl);
        curl_close($curl);
        if(!strpos($rs,'没有找到')){
            if( $baidu_record == 0){
                update_post_meta($post_id, 'baidu_record', 1);
            } else {
                add_post_meta($post_id, 'baidu_record', 1, true);
            }
                return 1;
        } else {
            if( $baidu_record == false){
                add_post_meta($post_id, 'baidu_record', 0, true);
            }
            return 0;
        }
    } else {
       return 1;
    }
}
function baidu_record() {
    if(baidu_check(get_permalink()) == 1) {
        echo '<a target="_blank" title="点击查看" rel="external nofollow" href="http://www.baidu.com/s?wd='.get_the_title().'">已收录</a>';
   } else {
        echo '<a style="color:red;" rel="external nofollow" title="点击提交，谢谢您！" target="_blank" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename='.get_permalink().'">未收录</a>';
   }
}

//主题自动更新服务
if( dopt('d_update_b') ){
require 'updates.php';
}
$example_update_checker = new ThemeUpdateChecker(
    'yusi',
    'https://git.oschina.net/yunluo/API/raw/master/info.json'//此处链接不可改
);

//屏蔽长连接评论
function lang_url_spamcheck( $approved , $commentdata ) {
    return ( strlen( $commentdata['comment_author_url'] ) > 50 ) ?
 //表示评论中链接长度超过50为垃圾评论
 'spam' : $approved;
}
if( dopt('d_spamComments_b') ){
add_filter( 'pre_comment_approved', 'lang_url_spamcheck', 99, 2 );
}

//本地头像
class Simple_Local_Avatars {
    private $user_id_being_edited;

    public function __construct() {
        add_filter( 'get_avatar', array( $this, 'get_avatar' ), 10, 5 );

        add_action( 'admin_init', array( $this, 'admin_init' ) );

        add_action( 'show_user_profile', array( $this, 'edit_user_profile' ) );
        add_action( 'edit_user_profile', array( $this, 'edit_user_profile' ) );

        add_action( 'personal_options_update', array( $this, 'edit_user_profile_update' ) );
        add_action( 'edit_user_profile_update', array( $this, 'edit_user_profile_update' ) );

        add_filter( 'avatar_defaults', array( $this, 'avatar_defaults' ) );
    }

    public function get_avatar( $avatar = '', $id_or_email, $size = 96, $default = '', $alt = false ) {

        if ( is_numeric($id_or_email) )
            $user_id = (int) $id_or_email;
        elseif ( is_string( $id_or_email ) && ( $user = get_user_by( 'email', $id_or_email ) ) )
            $user_id = $user->ID;
        elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) )
            $user_id = (int) $id_or_email->user_id;

        if ( empty( $user_id ) )
            return $avatar;

        $local_avatars = get_user_meta( $user_id, 'simple_local_avatar', true );

        if ( empty( $local_avatars ) || empty( $local_avatars['full'] ) )
            return $avatar;

        $size = (int) $size;

        if ( empty( $alt ) )
            $alt = get_the_author_meta( 'display_name', $user_id );

        // generate a new size
        if ( empty( $local_avatars[$size] ) ) {
            $upload_path = wp_upload_dir();
            $avatar_full_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $local_avatars['full'] );
            $image_sized = image_resize( $avatar_full_path, $size, $size, true );
            // deal with original being >= to original image (or lack of sizing ability)
            $local_avatars[$size] = is_wp_error($image_sized) ? $local_avatars[$size] = $local_avatars['full'] : str_replace( $upload_path['basedir'], $upload_path['baseurl'], $image_sized );
            // save updated avatar sizes
            update_user_meta( $user_id, 'simple_local_avatar', $local_avatars );
        } elseif ( substr( $local_avatars[$size], 0, 4 ) != 'http' ) {
            $local_avatars[$size] = home_url( $local_avatars[$size] );
        }

        $author_class = is_author( $user_id ) ? ' current-author' : '' ;
        $avatar = "<img alt='" . esc_attr( $alt ) . "' src='" . $local_avatars[$size] . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";

        return apply_filters( 'simple_local_avatar', $avatar );
    }

    public function admin_init() {
        //load_plugin_textdomain( 'simple-local-avatars', false, dirname( plugin_basename( __FILE__ ) ) . '/localization/' );

        register_setting( 'discussion', 'simple_local_avatars_caps', array( $this, 'sanitize_options' ) );
        add_settings_field( 'simple-local-avatars-caps', __('Local Avatar Permissions','simple-local-avatars'), array( $this, 'avatar_settings_field' ), 'discussion', 'avatars' );
    }

    public function sanitize_options( $input ) {
        $new_input['simple_local_avatars_caps'] = empty( $input['simple_local_avatars_caps'] ) ? 0 : 1;
        return $new_input;
    }

    public function avatar_settings_field( $args ) {
        $options = get_option('simple_local_avatars_caps');

        echo '
            <label for="simple_local_avatars_caps">
                <input type="checkbox" name="simple_local_avatars_caps" id="simple_local_avatars_caps" value="1" ' . @checked( $options['simple_local_avatars_caps'], 1, false ) . ' />
                ' . __('仅具有头像上传权限的用户具有设置本地头像权限（作者及更高等级角色）。','simple-local-avatars') . '
            </label>
        ';
    }

    public function edit_user_profile( $profileuser ) {
    ?>
    <h3><?php _e( '头像','simple-local-avatars' ); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="simple-local-avatar"><?php _e('上传头像','simple-local-avatars'); ?></label></th>
            <td style="width: 50px;" valign="top">
                <?php echo get_avatar( $profileuser->ID ); ?>
            </td>
            <td>
            <?php
                $options = get_option('simple_local_avatars_caps');

                if ( empty($options['simple_local_avatars_caps']) || current_user_can('upload_files') ) {
                    do_action( 'simple_local_avatar_notices' );
                    wp_nonce_field( 'simple_local_avatar_nonce', '_simple_local_avatar_nonce', false );
            ?>
                    <input type="file" name="simple-local-avatar" id="simple-local-avatar" /><br />
            <?php
                    if ( empty( $profileuser->simple_local_avatar ) )
                        echo '<span class="description">' . __('尚未设置本地头像，请点击“浏览”按钮上传本地头像。','simple-local-avatars') . '</span>';
                    else
                        echo '
                            <input type="checkbox" name="simple-local-avatar-erase" value="1" /> ' . __('移除本地头像','simple-local-avatars') . '<br />
                            <span class="description">' . __('如需要修改本地头像，请重新上传新头像。如需要移除本地头像，请选中上方的“移除本地头像”复选框并更新个人资料即可。<br/>移除本地头像后，将恢复使用 Gravatar 头像。','simple-local-avatars') . '</span>
                        ';
                } else {
                    if ( empty( $profileuser->simple_local_avatar ) )
                        echo '<span class="description">' . __('尚未设置本地头像，请在 Gravatar.com 网站设置头像。','simple-local-avatars') . '</span>';
                    else
                        echo '<span class="description">' . __('你没有头像上传权限，如需要修改本地头像，请联系站点管理员。','simple-local-avatars') . '</span>';
                }
            ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript">var form = document.getElementById('your-profile');form.encoding = 'multipart/form-data';form.setAttribute('enctype', 'multipart/form-data');</script>
    <?php
    }

    public function edit_user_profile_update( $user_id ) {
        if ( ! isset( $_POST['_simple_local_avatar_nonce'] ) || ! wp_verify_nonce( $_POST['_simple_local_avatar_nonce'], 'simple_local_avatar_nonce' ) )            //security
            return;

        if ( ! empty( $_FILES['simple-local-avatar']['name'] ) ) {
            $mimes = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
                'bmp' => 'image/bmp',
                'tif|tiff' => 'image/tiff'
            );

            // front end (theme my profile etc) support
            if ( ! function_exists( 'wp_handle_upload' ) )
                require_once( ABSPATH . 'wp-admin/includes/file.php' );

            $this->avatar_delete( $user_id );    // delete old images if successful

            // need to be more secure since low privelege users can upload
            if ( strstr( $_FILES['simple-local-avatar']['name'], '.php' ) )
                wp_die('For security reasons, the extension ".php" cannot be in your file name.');

            $this->user_id_being_edited = $user_id; // make user_id known to unique_filename_callback function
            $avatar = wp_handle_upload( $_FILES['simple-local-avatar'], array( 'mimes' => $mimes, 'test_form' => false, 'unique_filename_callback' => array( $this, 'unique_filename_callback' ) ) );

            if ( empty($avatar['file']) ) {     // handle failures
                switch ( $avatar['error'] ) {
                    case 'File type does not meet security guidelines. Try another.' :
                        add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error",__("请上传有效的图片文件。","simple-local-avatars"));') );
                        break;
                    default :
                        add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error","<strong>".__("上传头像过程中出现以下错误：","simple-local-avatars")."</strong> ' . esc_attr( $avatar['error'] ) . '");') );
                }

                return;
            }

            update_user_meta( $user_id, 'simple_local_avatar', array( 'full' => $avatar['url'] ) );      // save user information (overwriting old)
        } elseif ( ! empty( $_POST['simple-local-avatar-erase'] ) ) {
            $this->avatar_delete( $user_id );
        }
    }

    /**
     * remove the custom get_avatar hook for the default avatar list output on options-discussion.php
     */
    public function avatar_defaults( $avatar_defaults ) {
        remove_action( 'get_avatar', array( $this, 'get_avatar' ) );
        return $avatar_defaults;
    }

    /**
     * delete avatars based on user_id
     */
    public function avatar_delete( $user_id ) {
        $old_avatars = get_user_meta( $user_id, 'simple_local_avatar', true );
        $upload_path = wp_upload_dir();

        if ( is_array($old_avatars) ) {
            foreach ($old_avatars as $old_avatar ) {
                $old_avatar_path = str_replace( $upload_path['baseurl'], $upload_path['basedir'], $old_avatar );
                @unlink( $old_avatar_path );
            }
        }

        delete_user_meta( $user_id, 'simple_local_avatar' );
    }

    public function unique_filename_callback( $dir, $name, $ext ) {
        $user = get_user_by( 'id', (int) $this->user_id_being_edited );
        $name = $base_name = sanitize_file_name( substr(md5($user->user_login),0,12) . '_avatar' );
        $number = 1;

        while ( file_exists( $dir . "/$name$ext" ) ) {
            $name = $base_name . '_' . $number;
            $number++;
        }

        return $name . $ext;
    }
}

$simple_local_avatars = new Simple_Local_Avatars;

function get_simple_local_avatar( $id_or_email, $size = '96', $default = '', $alt = false ) {
    global $simple_local_avatars;
    $avatar = $simple_local_avatars->get_avatar( '', $id_or_email, $size, $default, $alt );

    if ( empty ( $avatar ) )
        $avatar = get_avatar( $id_or_email, $size, $default, $alt );

    return $avatar;
}

//七牛CDN
	if ( !is_admin() && dopt('d_qiniucdn_b') ) {
	add_action('wp_loaded','Googlo_ob_start');

	function Googlo_ob_start() {
		ob_start('Googlo_qiniu_cdn_replace');
	}
	function Googlo_qiniu_cdn_replace($html){
	$local_host = ''.get_bloginfo('url').''; //博客域名
	$qiniu_host = ''.get_option('d_cdnurl_b').''; //七牛域名
	$cdn_exts   = ''.get_option('d_cdnind_b').''; //扩展名（使用|分隔）
	$cdn_dirs   = ''.get_option('d_cdndir_b').''; //目录（使用|分隔）

	$cdn_dirs   = str_replace('-', '\-', $cdn_dirs);

	if ($cdn_dirs) {
		$regex	=  '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
		$html =  preg_replace($regex, $qiniu_host . '/$1$4', $html);
	} else {
		$regex	= '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
		$html =  preg_replace($regex, $qiniu_host . '/$1$3', $html);
	}
	return $html;
}
}

?>