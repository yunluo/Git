<?php
/**
 Template Name: 用户投稿
 description: template for Git theme
 */
if (!git_get_option('git_tougao_b')) { wp_redirect( home_url() );exit;}
if (isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
    global $wpdb;
    $current_url = get_permalink(); // 注意修改此处的链接地址
    $last_post = $wpdb->get_var("SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1");
    if ((current_time('timestamp') - strtotime($last_post)) < (git_get_option('git_tougao_time') ? git_get_option('git_tougao_time') : 240)) {
        wp_die('您投稿也太勤快了吧，先歇会儿！<a href="' . $current_url . '">点此返回</a>');
    }
    // 表单变量初始化
    $name = isset($_POST['tougao_authorname']) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
    $title = isset($_POST['tougao_title']) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
    $content = isset($_POST['tougao_content']) ? trim(htmlspecialchars($_POST['tougao_content'], ENT_QUOTES)) : '';
    $tomail = git_get_option('git_tougao_mailto');
    // 表单项数据验证
    if (empty($name) || mb_strlen($name) > 20) {
        wp_die('昵称必须填写，且长度不得超过20字。<a href="' . $current_url . '">点此返回</a>');
    }
    if (empty($title) || mb_strlen($title) > 100) {
        wp_die('标题必须填写，且长度不得超过100字。<a href="' . $current_url . '">点此返回</a>');
    }
    if (empty($content) || mb_strlen($content) > 3000 || mb_strlen($content) < 10) {
        wp_die('内容必须填写，且长度不得超过3000字，不得少于100字。<a href="' . $current_url . '">点此返回</a>');
    }
    $post_content = $content . '<br />感谢来自:' . $name . '的投稿';
    $tougao = array(
        'post_title' => $title,
        'post_content' => $post_content
    );
    // 将文章插入数据库
    $status = wp_insert_post($tougao);
    if ($status != 0) {
        // 投稿成功给博主发送邮件
        wp_mail($tomail, "站长，有新投稿！ ", $title, $post_content);
        wp_die('投稿成功！感谢投稿！<a href="' . $current_url . '">点此返回</a>', '投稿成功');
    } else {
        wp_die('投稿失败！<a href="' . $current_url . '">点此返回</a>');
    }
}
get_header();
?>
<div class="pagewrapper clearfix">
<aside class="pagesidebar">
<ul class="pagesider-menu">
<?php
echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'pagemenu', 'echo' => false))));?>
</ul>
</aside>
<div class="pagecontent">
<header class="pageheader clearfix">
<h1 class="pull-left">
<a href="<?php
the_permalink() ?>"><?php
the_title(); ?></a>
</h1>
</header>
<?php
while (have_posts()):
    the_post(); ?>
<div class="article-content">
<?php
    the_content(); ?>
<form class="googlo-tougao" method="post" action="<?php
    echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
<div style="text-align: left; padding-top: 10px;">
<p><label for="tougao_authorname">昵称:*</label></p><input style="width : 98%;" type="text" size="80" value="" id="tougao_authorname" name="tougao_authorname" />
</div>
<div style="text-align: left; padding-top: 10px;">
<p><label for="tougao_title">标题:*</label></p><input style="width : 98%;" type="text" size="80" value="" id="tougao_title" name="tougao_title" />
</div>
<div style="text-align: left; padding-top: 10px;">
<p><label for="tougao_content">内容:*</label></p><textarea style="width : 98%;" name="tougao_content" rows="12" cols=""></textarea>
</div>
<div style="text-align: center; padding-top: 10px;">
<input type="hidden" value="send" name="tougao_form" />
<input class="button" style="width:100px;height:30px;" type="submit" value="提交" /> &nbsp;&nbsp; <input style="width:100px;height:30px;" class="button" type="reset" value="重填" />
</div>
</form>
<br/>
<?php
    comments_template('', false);
endwhile; ?>
</div>
</div>
<?php
get_footer(); ?>