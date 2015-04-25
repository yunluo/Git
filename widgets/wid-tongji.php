<?php
function git_tongji() {
    register_widget('git_tongji');
}
add_action('widgets_init', 'git_tongji');
class git_tongji extends WP_Widget {
    function git_tongji() {
        $widget_ops = array(
            'classname' => 'git_tongji',
            'description' => '显示博客的统计信息'
        );
        $this->WP_Widget(false, 'Git-博客统计', $widget_ops);
    }
    function form($instance) {
        $instance = wp_parse_args((array)$instance, array(
            'title' => '博客统计',
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
        $output = '<li>日志总数：';
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
            $output.= '<li>草稿数目：';
            $output.= $draft_posts;
            $output.= ' 篇</li>';
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