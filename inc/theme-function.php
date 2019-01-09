<?php

//新标签打开顶部网站链接
function blank_my_site_bar( $wp_admin_bar ) {
    $node = $wp_admin_bar->get_node('view-site');
    $node->meta['target'] = '_blank';
    $wp_admin_bar->add_node($node);
}
add_action( 'admin_bar_menu', 'blank_my_site_bar', 80 );

//用github登录替换默认的登录
function force_github_login_url( $login_url, $redirect, $force_reauth ){
    $login_url = github_oauth_url();
    if ( ! empty( $redirect ) ) {
        $login_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $login_url );
    }
    if ( $force_reauth ) {
        $login_url = add_query_arg( 'reauth', '1', $login_url );
    }
    return $login_url;
}if(git_get_option('git_github_oauth_force')){
add_filter( 'login_url', 'force_github_login_url', 10, 3 );
}

//获取云落的远程通知，加入缓存，1天一次
function get_Yunluo_Notice(){
	$Yunluo_Notice = get_transient('Yunluo_Notice');
	if(false === $Yunluo_Notice){ 
        $Yunluo_Notice = wp_remote_get('https://upyun.gitcafe.net/static/notice.txt');
		if ( is_array( $Yunluo_Notice ) && !is_wp_error($Yunluo_Notice) && $Yunluo_Notice['response']['code'] == '200' ) {
			set_transient('Yunluo_Notice', $Yunluo_Notice['body'], 60*60*24);//缓存120小时
		}else{
			set_transient('Yunluo_Notice', '有点小尴尬哈啊，服务器菌暂时有点累了呢，先休息一会儿~，', 60*60*2);//缓存2小时
		}
    }
    return $Yunluo_Notice;
}

//获取页面id，并且不可重用
function git_page_id($pagephp) {
    global $wpdb;
    $pageid = $wpdb->get_row("SELECT `post_id` FROM `{$wpdb->postmeta}` WHERE `meta_value` = 'pages/{$pagephp}.php'", ARRAY_A) ['post_id'];
    return $pageid;
}

//根据订单描述金币数据唯一性检查
function git_check($k) {
	global $wpdb;
	$payresult = $wpdb->query("SELECT `point_id` FROM `" . Points_Database::points_get_table("users") . "` WHERE `description` = '{$k}' LIMIT 6", ARRAY_A);
	return $payresult;//0=无数据，1=正常，>1均为错误数据
}

//微信订阅推送
function wx_send($post_ID) {
	if (get_post_meta($post_ID, 'git_wx_submit', true) == 1) return;
    if(!isset($_POST['git_wx_submit'])) return;
	if( wp_is_post_revision($post_ID) ) return;
	$text = get_the_title($post_ID); //微信推送信息标题
	$wx_post_link = get_permalink($post_ID).'?from=pushbear';//文章链接
	$wx_post_content = deel_strimwidth(strip_tags(strip_shortcodes(get_post($post_ID)->post_content)) , 0, 210 , '……');
	$desp = '![特色图]('.link_the_thumbnail_src().')
***

>'.$wx_post_content.'

***

[【点击链接查看全文】]('.$wx_post_link.')'; //微信推送内容正文
	$key = git_get_option('git_Pushbear_key');
	$request = new WP_Http;
	$api_url = 'https://pushbear.ftqq.com/sub';
	$body = array(
		'sendkey' => $key,
		'text' => $text,
		'desp' => $desp
	);
	$headers = 'Content-type: application/x-www-form-urlencoded';
	$result = $request->post($api_url, array(
            'body' => $body,
            'headers' => $headers
        )
	);
	add_post_meta($post_ID, 'git_wx_submit', 1, true);
}
if(git_get_option('git_Pushbear_key')){
add_action('publish_post', 'wx_send');
}

//禁用新版编辑器
add_filter('use_block_editor_for_post', '__return_false');
remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

// 支持文章和页面运行PHP代码
function php_include($attr) {
    $file = $attr['file'];
    $upload_dir = wp_upload_dir();
    $folder = $upload_dir['basedir'] . '/php-content' . "/{$file}.php";
    ob_start();
    include $folder;
    return ob_get_clean();
}
add_shortcode('phpcode', 'php_include');
//评论微信推送
if (git_get_option('git_Server') && !is_admin()) {
    function sc_send($comment_id) {
        $text = '网站上有新的评论，请及时查看'; //微信推送信息标题
        $comment = get_comment($comment_id);
        $desp = '' . $comment->comment_content . '
***
<br>
* 评论人 ：' . get_comment_author($comment_id) . '
* 文章标题 ：' . get_the_title() . '
* 文章链接 ：' . get_the_permalink($comment->comment_post_ID) . '
	'; //微信推送内容正文
        $key = git_get_option('git_Server_key');
        $postdata = http_build_query(array(
            'text' => $text,
            'desp' => $desp
        ));
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        return $result = file_get_contents('http://sc.ftqq.com/' . $key . '.send', false, $context);
    }
    add_action('comment_post', 'sc_send', 19, 2);
}
// 内链图片src
function link_the_thumbnail_src() {
    global $post;
    if (get_post_meta($post->ID, 'thumbnail', true)) {
        //如果有缩略图，则显示缩略图
        $image = get_post_meta($post->ID, 'thumbnail', true);
        return $image;
    } else {
        if (has_post_thumbnail()) {
            //如果有缩略图，则显示缩略图
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID) , "Full");
            return $img_src[0];
        } else {
            $content = $post->post_content;
            preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
            $n = count($strResult[1]);
            if ($n > 0) {
                return $strResult[1][0];
                //没有缩略图就取文章中第一张图片作为缩略图
            } else {
                $random = mt_rand(1, 12);
                return GIT_URL . '/assets/img/pic/' . $random . '.jpg';
                //文章中没有图片就在 random 文件夹下随机读取图片作为缩略图

            }
        }
    }
}
//给文章加内链短代码
function git_insert_posts($atts, $content = null) {
    extract(shortcode_atts(array(
        'ids' => ''
    ) , $atts));
    global $post;
    $content = '';
    $postids = explode(',', $ids);
    $inset_posts = get_posts(array(
        'post__in' => $postids
    ));
    foreach ($inset_posts as $key => $post) {
        setup_postdata($post);
        $content.= '<div class="neilian"><div class="fll"><a target="_blank" href="' . get_permalink() . '" class="fll linkss"><i class="fa fa-link fa-fw"></i>  ';
        $content.= get_the_title();
        $content.= '</a><p class="note">';
        $content.= get_the_excerpt();
        $content.= '</p></div><div class="frr"><a target="_blank" href="' . get_permalink() . '"><img src=';
        $content.= link_the_thumbnail_src();
        $content.= ' class="neilian-thumb"></a></div></div>';
    }
    wp_reset_postdata();
    return $content;
}
add_shortcode('neilian', 'git_insert_posts');
//给文章加外链短代码
function git_external_posts($atts, $content = null) {
    $result = curl_post($content) ['data'];
    $title = preg_match('!<title>(.*?)</title>!i', $result, $matches) ? $matches[1] : '我是标题我是标题我是标题我是标题我是标题我是标题我是标题';
    $tags = get_meta_tags($content);
    $description = $tags['description'];
    $imgpath = GIT_URL . '/assets/img/pic/' . mt_rand(1, 12) . '.jpg';
    global $post;
    $contents = '';
    setup_postdata($post);
    $contents.= '<div class="neilian wailian"><div class="fll"><a target="_blank" href="' . $content . '" class="fll linkss"><i class="fa fa-link fa-fw"></i>  ';
    $contents.= $title;
    $contents.= '</a><p class="note">';
    $contents.= $description;
    $contents.= '</p></div><div class="frr"><a target="_blank" href="' . $content . '"><img src=';
    $contents.= $imgpath;
    $contents.= ' class="neilian-thumb"></a></div></div>';
    wp_reset_postdata();
    return $contents;
}
if (function_exists('curl_init')) {
    add_shortcode('wailian', 'git_external_posts');
}
//增加B站视频
wp_embed_unregister_handler('bili');
function wp_bili($matches, $attr, $url, $rawattr) {
    if (git_is_mobile()) {
        $height = 200;
    } else {
        $height = 480;
    }
    $iframe = '<iframe width=100% height=' . $height . 'px src="//www.bilibili.com/blackboard/player.html?aid=' . esc_attr($matches[1]) . '" scrolling="no" border="0" framespacing="0" frameborder="no"></iframe>';
    return apply_filters('iframe_bili', $iframe, $matches, $attr, $url, $ramattr);
}
wp_embed_register_handler('bili_iframe', '#https://www.bilibili.com/video/av(.*?)/#i', 'wp_bili');
//仅显示作者自己的文章
function mypo_query_useronly($wp_query) {
    if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/edit.php') !== false) {
        if (!current_user_can('manage_options')) {
            $wp_query->set('author', get_current_user_id());
        }
    }
}
add_filter('parse_query', 'mypo_query_useronly');
//在文章编辑页面的[添加媒体]只显示用户自己上传的文件
function only_my_upload_media($wp_query_obj) {
    global $pagenow;
    if (!is_a(wp_get_current_user(), 'WP_User')) return;
    if ('admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments') return;
    if (!current_user_can('manage_options') && !current_user_can('manage_media_library')) $wp_query_obj->set('author', get_current_user_id());
    return;
}
add_action('pre_get_posts', 'only_my_upload_media');
//在[媒体库]只显示用户上传的文件
function only_my_media_library($wp_query) {
    if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/upload.php') !== false) {
        if (!current_user_can('manage_options') && !current_user_can('manage_media_library')) {
            $wp_query->set('author', get_current_user_id());
        }
    }
}
add_filter('parse_query', 'only_my_media_library');
//CDN水印
if (git_get_option('git_cdn_water')) {
    function cdn_water($content){
        if (get_post_type() !== 'product') {
            $pattern = "/<img(.*?)src=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
            $replacement = '<img$1src=$2$3.$4!water.jpg$5$6>';
            $content = preg_replace($pattern, $replacement, $content);
        }
        return $content;
    }
    add_filter('the_content', 'cdn_water');
}
//快速插入列表
function git_list_shortcode_handler($atts, $content = '') {
    $lists = explode("\n", $content);
    $ouput = '';
    foreach ($lists as $li) {
        if (trim($li) != '') {
            $output.= "<li>{$li}</li>";
        }
    }
    $output = "<ul>" . $output . "</ul>\n";
    return $output;
}
add_shortcode('list', 'git_list_shortcode_handler');
//禁用默认的附件页面
function git_disable_attachment_pages() {
    global $post;
    if (is_attachment()) {
        if (!empty($post->post_parent)) {
            wp_redirect(get_permalink($post->post_parent) , 301);
            exit;
        } else {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('template_redirect', 'git_disable_attachment_pages', 1);
//文章目录,来自露兜,云落修改
if (git_get_option('git_article_list')) {
    function article_index($content) {
        $matches = array();
        $ul_li = '';
        $r = "/<h2>([^<]+)<\/h2>/im";
        if (is_single() && preg_match_all($r, $content, $matches)) {
            foreach ($matches[1] as $num => $title) {
                $title = trim(strip_tags($title));
                $content = str_replace($matches[0][$num], '<h2 id="title-' . $num . '">' . $title . '</h2>', $content);
                $ul_li.= '<li><a href="#title-' . $num . '">' . $title . "</a></li>\n";
            }
            $content = '<div id="article-index">
                            <strong>文章目录<a class="hidetoc">[隐藏]</a></strong>
                            <ul id="index-ul">' . $ul_li . '</ul>
                        </div>' . $content;
        }
        return $content;
    }
    add_filter('the_content', 'article_index');
}
// 添加一个新的列 ID
function ssid_column($cols) {
    $cols['ssid'] = 'ID';
    return $cols;
}
add_action('manage_users_columns', 'ssid_column');
function ssid_return_value($value, $column_name, $id) {
    if ($column_name == 'ssid') $value = $id;
    return $value;
}
add_filter('manage_users_custom_column', 'ssid_return_value', 10, 3);
//用户列表显示积分
add_filter('manage_users_columns', 'my_users_columns');
function my_users_columns($columns) {
    $columns['points'] = '金币';
    return $columns;
}
function output_my_users_columns($value, $column_name, $user_id) {
    if ($column_name == 'points') {
        $jinbi = Points::get_user_total_points($user_id, POINTS_STATUS_ACCEPTED);
        if ($jinbi != "") {
            $ret = $jinbi;
            return $ret;
        } else {
            $ret = '穷逼一个';
            return $ret;
        }
    }
    return $value;
}
add_action('manage_users_custom_column', 'output_my_users_columns', 10, 3);
//本地头像
function git_user_avatar($column_headers) {
    $column_headers['local_avatar'] = '本地头像';
    return $column_headers;
}
add_filter('manage_users_columns', 'git_user_avatar');
function git_ripms_user_avatar($value, $column_name, $user_id) {
    if ($column_name == 'local_avatar') {
        $localavatar = get_user_meta($user_id, 'simple_local_avatar', true);
        if (empty($localavatar)) {
            $ret = '未设置';
            return $ret;
        } else {
            $ret = '已设置';
            return $ret;
        }
    }
    return $value;
}
add_action('manage_users_custom_column', 'git_ripms_user_avatar', 10, 3);
//用户增加评论数量
function git_users_comments($columns) {
    $columns['comments'] = '评论';
    return $columns;
}
add_filter('manage_users_columns', 'git_users_comments');
function git_show_users_comments($value, $column_name, $user_id) {
    if ($column_name == 'comments') {
        $comments_counts = get_comments(array(
            'status' => '1',
            'user_id' => $user_id,
            'count' => true
        ));
        if ($comments_counts != "") {
            $ret = $comments_counts;
            return $ret;
        } else {
            $ret = '暂未评论';
            return $ret;
        }
    }
    return $value;
}
add_action('manage_users_custom_column', 'git_show_users_comments', 10, 3);
// 添加一个字段保存IP地址
function git_log_ip($user_id) {
    $ip = $_SERVER['REMOTE_ADDR'];
    update_user_meta($user_id, 'signup_ip', $ip);
}
add_action('user_register', 'git_log_ip');
// 添加“IP地址”这个栏目
function git_signup_ip($column_headers) {
    $column_headers['signup_ip'] = 'IP地址';
    return $column_headers;
}
add_filter('manage_users_columns', 'git_signup_ip');
function git_ripms_columns($value, $column_name, $user_id) {
    if ($column_name == 'signup_ip') {
        $ip = get_user_meta($user_id, 'signup_ip', true);
        if ($ip != "") {
            $ret = $ip;
            return $ret;
        } else {
            $ret = '没有记录';
            return $ret;
        }
    }
    return $value;
}
add_action('manage_users_custom_column', 'git_ripms_columns', 10, 3);
// 创建一个新字段存储用户登录时间
function git_insert_last_login($login) {
    $user = get_user_by('login', $login);
    update_user_meta($user->ID, 'last_login', current_time('mysql'));
}
add_action('wp_login', 'git_insert_last_login');
// 添加一个新栏目“上次登录”
function git_add_last_login_column($columns) {
    $columns['last_login'] = '上次登录';
    unset($columns['name']);
    return $columns;
}
add_filter('manage_users_columns', 'git_add_last_login_column');
// 显示登录时间到新增栏目
function git_add_last_login_column_value($value, $column_name, $user_id) {
    if ($column_name == 'last_login') {
        $login = get_user_meta($user_id, 'last_login', true);
        if ($login != "") {
            $ret = $login;
            return $ret;
        } else {
            $ret = '暂未登录';
            return $ret;
        }
    }
    return $value;
}
add_action('manage_users_custom_column', 'git_add_last_login_column_value', 10, 3);
//注册时间
add_filter('manage_users_columns', 'git_add_users_column_reg_time');
function git_add_users_column_reg_time($column_headers) {
    $column_headers['reg_time'] = '注册时间';
    return $column_headers;
}
add_filter('manage_users_custom_column', 'git_show_users_column_reg_time', 10, 3);
function git_show_users_column_reg_time($value, $column_name, $user_id) {
    if ($column_name == 'reg_time') {
        $user = get_user_by('id', $user_id);
        return get_date_from_gmt($user->user_registered);
    } else {
        return $value;
    }
}
add_filter('manage_users_sortable_columns', 'git_users_sortable_columns');
function git_users_sortable_columns($sortable_columns) {
    $sortable_columns['reg_time'] = 'reg_time';
    return $sortable_columns;
}
add_action('pre_user_query', 'git_users_search_order');
function git_users_search_order($obj) {
    if (!isset($_REQUEST['orderby']) || $_REQUEST['orderby'] == 'reg_time') {
        if (!in_array($_REQUEST['order'], array(
            'asc',
            'desc'
        ))) {
            $_REQUEST['order'] = 'desc';
        }
        $obj->query_orderby = "ORDER BY user_registered " . $_REQUEST['order'] . "";
    }
}
//后台登陆数学验证码
if (git_get_option('git_admin_captcha')) {
    function git_add_login_fields(){
        $num1 = mt_rand(0, 20);
        $num2 = mt_rand(0, 20);
        echo "<p><label for='sum'> {$num1} + {$num2} = ?<br /><input type='text' name='sum' class='input' value='' size='25' tabindex='4'>" . "<input type='hidden' name='num1' value='{$num1}'>" . "<input type='hidden' name='num2' value='{$num2}'></label></p>";
    }
    add_action('login_form', 'git_add_login_fields');
    add_action('register_form', 'git_add_login_fields');
    function git_login_val(){
        $sum = $_POST['sum'];
        switch ($sum) {
            case $_POST['num1'] + $_POST['num2']:
                break;
            case null:
                wp_die('错误: 请输入验证码&nbsp; <a href="javascript:;" onclick="javascript:history.back();">返回上页</a>');
                break;
            default:
                wp_die('错误: 验证码错误,请重试&nbsp; <a href="javascript:;" onclick="javascript:history.back();">返回上页</a>');
        }
    }
    add_action('login_form_login', 'git_login_val');
    add_action('register_post', 'git_login_val');
}
//限制每个ip的注册数量
if (git_get_option('git_regist_ips')) {
    function validate_reg_ips(){
        global $err_msg;
        $allow_time = git_get_option('git_regist_ips_num');
        //每个IP允许注册的用户数
        $allowed = true;
        $ipsfile = ABSPATH . '/ips.txt';
        $ips = file_get_contents($ipsfile);
        $times = substr_count($ips, getIp());
        if ($times >= $allow_time) {
            $allowed = false;
            $err_msg = "该IP注册用户超过上限，无法继续注册！";
        }
        $ips = '';
        return $allowed;
    }
    add_filter('validate_username', 'validate_reg_ips', 10, 1);
    function ip_restrict_errors($errors){
        global $err_msg;
        if (isset($errors->errors['invalid_username'])) {
            $errors->errors['invalid_username'][0] = $err_msg;
        }
        return $errors;
    }
    add_filter('registration_errors', 'ip_restrict_errors');
    function update_reg_ips(){
        $ipsfile = ABSPATH . '/ips.txt';
        file_put_contents($ipsfile, getIp() . "\r\n", FILE_APPEND);
    }
    add_action('user_register', 'update_reg_ips');
    function getIp(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            } else {
                if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
                    $ip = getenv("REMOTE_ADDR");
                } else {
                    if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    } else {
                        $ip = "unknown";
                    }
                }
            }
        }
        return $ip;
    }
}
//懒加载
if (git_get_option('git_lazyload')) {
    function lazyload($content){
        if (!is_feed() || !is_robots()) {
            $content = preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i', "<img\$1data-original=\"\$2\" \$3>\n<noscript>\$0</noscript>", $content);
        }
        return $content;
    }
    add_filter('the_content', 'lazyload');
}
//自动中英文空格
if (git_get_option('git_auto_kg')) {
    function content_autospace($data){
        $data = preg_replace('/([\\x{4e00}-\\x{9fa5}]+)([A-Za-z0-9_]+)/u', '${1} ${2}', $data);
        $data = preg_replace('/([A-Za-z0-9_]+)([\\x{4e00}-\\x{9fa5}]+)/u', '${1} ${2}', $data);
        return $data;
    }
    add_filter('the_content', 'content_autospace');
}
//只搜索文章标题
function git_search_by_title($search, $wp_query) {
    if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
        global $wpdb;
        $q = $wp_query->query_vars;
        $n = !empty($q['exact']) ? '' : '%';
        $search = array();
        foreach ((array)$q['search_terms'] as $term) {
            $search[] = $wpdb->prepare("{$wpdb->posts}.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);
        }
        if (!is_user_logged_in()) {
            $search[] = "{$wpdb->posts}.post_password = ''";
        }
        $search = ' AND ' . implode(' AND ', $search);
    }
    return $search;
}
add_filter('posts_search', 'git_search_by_title', 10, 2);
//小工具缓存
class GIT_Widget_cache {
    public $cache_time = 18000;
    /*
    MINUTE_IN_SECONDS = 60 seconds
    HOUR_IN_SECONDS = 3600 seconds
    DAY_IN_SECONDS = 86400 seconds
    WEEK_IN_SECONDS = 604800 seconds
    YEAR_IN_SECONDS = 3153600 seconds
    */
    function __construct() {
        add_filter('widget_display_callback', array(
            $this,
            '_cache_widget_output'
        ) , 10, 3);
        add_action('in_widget_form', array(
            $this,
            'in_widget_form'
        ) , 5, 3);
        add_filter('widget_update_callback', array(
            $this,
            'widget_update_callback'
        ) , 5, 3);
    }
    function get_widget_key($i, $a) {
        return 'WC-' . md5(serialize(array(
            $i,
            $a
        )));
    }
    function _cache_widget_output($instance, $widget, $args) {
        if (false === $instance) return $instance;
        if (isset($instance['wc_cache']) && $instance['wc_cache'] == true) return $instance;
        $timer_start = microtime(true);
        $transient_name = $this->get_widget_key($instance, $args);
        if (false === ($cached_widget = get_transient($transient_name))) {
            ob_start();
            $widget->widget($args, $instance);
            $cached_widget = ob_get_clean();
            set_transient($transient_name, $cached_widget, $this->cache_time);
        }
        echo $cached_widget;
        echo '<!-- From widget cache in ' . number_format(microtime(true) - $timer_start, 5) . ' seconds -->';
        return false;
    }
    function in_widget_form($t, $return, $instance) {
        $instance = wp_parse_args((array)$instance, array(
            'title' => '',
            'text' => '',
            'wc_cache' => null
        ));
        if (!isset($instance['wc_cache'])) $instance['wc_cache'] = null;
?>
        <p>
            <input id="<?php
        echo $t->get_field_id('wc_cache'); ?>" name="<?php
        echo $t->get_field_name('wc_cache'); ?>" type="checkbox" <?php
        checked(isset($instance['wc_cache']) ? $instance['wc_cache'] : 0); ?> />
            <label for="<?php
        echo $t->get_field_id('wc_cache'); ?>">禁止缓存本工具?</label>
        </p>
        <?php
    }
    function widget_update_callback($instance, $new_instance, $old_instance) {
        $instance['wc_cache'] = isset($new_instance['wc_cache']);
        return $instance;
    }
} //end GIT_Widget_cache class
if (git_get_option('git_sidebar_cache')) {
    $GLOBALS['GIT_Widget_cache'] = new GIT_Widget_cache();
}
//HTML5 桌面通知
function Notification_js() {
    if (git_get_option('git_notification_days') && git_get_option('git_notification_title') && git_get_option('git_notification_body') && git_get_option('git_notification_icon') && git_get_option('git_notification_cookie')) {
?>
    <script type="text/javascript">
    if (window.Notification) {
	function setCookie(name, value) {
		var exp = new Date();
		exp.setTime(exp.getTime() + <?php echo git_get_option('git_notification_days'); ?> * 24 * 60 * 60 * 1000);
		document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString() + ";path=/";
	}
	function getCookie(name) {
		var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
		if (arr != null) return unescape(arr[2]);
		return null
	}
	var popNotice = function() {
			if (Notification.permission == "granted") {
				var n = new Notification("<?php
        echo git_get_option('git_notification_title'); ?>", {
					body: "<?php
        echo git_get_option('git_notification_body'); ?>",
					icon: "<?php
        echo git_get_option('git_notification_icon'); ?>"
				});
				n.onclick = function() {
					window.location.href="<?php
        echo git_get_option('git_notification_link'); ?>";
					n.close()
				};
				n.onclose = function() {
					setCookie("git_Notification", "<?php
        echo git_get_option('git_notification_cookie'); ?>")
				}
			}
		};
	if (getCookie("git_Notification") == "<?php
        echo git_get_option('git_notification_cookie'); ?>") {
		console.log("您已关闭桌面弹窗提醒，有效期为<?php
        echo git_get_option('git_notification_days'); ?>天！")
	} else {
		if (Notification.permission == "granted") {
			popNotice()
		} else if (Notification.permission != "denied") {
			Notification.requestPermission(function(permission) {
				popNotice()
			})
		}
	}
} else {
	console.log("您的浏览器不支持Web Notification")
}
</script>
    <?php
    }
}
add_action('get_footer', 'Notification_js');

//临时修复文件删除漏洞
//来自：https://www.wpdaxue.com/wordpress-file-delete-to-code-execution.html
function git_rips_unlink_tempfix( $data ) {
    if( isset($data['thumb']) ) {
        $data['thumb'] = basename($data['thumb']);
    }
    return $data;
}
add_filter( 'wp_update_attachment_metadata', 'git_rips_unlink_tempfix' );

//标签增加另外选项
class Git_Tax_Image{
    function __construct(){
		add_action( 'post_tag_add_form_fields', array( $this, 'add_tax_image_field' ) );
		add_action( 'post_tag_edit_form_fields', array( $this, 'edit_tax_image_field' ) );
		add_action( 'edited_post_tag', array( $this, 'save_tax_meta' ), 10, 2 );
		add_action( 'create_post_tag', array( $this, 'save_tax_meta' ), 10, 2 );
    } // __construct
    public function add_tax_image_field(){
    ?>
        <div class="form-field">
            <label for="term_meta[tax_image]">标签封面</label>
            <input type="text" name="term_meta[tax_image]" id="term_meta[tax_image]" value="" />
            <p class="description">输入标签封面图片URL</p>
        </div><!-- /.form-field -->
        <div class="form-field">
            <label for="term_meta[tax_title]">标签标题</label>
            <input type="text" name="term_meta[tax_title]" id="term_meta[tax_title]" value="" />
            <p class="description">输入标签标题</p>
        </div>

    <?php
    } // add_tax_image_field
    public function edit_tax_image_field( $term ){
        $term_id = $term->term_id;
        $term_meta = get_option( "ludou_taxonomy_$term_id" );
        $image = $term_meta['tax_image'] ? $term_meta['tax_image'] : '';
        $keywords = $term_meta['tax_title'] ? $term_meta['tax_title'] : '';

    ?>
        <tr class="form-field">
            <th scope="row">
                <label for="term_meta[tax_image]">标签封面</label>
                <td>
                    <input type="text" name="term_meta[tax_image]" id="term_meta[tax_image]" value="<?php echo esc_url( $image ); ?>" />
                    <p class="description">输入标签封面图片URL</p>
                </td>
            </th>
        </tr><!-- /.form-field -->
        <tr class="form-field">
            <th scope="row">
                <label for="term_meta[tax_title]">标签标题</label>
                <td>
                    <input type="text" name="term_meta[tax_title]" id="term_meta[tax_title]" value="<?php echo $keywords; ?>" />
                    <p class="description">输入标签标题</p>
                </td>
            </th>
        </tr>
    <?php
    } // edit_tax_image_field
    public function save_tax_meta( $term_id ){

        if ( isset( $_POST['term_meta'] ) ) {
            $t_id = $term_id;
            $term_meta = array();
            $term_meta['tax_image'] = isset ( $_POST['term_meta']['tax_image'] ) ? esc_url( $_POST['term_meta']['tax_image'] ) : '';
            $term_meta['tax_title'] = isset ( $_POST['term_meta']['tax_title'] ) ? $_POST['term_meta']['tax_title'] : '';
            update_option( "ludou_taxonomy_$t_id", $term_meta );
        } // if isset( $_POST['term_meta'] )
    } // save_tax_meta

} // Git_Tax_Image

$wptt_tax_image = new Git_Tax_Image();

?>