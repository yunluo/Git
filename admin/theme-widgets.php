<?php
error_reporting(E_ALL^E_NOTICE);//镇魔石，镇压一切魑魅魍魉
//Github登录小工具
if(git_get_option('git_github_oauth')){
add_action('widgets_init', 'GitHub_Login_Widgets');
}
function GitHub_Login_Widgets() {
    register_widget('GitHub_Login_Widget');
}
class GitHub_Login_Widget extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_textbanner',
            'description' => '在这里显示一个GitHub登录按钮'
        );
        parent::__construct('Github_login_widget', 'GitHub登录', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $title = apply_filters('widget_name', $instance['title']);
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        echo '<style type="text/css">.githubtn{height:50px;font-weight:bold;font-size:large;margin:50px auto;border-color:#ec7063;border-radius:4px;background-color:#ec7063;background-position:50%;background-size:200% 200%;color:#fff}</style>';
        if (is_user_logged_in()) {?>
                <a href="<?php
            global $wp;
            $current_url = home_url(add_query_arg(array(),$wp->request));
            echo wp_logout_url($current_url); ?>" title="退出登录"><p class="pull-center"><input class="githubtn" type="button" value="退出登录"></p></a>
            <?php
        } else {?>
                <a href="<?php
            echo github_oauth_url(); ?>"><p class="pull-center"><input class="githubtn" type="button" value="使用GitHub登录"></p></a>
            <?php
        }
        echo $after_widget;
    }
    function form($instance) {
?>
<p>
    <label>
        标题：
        <input id="<?php
echo $this->get_field_id('title'); ?>" name="<?php
echo $this->get_field_name('title'); ?>" type="text" value="<?php
echo $instance['title']; ?>" class="widefat" />
    </label>
</p>
        <p>显示一个Github登录按钮，详细设置请至主题后台设置</p>
<?php
    }
}


//广告小工具
add_action('widgets_init', 'git_banners');
function git_banners() {
    register_widget('git_banner');
}
class git_banner extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'git_banner',
            'description' => '显示一个广告(包括富媒体)'
        );
        parent::__construct('git_banner', 'Git-广告', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $code = $instance['code'];
        echo $before_widget;
        echo '<div class="git_banner_inner">' . $code . '</div>';
        echo $after_widget;
    }
    function form($instance) {
?>
        <p>
            <label>
                广告名称：
                <input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                广告代码：
                <textarea id="<?php
        echo $this->get_field_id('code'); ?>" name="<?php
        echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php
        echo $instance['code']; ?></textarea>
            </label>
        </p>
<?php
    }
}
//最新评论小工具
add_action('widgets_init', 'git_comments');
function git_comments() {
    register_widget('git_comment');
}
class git_comment extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_comment',
            'description' => '显示网友最新评论（头像+名称+评论）'
        );
        parent::__construct('git_comment', 'Git-最新评论', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $limit = $instance['limit'];
        $outer = $instance['outer'];
        $outpost = $instance['outpost'];
        $more = $instance['more'];
        $link = $instance['link'];
        $mo = '';
        if ($more != '' && $link != '') $mo = '<a class="btn" target="_blank" href="' . $link . '">' . $more . '</a>';
        echo $before_widget;
        echo $before_title . $mo . $title . $after_title;
        echo '<ul>';
        echo mod_newcomments($limit, $outpost, $outer);
        echo '</ul>';
        echo $after_widget;
    }
    function form($instance) {
?>
        <p>
            <label>
                标题：
                <input class="widefat" id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" />
            </label>
        </p>
        <p>
            <label>
                显示数目：
                <input class="widefat" id="<?php
        echo $this->get_field_id('limit'); ?>" name="<?php
        echo $this->get_field_name('limit'); ?>" type="number" value="<?php
        echo $instance['limit']; ?>" />
            </label>
        </p>
        <p>
            <label>
                排除某用户ID：
                <input class="widefat" id="<?php
        echo $this->get_field_id('outer'); ?>" name="<?php
        echo $this->get_field_name('outer'); ?>" type="number" value="<?php
        echo $instance['outer']; ?>" />
            </label>
        </p>
        <p>
            <label>
                排除某文章ID：
                <input class="widefat" id="<?php
        echo $this->get_field_id('outpost'); ?>" name="<?php
        echo $this->get_field_name('outpost'); ?>" type="text" value="<?php
        echo $instance['outpost']; ?>" />
            </label>
        </p>
        <p>
            <label>
                More 显示文字：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('more'); ?>" name="<?php
        echo $this->get_field_name('more'); ?>" type="text" value="<?php
        echo $instance['more']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                More 链接：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('link'); ?>" name="<?php
        echo $this->get_field_name('link'); ?>" type="url" value="<?php
        echo $instance['link']; ?>" size="24" />
            </label>
        </p>
<?php
    }
}
function mod_newcomments($limit, $outpost, $outer) {
    $comments = get_transient('comments');
    if(false === $comments){
    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_post_ID!='" . $outpost . "' AND user_id!='" . $outer . "' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
    $comments = $wpdb->get_results($sql);
    set_transient('comments', $comments, 60*60*2);//缓存2小时
    }
        $output='';
    foreach ($comments as $comment) {
        $output.= '<li><a target="_blank" href="' . get_permalink($comment->ID) . '#comment-' . $comment->comment_ID . '" title="' . $comment->post_title . '上的评论">' . str_replace(' src=', ' data-original=', get_avatar($comment->comment_author_email, $size = '36', deel_avatar_default())) . ' <div class="muted"><i>' . strip_tags($comment->comment_author) . '</i>' . timeago($comment->comment_date_gmt) . '说：' . str_replace(' src=', ' data-original=', convert_smilies(strip_tags($comment->com_excerpt))) . '</div></a></li>';
    }
    echo $output;
};
//最近文章小工具
add_action('widgets_init', 'git_postlists');
function git_postlists() {
    register_widget('git_postlist');
}
class git_postlist extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_postlist',
            'description' => '图文展示（最新文章+热门文章+随机文章）'
        );
        parent::__construct('git_postlist', 'Git-聚合文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $limit = $instance['limit'];
        $cat = $instance['cat'];
        $orderby = $instance['orderby'];
        $more = $instance['more'];
        $link = $instance['link'];
        $img = $instance['img'];
        $mo = '';
        $style = '';
        if ($more != '' && $link != '') $mo = '<a class="btn" target="_blank" href="' . $link . '">' . $more . '</a>';
        if (!$img) $style = ' class="nopic"';
        echo $before_widget;
        echo $before_title . $mo . $title . $after_title;
        echo '<ul' . $style . '>';
        echo githeme_posts_list($orderby, $limit, $cat, $img);
        echo '</ul>';
        echo $after_widget;
    }
    function form($instance) {
?>
        <p>
            <label>
                标题：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" />
            </label>
        </p>
        <p>
            <label>
                排序：
                <select style="width:100%;" id="<?php
        echo $this->get_field_id('orderby'); ?>" name="<?php
        echo $this->get_field_name('orderby'); ?>" style="width:100%;">
                    <option value="comment_count" <?php
        selected('comment_count', $instance['orderby']); ?>>评论数</option>
                    <option value="date" <?php
        selected('date', $instance['orderby']); ?>>发布时间</option>
                    <option value="rand" <?php
        selected('rand', $instance['orderby']); ?>>随机</option>
                </select>
            </label>
        </p>
        <p>
            <label>
                分类限制：
                <a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的">？</a>
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('cat'); ?>" name="<?php
        echo $this->get_field_name('cat'); ?>" type="text" value="<?php
        echo $instance['cat']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                显示数目：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('limit'); ?>" name="<?php
        echo $this->get_field_name('limit'); ?>" type="number" value="<?php
        echo $instance['limit']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                More 显示文字：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('more'); ?>" name="<?php
        echo $this->get_field_name('more'); ?>" type="text" value="<?php
        echo $instance['more']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                More 链接：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('link'); ?>" name="<?php
        echo $this->get_field_name('link'); ?>" type="url" value="<?php
        echo $instance['link']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                <input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php
        checked($instance['img'], 'on'); ?> id="<?php
        echo $this->get_field_id('img'); ?>" name="<?php
        echo $this->get_field_name('img'); ?>">显示图片
            </label>
        </p>
    <?php
    }
}
function githeme_posts_list($orderby, $limit, $cat, $img) {
        $args = array(
        'order' => 'DESC',
        'cat' => $cat,
        'orderby' => $orderby,
        'showposts' => $limit,
        'ignore_sticky_posts' => 1
        );
    query_posts($args);
    while (have_posts()):
        the_post();
?>
<li>
<a target="_blank" href="<?php
        the_permalink(); ?>" title="<?php
        the_title(); ?>" ><?php
                if (git_get_option('git_qncdn_b')) {
                    if(git_get_option('git_cdnurl_style') ){
                        $githumb1 = '!githumb1.jpg';
                        }else{
                        $githumb1 = '?imageView2/1/w/100/h/64/q/75';
                    }
            if ($img) {
                echo '<span class="thumbnail">';
                echo '<img width="100px" height="64px" src="';
                echo post_thumbnail_src();
                echo ''.$githumb1.'" alt="' . get_the_title() . '" /></span>';
            } else {
                $img = '';
            }
        } else {
            if ($img) {
                echo '<span class="thumbnail">';
                echo '<img width="100px" height="64px" src="' . GIT_URL . '/timthumb.php?src=';
                echo post_thumbnail_src();
                echo '&h=64&w=100&q=90&zc=1&ct=1" alt="' . get_the_title() . '" /></span>';
            } else {
                $img = '';
            }
        } ?><span class="text"><?php
        the_title(); ?></span><span class="muted"><?php
        the_time('Y-m-d'); ?></span><span class="muted"><?php
        comments_number('0', '1评论', '%评论'); ?></span></a>
</li>
<?php
    endwhile;
    wp_reset_query();
}
//最近访客小工具
add_action('widgets_init', 'git_readers');
function git_readers() {
    register_widget('git_reader');
}
class git_reader extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_reader',
            'description' => '显示近期评论频繁的网友头像等'
        );
        parent::__construct('git_reader', 'Git-活跃读者', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $limit = $instance['limit'];
        $outer = $instance['outer'];
        $timer = $instance['timer'];
        $addlink = $instance['addlink'];
        $more = $instance['more'];
        $link = $instance['link'];
        $mo = '';
        if ($more != '' && $link != '') $mo = '<a class="btn" target="_blank" href="' . $link . '">' . $more . '</a>';
        echo $before_widget;
        echo $before_title . $mo . $title . $after_title;
        echo '<ul>';
        echo githeme_readers($out = $outer, $tim = $timer, $lim = $limit, $addlink);;
        echo '</ul>';
        echo $after_widget;
    }
    function form($instance) {
?>
        <p>
            <label>
                标题：
                <input class="widefat" id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" />
            </label>
        </p>
        <p>
            <label>
                显示数目：
                <input class="widefat" id="<?php
        echo $this->get_field_id('limit'); ?>" name="<?php
        echo $this->get_field_name('limit'); ?>" type="number" value="<?php
        echo $instance['limit']; ?>" />
            </label>
        </p>
        <p>
            <label>
                排除某人：
                <input class="widefat" id="<?php
        echo $this->get_field_id('outer'); ?>" name="<?php
        echo $this->get_field_name('outer'); ?>" type="text" value="<?php
        echo $instance['outer']; ?>" />
            </label>
        </p>
        <p>
            <label>
                几天内：
                <input class="widefat" id="<?php
        echo $this->get_field_id('timer'); ?>" name="<?php
        echo $this->get_field_name('timer'); ?>" type="number" value="<?php
        echo $instance['timer']; ?>" />
            </label>
        </p>
        <p>
            <label>
                <input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php
        checked($instance['addlink'], 'on'); ?> id="<?php
        echo $this->get_field_id('addlink'); ?>" name="<?php
        echo $this->get_field_name('addlink'); ?>">加链接
            </label>
        </p>
        <p>
            <label>
                More 显示文字：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('more'); ?>" name="<?php
        echo $this->get_field_name('more'); ?>" type="text" value="<?php
        echo $instance['more']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                More 链接：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('link'); ?>" name="<?php
        echo $this->get_field_name('link'); ?>" type="url" value="<?php
        echo $instance['link']; ?>" size="24" />
            </label>
        </p>

<?php
    }
}
/*
 * 读者墙
 * githeme_readers( $outer='name', $timer='3', $limit='14' );
 * $outer 不显示某人
 * $timer 几个月时间内
 * $limit 显示条数
*/
function githeme_readers($out, $tim, $lim, $addlink) {
    global $wpdb;
    $counts = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $tim day ) and user_id='0' and comment_author != '" . $out . "' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author order by cnt desc limit $lim");
    foreach ($counts as $count) {
        $c_url = $count->comment_author_url;
        if ($c_url == '') $c_url = 'javascript:;';
        if ($addlink == 'on') {
            $c_urllink = ' href="' . $c_url . '"';
        } else {
            $c_urllink = '';
        }
        $type.= '<li><a title="[' . $count->comment_author . '] 近期点评' . $count->cnt . '次" target="_blank"' . $c_urllink . '>' . get_avatar($count->comment_author_email, $size = '48', deel_avatar_default()) . '</a></li>';
    }
    echo $type;
}
//彩色推荐模块
add_action('widgets_init', 'git_recs');
function git_recs() {
    register_widget('git_rec');
}
class git_rec extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_rec',
            'description' => '五个推荐块'
        );
        parent::__construct('git_rec', 'Git-推荐模块', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $atitle1 = $instance['atitle1'];
        $alink1 = $instance['alink1'];
        $aclass01 = $instance['aclass1'];
        $atitle2 = $instance['atitle2'];
        $alink2 = $instance['alink2'];
        $aclass02 = $instance['aclass2'];
        $atitle3 = $instance['atitle3'];
        $alink3 = $instance['alink3'];
        $aclass03 = $instance['aclass3'];
        $atitle4 = $instance['atitle4'];
        $alink4 = $instance['alink4'];
        $aclass04 = $instance['aclass4'];
        $atitle5 = $instance['atitle5'];
        $alink5 = $instance['alink5'];
        $aclass05 = $instance['aclass5'];
        echo $before_widget;
        echo '<a target="_blank" class="' . $aclass01 . '" href="' . $alink1 . '" title="' . $atitle1 . '" >' . $atitle1 . '</a>';
        echo '<a target="_blank" class="' . $aclass02 . '" href="' . $alink2 . '" title="' . $atitle2 . '" >' . $atitle2 . '</a>';
        echo '<a target="_blank" class="' . $aclass03 . '" href="' . $alink3 . '" title="' . $atitle3 . '" >' . $atitle3 . '</a>';
        echo '<a target="_blank" class="' . $aclass04 . '" href="' . $alink4 . '" title="' . $atitle4 . '" >' . $atitle4 . '</a>';
        echo '<a target="_blank" class="' . $aclass05 . '" href="' . $alink5 . '" title="' . $atitle5 . '" >' . $atitle5 . '</a>';
        echo $after_widget;
    }
    function form($instance) {
?>
<?php
for ($x=1; $x<=5; $x++) {
  ?>
  <p>
      <label>
          第<?php echo $x;?>组文字：<input style="width:200px;" id="<?php
  echo $this->get_field_id('atitle'.$x); ?>" name="<?php
  echo $this->get_field_name('atitle'.$x); ?>" type="text" value="<?php
  echo $instance['atitle'.$x]; ?>" />
      </label>
  </p>
  <p>
      <label>
          第<?php echo $x;?>组链接：<input style="width:200px;" id="<?php
  echo $this->get_field_id('alink'.$x); ?>" name="<?php
  echo $this->get_field_name('alink'.$x); ?>" type="url" value="<?php
  echo $instance['alink'.$x]; ?>" />
      </label>
  </p>
  <p>
      <label>
          第<?php echo $x;?>组样式：<select style="width:200px;" id="<?php
  echo $this->get_field_id('aclass'.$x); ?>" name="<?php
  echo $this->get_field_name('aclass'.$x); ?>" >
              <option value="aclass01" <?php
  selected('aclass01', $instance['aclass'.$x]); ?>>黑色</option>
              <option value="aclass02" <?php
  selected('aclass02', $instance['aclass'.$x]); ?>>蓝色</option>
              <option value="aclass03" <?php
  selected('aclass03', $instance['aclass'.$x]); ?>>红色</option>
              <option value="aclass04" <?php
  selected('aclass04', $instance['aclass'.$x]); ?>>黄色</option>
              <option value="aclass05" <?php
  selected('aclass05', $instance['aclass'.$x]); ?>>绿色</option>
          </select>
      </label>
  </p><hr />

<?php
}
?>

<?php
    }
}
//幻灯片模块小工具
add_action('widgets_init', 'git_slicks');
function git_slicks() {
    register_widget('git_slick');
}
class git_slick extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_slick',
            'description' => '带箭头的小幻灯片'
        );
        parent::__construct('git_slick', 'Git-幻灯片(风格二)', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $simg1 = $instance['simg1'];
        $slink1 = $instance['slink1'];
        $stitle1 = $instance['stitle1'];
        $simg2 = $instance['simg2'];
        $slink2 = $instance['slink2'];
        $stitle2 = $instance['stitle2'];
        $simg3 = $instance['simg3'];
        $slink3 = $instance['slink3'];
        $stitle3 = $instance['stitle3'];
        $simg4 = $instance['simg4'];
        $slink4 = $instance['slink4'];
        $stitle4 = $instance['stitle4'];
        echo $before_widget;
        echo '<div class="slick" style="height:200px">';
        echo '<div><a target="_blank" href="' . $slink1.'" title="' . $stitle1 . '" ><img alt="' . $stitle1 . '" width="360" height="200" src="' . $simg1 . '" ></a></div>';
        echo '<div><a target="_blank" href="' . $slink2 . '" title="' . $stitle2 . '" ><img alt="' . $stitle2 . '" width="360" height="200" src="' . $simg2 . '" ></a></div>';
        echo '<div><a target="_blank" href="' . $slink3 . '" title="' . $stitle3 . '" ><img alt="' . $stitle3 . '" width="360" height="200" src="' . $simg3 . '" ></a></div>';
        echo '<div><a target="_blank" href="' . $slink4 . '" title="' . $stitle4 . '" ><img alt="' . $stitle4 . '" width="360" height="200" src="' . $simg4 . '" ></a></div>';
        echo '</div>';
        echo $after_widget;
    }
    function form($instance) {
?>
<?php
for ($x=1; $x<=4; $x++) {
  ?>
        <p>
            <label>
                幻灯<?php echo $x;?>图片：<span class="git_tip">360×200</span>
                <input id="<?php
        echo $this->get_field_id('simg'.$x); ?>" name="<?php
        echo $this->get_field_name('simg'.$x); ?>" type="text" value="<?php
        echo $instance['simg'.$x]; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                幻灯<?php echo $x;?>链接：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('slink'.$x); ?>" name="<?php
        echo $this->get_field_name('slink'.$x); ?>" type="url" value="<?php
        echo $instance['slink'.$x]; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                幻灯<?php echo $x;?>标题：
                <input id="<?php
        echo $this->get_field_id('stitle'.$x); ?>" name="<?php
        echo $this->get_field_name('stitle'.$x); ?>" type="text" value="<?php
        echo $instance['stitle'.$x]; ?>" class="widefat" />
            </label>
        </p><hr />
<?php
}
?>

<?php
    }
}
//另一个幻灯片小工具
add_action('widgets_init', 'git_slides');
function git_slides() {
    register_widget('git_slide');
}
class git_slide extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_slide',
            'description' => '无箭头小幻灯片'
        );
        parent::__construct('git_slide', 'Git-幻灯片(风格一)', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $img1 = $instance['img1'];
        $link1 = $instance['link1'];
        $ttitle1 = $instance['ttitle1'];
        $img2 = $instance['img2'];
        $link2 = $instance['link2'];
        $ttitle2 = $instance['ttitle2'];
        $img3 = $instance['img3'];
        $link3 = $instance['link3'];
        $ttitle3 = $instance['ttitle3'];
        $img4 = $instance['img4'];
        $link4 = $instance['link4'];
        $ttitle4 = $instance['ttitle4'];
        echo $before_widget;
        echo '<div id="wowslider-container1"><div class="ws_images"><ul>';
        echo '<li><a target="_blank" href="' . $link1 . '" title="' . $ttitle1 . '" ><img width="360" height="149" alt="' . $ttitle1 . '" src="' . $img1 . '" ></a></li>';
        echo '<li><a target="_blank" href="' . $link2 . '" title="' . $ttitle2 . '" ><img width="360" height="149" alt="' . $ttitle2 . '" src="' . $img2 . '" ></a></li>';
        echo '<li><a target="_blank" href="' . $link3 . '" title="' . $ttitle3 . '" ><img width="360" height="149" alt="' . $ttitle3 . '" src="' . $img3 . '" ></a></li>';
        echo '<li><a target="_blank" href="' . $link4 . '" title="' . $ttitle4 . '" ><img width="360" height="149" alt="' . $ttitle4 . '" src="' . $img4 . '" ></a></li>';
        echo '</ul></div></div>';
        echo $after_widget;
    }
    function form($instance) {
?>
<?php
for ($x=1; $x<=4; $x++) {
  ?>
        <p>
            <label>
                幻灯<?php echo $x;?>图片：<span class="git_tip">360×149</span>
                <input id="<?php
        echo $this->get_field_id('img'.$x); ?>" name="<?php
        echo $this->get_field_name('img'.$x); ?>" type="text" value="<?php
        echo $instance['img'.$x]; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                幻灯<?php echo $x;?>链接：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('link'.$x); ?>" name="<?php
        echo $this->get_field_name('link'.$x); ?>" type="url" value="<?php
        echo $instance['link'.$x]; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                幻灯<?php echo $x;?>标题：
                <input id="<?php
        echo $this->get_field_id('ttitle'.$x); ?>" name="<?php
        echo $this->get_field_name('ttitle'.$x); ?>" type="text" value="<?php
        echo $instance['ttitle'.$x]; ?>" class="widefat" />
            </label>
        </p><hr />
        <?php
        }
        ?>
<?php
    }
}
//社交网站按钮小工具
add_action('widgets_init', 'git_socials');
function git_socials() {
    register_widget('git_social');
}
class git_social extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_social',
            'description' => '在这里显示国内常用的社交网站按钮'
        );
        parent::__construct('git_social', 'Git-社交按钮', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        echo $before_widget;
        echo '<div class="widget widget_text"><div class="textwidget"><div class="social">';
        if (git_get_option('git_weibo')) echo '<a href="' . git_get_option('git_weibo') . '" rel="external nofollow" title="新浪微博" target="_blank"><i class="sinaweibo fa fa-weibo"></i></a>';
        if (git_get_option('git_customicon_name')) echo '<a  href="' . git_get_option('git_customicon_url') . '" rel="external nofollow" title="' . git_get_option('git_customicon_name') . '" target="_blank"><i class="customicon fa ' . git_get_option('git_customicon_icon') . '"></i></a>';
        if (git_get_option('git_weixin')) echo '<a class="weixin"><i class="weixins fa fa-weixin"></i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">订阅号“' . git_get_option('git_weixin') . '”</div><div class="popover-content"><img width="200px" height="200px" src="' . git_get_option('git_weixin_qr') . '" ></div></div></div></a>';
        if (git_get_option('git_pay')) echo '<a class="weixin"><i class="pay fa fa-alipay"></i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">支付宝“' . git_get_option('git_pay') . '”</div><div class="popover-content"><img src="' . git_get_option('git_pay_qr') . '" ></div></div></div></a>';
        if (git_get_option('git_emailContact')) echo '<a href="' . git_get_option('git_emailContact') . '" rel="external nofollow" title="Email" target="_blank"><i class="email fa fa-envelope-o"></i></a>';
        if (git_get_option('git_qqContact')) echo '<a href="tencent://message/?uin=' . git_get_option('git_qqContact') . '&Site=&Menu=yes " rel="external nofollow" title="联系QQ" target="_blank"><i class="qq fa fa-qq"></i></a>';
        if (git_get_option('git_rss')) echo '<a href="' . git_get_option('git_rss') . '" rel="external nofollow" target="_blank"  title="订阅本站"><i class="rss fa fa-rss"></i></a>';
        echo '</div></div></div>';
        echo $after_widget;
    }
    function form($instance) {
?>
        <p>显示一组社交图标，详细设置请至主题后台设置</p>
<?php
    }
}
//邮箱订阅小工具
add_action('widgets_init', 'git_subscribes');
function git_subscribes() {
    register_widget('git_subscribe');
}
class git_subscribe extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_subscribe',
            'description' => '显示邮箱订阅组件'
        );
        parent::__construct('git_subscribe', 'Git-邮箱订阅', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = (!empty($instance['title'])) ? $instance['title'] : '邮件订阅';
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $nid = empty($instance['nid']) ? '' : $instance['nid'];
        $info = empty($instance['info']) ? '订阅精彩内容' : $instance['info'];
        $placeholder = empty($instance['placeholder']) ? 'your@email.com' : $instance['placeholder'];
        $output.= $before_widget;
        if ($title) $output.= $before_title . $title . $after_title;
        $output.= '<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post">' . '<p>' . $info . '</p>' . '<input type="hidden" name="t" value="qf_booked_feedback" /><input type="hidden" name="id" value="' . $nid . '" />' . '<input type="email" name="to" class="rsstxt" placeholder="' . $placeholder . '" value="" required /><input type="submit" class="rssbutton" value="订阅" />' . '</form>';
        $output.= $after_widget;
        echo $output;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['nid'] = strip_tags($new_instance['nid']);
        $instance['info'] = strip_tags($new_instance['info']);
        $instance['placeholder'] = strip_tags($new_instance['placeholder']);
        return $instance;
    }
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $nid = esc_attr($instance['nid']);
        $info = esc_attr($instance['info']);
        $placeholder = esc_attr($instance['placeholder']);
?>
        <p><label for="<?php
        echo $this->get_field_id('title'); ?>">标题</label>
        <input class="widefat" id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $title; ?>" /></p>

        <p><label for="<?php
        echo $this->get_field_id('nid'); ?>">nId：</label>
        <input class="widefat" id="<?php
        echo $this->get_field_id('nid'); ?>" name="<?php
        echo $this->get_field_name('nid'); ?>" type="text" value="<?php
        echo $nid; ?>" /></p>

        <p><label for="<?php
        echo $this->get_field_id('info'); ?>">提示文字：</label>
        <input class="widefat" id="<?php
        echo $this->get_field_id('info'); ?>" name="<?php
        echo $this->get_field_name('info'); ?>" type="text" value="<?php
        echo $info; ?>" /></p>

        <p><label for="<?php
        echo $this->get_field_id('placeholder'); ?>">占位文字：</label>
        <input class="widefat" id="<?php
        echo $this->get_field_id('placeholder'); ?>" name="<?php
        echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php
        echo $placeholder; ?>" /></p>

        <p class="description">本工具基于 <a href="http://list.qq.com/" target="_blank">QQ邮件列表</a> 服务。</p>
<?php
    }
}
//彩色标签云小工具
add_action('widgets_init', 'git_tags');
function git_tags() {
    register_widget('git_tag');
}
class git_tag extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_tag',
            'description' => '显示热门标签'
        );
        parent::__construct('git_tag', 'Git-标签云', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $count = $instance['count'];
        $offset = $instance['offset'];
        $more = $instance['more'];
        $link = $instance['link'];
        $mo = '';
        if ($more != '' && $link != '') $mo = '<a class="btn" target="_blank" href="' . $link . '">' . $more . '</a>';
        echo $before_widget;
        echo $before_title . $mo . $title . $after_title;
        echo '<div class="git_tags">';
        $tags_list = get_tags('orderby=count&order=DESC&number=' . $count . '&offset=' . $offset);
        if ($tags_list) {
            foreach ($tags_list as $tag) {
                echo '<a title="' . $tag->count . '个话题" target="_blank" href="' . get_tag_link($tag) . '">' . $tag->name . ' (' . $tag->count . ')</a>';
            }
        } else {
            echo '暂无标签！';
        }
        echo '</div>';
        echo $after_widget;
    }
    function form($instance) {
?>
        <p>
            <label>
                名称：
                <input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                显示数量：
                <input id="<?php
        echo $this->get_field_id('count'); ?>" name="<?php
        echo $this->get_field_name('count'); ?>" type="number" value="<?php
        echo $instance['count']; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                去除前几个：
                <input id="<?php
        echo $this->get_field_id('offset'); ?>" name="<?php
        echo $this->get_field_name('offset'); ?>" type="number" value="<?php
        echo $instance['offset']; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                More 显示文字：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('more'); ?>" name="<?php
        echo $this->get_field_name('more'); ?>" type="text" value="<?php
        echo $instance['more']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                More 链接：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('link'); ?>" name="<?php
        echo $this->get_field_name('link'); ?>" type="url" value="<?php
        echo $instance['link']; ?>" size="24" />
            </label>
        </p>
<?php
    }
}
//特别推荐小工具
add_action('widgets_init', 'git_textbanners');
function git_textbanners() {
    register_widget('git_textbanner');
}
class git_textbanner extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_textbanner',
            'description' => '显示一个文本特别推荐'
        );
        parent::__construct('git_textbanner', 'Git-特别推荐', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $tag = $instance['tag'];
        $content = $instance['content'];
        $link = $instance['link'];
        $style = $instance['style'];
        $blank = $instance['blank'];
        $lank = '';
        if ($blank) $lank = ' target="_blank"';
        echo $before_widget;
        echo '<a class="' . $style . '" href="' . $link . '"' . $lank . '>';
        echo '<div class="title"><h2>' . $tag . '</h2></div>';
        echo '<h3>' . $title . '</h3>';
        echo '<p>' . $content . '</p>';
        echo '</a>';
        echo $after_widget;
    }
    function form($instance) {
?>
        <p>
            <label>
                名称：
                <input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                描述：
                <textarea id="<?php
        echo $this->get_field_id('content'); ?>" name="<?php
        echo $this->get_field_name('content'); ?>" class="widefat" rows="3"><?php
        echo $instance['content']; ?></textarea>
            </label>
        </p>
        <p>
            <label>
                标签：
                <input id="<?php
        echo $this->get_field_id('tag'); ?>" name="<?php
        echo $this->get_field_name('tag'); ?>" type="text" value="<?php
        echo $instance['tag']; ?>" class="widefat" />
            </label>
        </p>
        <p>
            <label>
                链接：
                <input style="width:100%;" id="<?php
        echo $this->get_field_id('link'); ?>" name="<?php
        echo $this->get_field_name('link'); ?>" type="url" value="<?php
        echo $instance['link']; ?>" size="24" />
            </label>
        </p>
        <p>
            <label>
                样式：
                <select style="width:100%;" id="<?php
        echo $this->get_field_id('style'); ?>" name="<?php
        echo $this->get_field_name('style'); ?>" style="width:100%;">
                    <option value="style01" <?php
        selected('style01', $instance['style']); ?>>蓝色</option>
                    <option value="style02" <?php
        selected('style02', $instance['style']); ?>>橘红色</option>
                    <option value="style03" <?php
        selected('style03', $instance['style']); ?>>绿色</option>
                    <option value="style04" <?php
        selected('style04', $instance['style']); ?>>紫色</option>
                    <option value="style05" <?php
        selected('style05', $instance['style']); ?>>青色</option>
                </select>
            </label>
        </p>
        <p>
            <label>
                <input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php
        checked($instance['blank'], 'on'); ?> id="<?php
        echo $this->get_field_id('blank'); ?>" name="<?php
        echo $this->get_field_name('blank'); ?>">新打开浏览器窗口
            </label>
        </p>
<?php
    }
}
//网站统计小工具
function git_tongji() {
    register_widget('git_tongji');
}
add_action('widgets_init', 'git_tongji');
class git_tongji extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'git_tongji',
            'description' => '显示网站的统计信息'
        );
        parent::__construct(false, 'Git-网站统计', $widget_ops);
    }
    function form($instance) {
        $instance = wp_parse_args((array)$instance, array(
            'title' => '网站统计',
            'establish_time' => '2014-08-01'
        ));
        $title = htmlspecialchars($instance['title']);
        $establish_time = htmlspecialchars($instance['establish_time']);
        $output = '<table>';
        $output.= '<tr><td>标题</td><td>';
        $output.= '<input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $instance['title'] . '" />';
        $output.= '</td></tr><tr><td>建站日期：</td><td>';
        $output.= '<input id="' . $this->get_field_id('establish_time') . '" name="' . $this->get_field_name('establish_time') . '" type="text" value="' . $instance['establish_time'] . '" />';
        $output.= '</td></tr></table>';
        echo $output;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['establish_time'] = strip_tags(stripslashes($new_instance['establish_time']));
        return $instance;
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $establish_time = empty($instance['establish_time']) ? '2013-01-27' : $instance['establish_time'];
        echo $before_widget;
        echo $before_title . $title . $after_title;
        echo '<div class="tongji" ><ul>';
        $this->efan_get_blogstat($establish_time);
        echo '</ul></div>';
        echo $after_widget;
    }
    function efan_get_blogstat($establish_time /*, $instance */) {
        global $wpdb;
        $count_posts = wp_count_posts();
        $published_posts = $count_posts->publish;
        $draft_posts = $count_posts->draft;
        $comments_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");
        $time = floor((time() - strtotime($establish_time)) / 86400);
        $count_tags = wp_count_terms('post_tag');
        $count_pages = wp_count_posts('page');
        $page_posts = $count_pages->publish;
        $count_categories = wp_count_terms('category');
        $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'");
        $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
        $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
        $last = date('Y-n-j', strtotime($last[0]->MAX_m));
        $output = '<li>文章总数：';
        $output.= $published_posts;
        $output.= ' 篇</li>';
        $output.= '<li>评论数目：';
        $output.= $comments_count;
        $output.= ' 条</li>';
        $output.= '<li>建站日期：';
        $output.= $establish_time;
        $output.= '</li>';
        $output.= '<li>运行天数：';
        $output.= $time;
        $output.= ' 天</li>';
        $output.= '<li>标签总数：';
        $output.= $count_tags;
        $output.= ' 个</li>';
        if (is_user_logged_in()) {
            $output.= '<li>页面总数：';
            $output.= $page_posts;
            $output.= ' 个</li>';
            $output.= '<li>分类总数：';
            $output.= $count_categories;
            $output.= ' 个</li>';
            $output.= '<li>友链总数：';
            $output.= $link;
            $output.= ' 个</li>';
        }
        if (get_option("users_can_register") == 1) {
            $output.= '<li>用户总数：';
            $output.= $users;
            $output.= ' 个</li>';
        }
        $output.= '<li>最后更新：';
        $output.= $last;
        $output.= '</li>';
        echo $output;
    }
}
?>