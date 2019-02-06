<?php

//新文章同步到新浪微博
function post_to_sina_weibo($post_ID) {
    if (get_post_meta($post_ID, 'git_weibo_sync', true) == 1) return;
    $get_post_info = get_post($post_ID);
    $get_post_centent = get_post($post_ID)->post_content;
    $get_post_title = get_post($post_ID)->post_title;
    if ($get_post_info->post_status == 'publish' && $_POST['original_post_status'] != 'publish') {
        $appkey = git_get_option('git_wbapky_b');
        $username = git_get_option('git_wbuser_b');
        $userpassword = git_get_option('git_wbpasd_b');
        $request = new WP_Http;
        $keywords = "";
        $tags = wp_get_post_tags($post_ID);
        foreach ($tags as $tag) {
            $keywords = $keywords . '#' . $tag->name . "#";
        }
        $string1 = '【' . strip_tags($get_post_title) . '】：';
        $string2 = $keywords . ' [阅读全文]：' . get_permalink($post_ID);
        /* 微博字数控制，避免超标同步失败 */
        $wb_num = (138 - WeiboLength($string1 . $string2)) * 2;
        $status = $string1 . mb_strimwidth(strip_tags(apply_filters('the_content', $get_post_centent)) , 0, $wb_num, '...') . $string2;
        $api_url = 'https://api.weibo.com/2/statuses/update.json';
        $body = array(
            'status' => $status,
            'source' => $appkey
        );
        $headers = array(
            'Authorization' => 'Basic ' . base64_encode("$username:$userpassword")
        );
        $result = $request->post($api_url, array(
            'body' => $body,
            'headers' => $headers
        ));
        /* 若同步成功，则给新增自定义栏目git_weibo_sync，避免以后更新文章重复同步 */
        add_post_meta($post_ID, 'git_weibo_sync', 1, true);
    }
}
if (git_get_option('git_sinasync_b')) {
    add_action('publish_post', 'post_to_sina_weibo', 0);
}


/*
//获取微博字符长度函数
*/
function WeiboLength($str) {
    $arr = arr_split_zh($str); //先将字符串分割到数组中
    foreach ($arr as $v) {
        $temp = ord($v); //转换为ASCII码
        if ($temp > 0 && $temp < 127) {
            $len = $len + 0.5;
        } else {
            $len++;
        }
    }
    return ceil($len); //加一取整

}
/*
//拆分字符串函数,只支持 gb2312编码
//参考：http://u-czh.iteye.com/blog/1565858
*/
function arr_split_zh($tempaddtext) {
    $tempaddtext = iconv("UTF-8", "GBK//IGNORE", $tempaddtext);
    $cind = 0;
    $arr_cont = array();
    for ($i = 0; $i < strlen($tempaddtext); $i++) {
        if (strlen(substr($tempaddtext, $cind, 1)) > 0) {
            if (ord(substr($tempaddtext, $cind, 1)) < 0xA1) { //如果为英文则取1个字节
                array_push($arr_cont, substr($tempaddtext, $cind, 1));
                $cind++;
            } else {
                array_push($arr_cont, substr($tempaddtext, $cind, 2));
                $cind+= 2;
            }
        }
    }
    foreach ($arr_cont as & $row) {
        $row = iconv("gb2312", "UTF-8", $row);
    }
    return $arr_cont;
}


//百度收录提示
if (git_get_option('git_baidurecord_b') && function_exists('curl_init')) {
    function baidu_check($url, $post_id){
        $baidu_record = get_post_meta($post_id, 'baidu_record', true);
        if ($baidu_record != 1) {
            $url = 'http://www.baidu.com/s?wd=' . $url;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $rs = curl_exec($curl);
            curl_close($curl);
            if (!strpos($rs, '没有找到该URL，您可以直接访问') && !strpos($rs, '很抱歉，没有找到与')) {
                update_post_meta($post_id, 'baidu_record', 1) || add_post_meta($post_id, 'baidu_record', 1, true);
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }
    function baidu_record(){
        global $wpdb;
        $post_id = null === $post_id ? get_the_ID() : $post_id;
        if (baidu_check(get_permalink($post_id), $post_id) == 1) {
            echo '<a target="_blank" title="点击查看" rel="external nofollow" href="http://www.baidu.com/s?wd=' . get_the_title() . '">已收录</a>';
        } else {
            echo '<a style="color:red;" rel="external nofollow" title="点击提交，谢谢您！" target="_blank" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename=' . get_permalink() . '">未收录</a>';
        }
    }
}

//七牛CDN
if (!is_admin() && git_get_option('git_qncdn_b')) {
    add_action('wp_loaded', 'Googlo_ob_start');
    function Googlo_ob_start() {
        ob_start('Googlo_qiniu_cdn_replace');
    }
    function Googlo_qiniu_cdn_replace($html) {
        $local_host = home_url(); //博客域名
        $qiniu_host = git_get_option('git_cdnurl_b'); //七牛域名
        $cdn_exts = git_get_option('git_cdnurl_format'); //扩展名（使用|分隔）
        $cdn_dirs = git_get_option('git_cdnurl_dir'); //目录（使用|分隔）
        $cdn_dirs = str_replace('-', '\-', $cdn_dirs);
        if ($cdn_dirs) {
            $regex = '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
            $html = preg_replace($regex, $qiniu_host . '/$1$4', $html);
        } else {
            $regex = '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
            $html = preg_replace($regex, $qiniu_host . '/$1$3', $html);
        }
        return $html;
    }
}

//CDN水印
if (git_get_option('git_cdn_water')) {
    function cdn_water($content){
        if (get_post_type() == 'post') {
            $pattern = "/<img(.*?)src=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
            $replacement = '<img$1src=$2$3.$4!water.jpg$5$6>';
            $content = preg_replace($pattern, $replacement, $content);
        }
        return $content;
    }
    add_filter('the_content', 'cdn_water');
}

//自动替换媒体库图片的域名
if (is_admin() && git_get_option('git_cdnurl_b') && git_get_option('git_adminqn_b')) {
    function attachment_replace($text) {
        $replace = array(
             home_url()  => git_get_option('git_cdnurl_b')
        );
        $text = str_replace(array_keys($replace) , $replace, $text);
        return $text;
    }
    add_filter('wp_get_attachment_url', 'attachment_replace');
}

//百度主动推送
if (git_get_option('git_sitemap_api')) {
    function Git_Baidu_Submit($post_ID) {
        if (get_post_meta($post_ID, 'git_baidu_submit', true) == 1) return;
        $url = get_permalink($post_ID);
        $api = git_get_option('git_sitemap_api');
        $request = new WP_Http;
        $result = $request->request($api, array(
            'method' => 'POST',
            'body' => $url,
            'headers' => 'Content-Type: text/plain'
        ));
        if ( is_array( $result ) && !is_wp_error($result) && $result['response']['code'] == '200' ) {
            error_log('baidu_submit_result：'.$result['body']);
            $result = json_decode($result['body'], true);
        }
        if (array_key_exists('success', $result)) {
            add_post_meta($post_ID, 'git_baidu_submit', 1, true);
        }
    }
    add_action('publish_post', 'Git_Baidu_Submit', 0);
}

//用github登录替换默认的登录
function force_github_login_url( $login_url, $redirect, $force_reauth ){
    $login_url = get_permalink(git_page_id('weauth'));
    if ( ! empty( $redirect ) ) {
        $login_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $login_url );
    }
    if ( $force_reauth ) {
        $login_url = add_query_arg( 'reauth', '1', $login_url );
    }
    return $login_url;
}if(git_get_option('git_weauth_oauth') && git_get_option('git_weauth_oauth_force')){
add_filter( 'login_url', 'force_github_login_url', 10, 3 );
}
//微信订阅推送
function wx_send($post_ID) {
	if (get_post_meta($post_ID, 'git_wx_submit', true) == 1) return;
    if(!isset($_POST['git_wx_submit'])) return;
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

//bing美图自定义登录页面背景
function custom_login_head() {
    if (git_get_option('git_loginbg')) {
        $imgurl = git_get_option('git_loginbg');
    } else {
        $imgurl = get_transient('Bing_img');
        if(false === $imgurl){ 
        $arr = json_decode(curl_post('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1')['data']);
        $imgurl = 'http://cn.bing.com' . $arr->images[0]->url;
        set_transient('Bing_img', $imgurl, 60*60*24);
        }
    }
    if (defined('UM_DIR')) {
        echo '<style type="text/css">#um_captcha{width:170px!important;}</style>';
    }
    echo '<style type="text/css">#reg_passmail{display:none!important}body{background: url(' . $imgurl . ') center center no-repeat;-moz-background-size: cover;-o-background-size: cover;-webkit-background-size: cover;background-size: cover;background-attachment: fixed;}.login label,a {font-weight: bold;}.login-action-register #login{padding: 5% 0 0;}.login p {line-height: 1;}.login form {margin-top: 10px;padding: 16px 24px 16px;}h1 a { background-image:url(' . home_url() . '/favicon.ico)!important;width:32px;height:32px;-webkit-border-radius:50px;-moz-border-radius:50px;border-radius:50px;}#registerform,#loginform {background-color:rgba(251,251,251,0.3)!important;}.login label,a{color:#000!important;}form label input{margin-top:10px!important;}@media screen and (max-width:600px){.login-action-register h1 {display: none;}.login-action-register #login{top:50%!important;}}</style>';
}
add_action('login_head', 'custom_login_head');

// add youku using iframe
function wp_iframe_handler_youku($matches, $attr, $url, $rawattr) {
    if (git_is_mobile()) {
        $height = 200;
    } else {
        $height = 485;
    }
    $iframe = '<iframe width=100% height=' . $height . 'px src="http://player.youku.com/embed/' . esc_attr($matches[1]) . '" frameborder=0 allowfullscreen></iframe>';
    return apply_filters('iframe_youku', $iframe, $matches, $attr, $url, $ramattr);
}
wp_embed_register_handler('youku_iframe', '#http://v.youku.com/v_show/id_(.*?).html#i', 'wp_iframe_handler_youku');
// add tudou using iframe
function wp_iframe_handler_tudou($matches, $attr, $url, $rawattr) {
    if (git_is_mobile()) {
        $height = 200;
    } else {
        $height = 485;
    }
    $iframe = '<iframe width=100% height=' . $height . 'px src="http://www.tudou.com/programs/view/html5embed.action?code=' . esc_attr($matches[1]) . '" frameborder=0 allowfullscreen></iframe>';
    return apply_filters('iframe_tudou', $iframe, $matches, $attr, $url, $ramattr);
}
wp_embed_register_handler('tudou_iframe', '#http://www.tudou.com/programs/view/(.*?)/#i', 'wp_iframe_handler_tudou');
wp_embed_unregister_handler('youku');
wp_embed_unregister_handler('tudou');

////////////////weauth//////////////
function weauth_oauth_redirect(){
    wp_redirect( home_url());
    exit;
}

function get_weauth_token(){
  $sk = date("YmdHis") . mt_rand(10, 99);
  set_transient($sk, 1, 60*6);
  $key = $_SERVER['HTTP_HOST'].'@'.$sk;
  return $key;
}

function get_weauth_qr(){
  $qr64 = [];
  $qr64['key'] = get_weauth_token();
  $qr64['qrcode'] = json_decode(file_get_contents('https://wa.isdot.net/qrcode?str='.$qr64['key']),true)['qrcode'];
  return $qr64;
}
 
function weauth_rewrite_rules($wp_rewrite){
    if ($ps = get_option('permalink_structure')) {
        $new_rules['^weauth'] = 'index.php?user=$matches[1]&sk=$matches[2]';
        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    }
}
add_action('generate_rewrite_rules', 'weauth_rewrite_rules');

function weauth_oauth(){
    $weauth_user = $_GET['user'];
    $weauth_sk = esc_attr($_GET['sk']);
    $weauth_res = get_transient($weauth_sk);
    if (empty($weauth_res)) {
        return;
    }
    $weauth_user = stripslashes($weauth_user);
    $weauth_user = json_decode($weauth_user, true);
    $nickname = $weauth_user['nickName'];
    $wxavatar = $weauth_user['avatarUrl'];
    $openid = $weauth_user['openid'];
    $login_name = 'wx_' . wp_create_nonce($openid);
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        update_user_meta($user_id, 'wx_openid', $openid);
        update_user_meta($user_id, 'simple_local_avatar', $wxavatar);
    } else {
        $weauth_user = get_users(array(
          'meta_key ' => 'wx_openid', 
          'meta_value' => $openid
              )
         );
        if (is_wp_error($weauth_user) || !count($weauth_user)) {
            $random_password = wp_generate_password(12, false);
            $userdata = array(
              'user_login' => $login_name, 
              'display_name' => $nickname, 
              'user_pass' => $random_password, 
              'nickname' => $nickname
            );
            $user_id = wp_insert_user($userdata);
            update_user_meta($user_id, 'wx_openid', $openid);
            update_user_meta($user_id, 'simple_local_avatar', $wxavatar);
        } else {
            $user_id = $weauth_user[0]->ID;
        }
    }
    set_transient($weauth_sk . 'ok', $user_id, 60);//用于登录的随机数，有效期为一分钟
    weauth_oauth_redirect();
}
//初始化
function weauth_oauth_init(){
    if (isset($_GET['user']) && isset($_GET['sk'])){
        weauth_oauth();
    }
}
add_action('init','weauth_oauth_init');

//GET自动登录
function weauth_oauth_login(){
    $key = isset($_GET['spam']) ? $_GET['spam'] : false;
    if ($key) {
        $user_id = get_transient($key.'ok');
        if ($user_id != 0) {
            wp_set_auth_cookie($user_id);
        }
    }
}
add_action('init', 'weauth_oauth_login');