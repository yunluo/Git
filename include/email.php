<?php


//SMTP邮箱设置
if (git_get_option('git_mailsmtp_b')) {
    function googlo_mail_smtp($phpmailer) {
        $phpmailer->From = git_get_option('git_maildizhi_b'); //发件人地址
        $phpmailer->FromName = git_get_option('git_mailnichen_b'); //发件人昵称
        $phpmailer->Host = git_get_option('git_mailsmtp_b'); //SMTP服务器地址
        $phpmailer->Port = git_get_option('git_mailport_b'); //SMTP邮件发送端口
        if (git_get_option('git_smtpssl_b')) {
            $phpmailer->SMTPSecure = 'ssl';
        } else {
            $phpmailer->SMTPSecure = '';
        } //SMTP加密方式(SSL/TLS)没有为空即可
        $phpmailer->Username = git_get_option('git_mailuser_b'); //邮箱帐号
        $phpmailer->Password = git_get_option('git_mailpass_b'); //邮箱密码
        $phpmailer->IsSMTP();
        $phpmailer->SMTPAuth = true; //启用SMTPAuth服务

    }
    add_action('phpmailer_init', 'googlo_mail_smtp');
}

//修改默认发信地址
function deel_res_from_email($email) {
    $wp_from_email = get_option('admin_email');
    return $wp_from_email;
}
function deel_res_from_name($email) {
    $wp_from_name = get_option('blogname');
    return $wp_from_name;
}
add_filter('wp_mail_from', 'deel_res_from_email');
add_filter('wp_mail_from_name', 'deel_res_from_name');

//评论回应邮件通知
function comment_mail_notify($comment_id) {
    $admin_notify = '0'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
    $admin_email = get_bloginfo('admin_email'); // $admin_email 可改为你指定的 e-mail.
    $comment = get_comment($comment_id);
    $comment_author_email = trim($comment->comment_author_email);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $blogname = get_option("blogname");
    global $wpdb;
    if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '') $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
    if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1')) $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
    $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
    $spam_confirmed = $comment->comment_approved;
    if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = 'Hi，您在 [' . get_option("blogname") . '] 的留言有人回复啦！';
        $message = '<div style="color:#555;font:12px/1.5 微软雅黑,Tahoma,Helvetica,Arial,sans-serif;width:650px;margin:50px auto;border-top: none;box-shadow:0 0px 3px #aaaaaa;" ><table border="0" cellspacing="0" cellpadding="0"><tbody><tr valign="top" height="2"><td valign="top"><div style="background-color:white;border-top:2px solid #12ADDB;line-padding:0 15px 12px;width:650px;color:#555555;font-family:微软雅黑, Arial;;font-size:12px;"><h2 style="border-bottom:1px solid #DDD;font-size:14px;font-weight:normal;padding:8px 0 10px 8px;"><span style="color: #12ADDB;font-weight: bold;">&gt; </span>您在 <a style="text-decoration:none; color:#58B5F5;font-weight:600;" target="_blank" href="' . home_url() . '">' . $blogname . '</a> 网站上的留言有回复啦！</h2><div style="padding:0 12px 0 12px;margin-top:18px"><p>您好, ' . trim(get_comment($parent_id)->comment_author) . '! 您发表在文章 <a style="text-decoration:none;" target="_blank" href="' . get_the_permalink($comment->comment_post_ID) . '">《' . get_the_title($comment->comment_post_ID) . '》</a> 的评论:</p><p style="background-color: #EEE;border: 1px solid #DDD;padding: 20px;margin: 15px 0;">' . nl2br(strip_tags(get_comment($parent_id)->comment_content)) . '</p><p>' . trim($comment->comment_author) . ' 给您的回复如下:</p><p style="background-color: #EEE;border: 1px solid #DDD;padding: 20px;margin: 15px 0;">' . nl2br(strip_tags($comment->comment_content)) . '</p><p>您可以点击 <a style="text-decoration:none; color:#5692BC" target="_blank" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">这里查看回复的完整內容</a>，也欢迎再次光临 <a style="text-decoration:none; color:#5692BC" target="_blank" href="' . home_url() . '">' . $blogname . '</a>。祝您天天开心，欢迎下次访问 <a style="text-decoration:none; color:#5692BC" target="_blank" href="' . home_url() . '">' . $blogname . '</a>！谢谢。</p><p style="float:right;">(此邮件由系统自动发出, 请勿回复)</p></div></div></td></tr></tbody></table><div style="color:#fff;background-color: #12ADDB;text-align : center;height:35px;padding-top:15px">Copyright © 2013-2018 ' . $blogname . '</div></div>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
    }
}
add_action('comment_post', 'comment_mail_notify');

//站长评论邮件添加评论链接
function git_notify_postauthor($notify_message,$comment_ID) {
    $notify = $notify_message;
    $notify.= '快速回复此评论: ' . admin_url("edit-comments.php").'#comment-'.$comment_ID;
    return $notify;
}
add_filter('comment_notification_text', 'git_notify_postauthor', 10, 2);
add_filter('wp_password_change_notification_email', '__return_false'); //关闭密码修改站长邮件
add_filter('password_change_email', '__return_false'); //关闭密码修改用户邮件
if (git_get_option('git_user_notification_to_admin')) {
    add_filter('wp_new_user_notification_email_admin', '__return_false');
} //关闭新用户注册站长邮件
//欢迎新用户邮件
if (git_get_option('git_user_notification_to_user')) {
    function git_register_mail($user_id) {
        $user = get_user_by('id', $user_id);
        $user_pass = $_POST['password'];
        $blogname = get_option('blogname');
        $message = '<div class="emailcontent" style="width:100%;max-width:720px;text-align:left;margin:0 auto;padding-top:80px;padding-bottom:20px"><div class="emailtitle"><h1 style="color:#fff;background:#51a0e3;line-height:70px;font-size:24px;font-weight:400;padding-left:40px;margin:0">注册成功通知</h1><div class="emailtext" style="background:#fff;padding:20px 32px 20px"><div style="padding:0;font-weight:700;color:#6e6e6e;font-size:16px">尊敬的' . $user->user_login . ',您好！</div><p style="color:#6e6e6e;font-size:13px;line-height:24px">欢迎您注册[' . $blogname . ']，下面是您的账号信息，请妥善保管！</p><table cellpadding="0" cellspacing="0" border="0" style="width:100%;border-top:1px solid #eee;border-left:1px solid #eee;color:#6e6e6e;font-size:16px;font-weight:normal"><thead><tr><th colspan="2" style="padding:10px 0;border-right:1px solid #eee;border-bottom:1px solid #eee;text-align:center;background:#f8f8f8">您的详细注册信息</th></tr></thead><tbody><tr><td style="padding:10px 0;border-right:1px solid #eee;border-bottom:1px solid #eee;text-align:center;width:100px">登录邮箱</td><td style="padding:10px 20px 10px 30px;border-right:1px solid #eee;border-bottom:1px solid #eee;line-height:30px">' . $user->user_email . '</td></tr><tr><td style="padding:10px 0;border-right:1px solid #eee;border-bottom:1px solid #eee;text-align:center">登录密码</td><td style="padding:10px 20px 10px 30px;border-right:1px solid #eee;border-bottom:1px solid #eee;line-height:30px">' . $user_pass . '</td></tr></tbody></table><p style="color:#6e6e6e;font-size:13px;line-height:24px">如果您的账号有异常，请您在第一时间和我们取得联系哦，联系邮箱：' . get_bloginfo('admin_email') . '</p></div><div class="emailad" style="margin-top:4px"><a href="' . home_url() . '"><img src="http://reg.163.com/images/secmail/adv.png" alt="" style="margin:auto;width:100%;max-width:700px;height:auto"></a></div></div></div>';
        $headers = "Content-Type:text/html;charset=UTF-8\n";
        wp_mail($user->user_email, '[' . $blogname . ']欢迎注册' . $blogname, $message, $headers);
    }
    add_action('user_register', 'git_register_mail');
    add_filter('wp_new_user_notification_email', '__return_false'); //关闭新用户注册用户邮件
}

//登录失败提醒
if (git_get_option('git_login_tx')) {
    function git_login_failed_notify() {
        date_default_timezone_set('PRC');
        $admin_email = get_bloginfo('admin_email');
        $to = $admin_email;
        $subject = '您的网站登录错误警告';
        $message = '<p>您好！您的网站(' . get_option("blogname") . ')有登录错误！</p>' . '<p>请确定是您自己的登录失误，以防别人攻击！登录信息如下：</p>' . '<p>登录名：' . $_POST['log'] . '</p>' . '<p>登录密码：' . $_POST['pwd'] . '</p>' . '<p>登录时间：' . date("Y-m-d H:i:s") . '</p>' . '<p>登录IP：' . $_SERVER['REMOTE_ADDR'] . '</p>' . '<p style="float:right">————本邮件由系统发送，无需回复</p>';
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
    }
    add_action('wp_login_failed', 'git_login_failed_notify');
}