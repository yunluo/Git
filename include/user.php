<?php

//添加后台个人信息
function git_add_contact_fields($contactmethods) {
    $contactmethods['qq'] = 'QQ';
    $contactmethods['sina_weibo'] = '新浪微博';
    $contactmethods['baidu'] = '百度ID';
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['github'] = 'GitHub';
    unset($contactmethods['yim']);
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    return $contactmethods;
}
add_filter('user_contactmethods', 'git_add_contact_fields');

if (!defined('UM_DIR')) { /*判断是否按照UM插件*/
    //注册表单
    function git_show_extra_register_fields() {
?>
    <p>
    <label for="password">密码<br/>
    <input id="password" class="input" type="password" tabindex="30" size="25" value="" name="password" />
    </label>
    </p>
    <p>
    <label for="repeat_password">确认密码<br/>
    <input id="repeat_password" class="input" type="password" tabindex="40" size="25" value="" name="repeat_password" />
    </label>
    </p>
    <?php
    }
    add_action('register_form', 'git_show_extra_register_fields');
    /*
     * Check the form for errors
    */
    function git_check_extra_register_fields($login, $email, $errors) {
        if ($_POST['password'] !== $_POST['repeat_password']) {
            $errors->add('passwords_not_matched', "<strong>错误提示</strong>: 两次填写密码不一致");
        }
        if (strlen($_POST['password']) < 8) {
            $errors->add('password_too_short', "<strong>错误提示</strong>: 密码必须大于8个字符");
        }
    }
    add_action('register_post', 'git_check_extra_register_fields', 10, 3);
    /*
     * 提交用户密码进数据库
    */
    function git_register_extra_fields($user_id) {
        $userdata = array();
        $userdata['ID'] = $user_id;
        if ($_POST['password'] !== '') {
            $userdata['user_pass'] = $_POST['password'];
        }
        $pattern = '/[一-龥]/u';
        if (preg_match($pattern, $_POST['user_login'])) {
            $userdata['user_nicename'] = $user_id;
        }
        $new_user_id = wp_update_user($userdata);
    }
    add_action('user_register', 'git_register_extra_fields', 100);
}
//注册之后跳转
if (git_get_option('git_register_redirect_ok')) {
    function git_registration_redirect() {
        if (git_get_option('git_redirect_choise') == 'git_redirect_home') {
            $redirect_url = home_url();
        } elseif (git_get_option('git_redirect_choise') == 'git_redirect_author') {
            $redirect_url = get_author_posts_url($user_id);
        } elseif (git_get_option('git_redirect_choise') == 'git_redirect_profile') {
            $redirect_url = admin_url('wp-admin/profile.php');
        } elseif (git_get_option('git_redirect_choise') == 'git_redirect_profile' && git_get_option('git_register_redirect_url')) {
            $redirect_url = git_get_option('git_register_redirect_url');
        }
        return $redirect_url;
    }
    add_filter('registration_redirect', 'git_registration_redirect');
}

//支持中文名注册，来自肚兜
function git_sanitize_user($username, $raw_username, $strict) {
    $username = wp_strip_all_tags($raw_username);
    $username = remove_accents($username);
    $username = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $username);
    $username = preg_replace('/&.+?;/', '', $username); // Kill entities
    if ($strict) {
        $username = preg_replace('|[^a-z\p{Han}0-9 _.\-@]|iu', '', $username);
    }
    $username = trim($username);
    $username = preg_replace('|\s+|', ' ', $username);
    return $username;
}
add_filter('sanitize_user', 'git_sanitize_user', 10, 3);

//修复 WordPress 找回密码提示“抱歉，该key似乎无效”
function git_reset_password_message($message, $key) {
    if (strpos($_POST['user_login'], '@')) {
        $user_data = get_user_by('email', trim($_POST['user_login']));
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }
    $user_login = $user_data->user_login;
    $msg = "有人要求重设如下帐号的密码：\r\n\r\n";
    $msg.= network_site_url() . "\r\n\r\n";
    $msg.= sprintf('用户名：%s', $user_login) . "\r\n\r\n";
    $msg.= "若这不是您本人要求的，请忽略本邮件，一切如常。\r\n\r\n";
    $msg.= "要重置您的密码，请打开下面的链接：\r\n\r\n";
    $msg.= wp_login_url() . "?action=rp&key=$key&login=" . rawurlencode($user_login);
    return $msg;
}
add_filter('retrieve_password_message', 'git_reset_password_message', null, 2);

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