<?php


//去除头部冗余代码
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2, 1);
remove_action('wp_head', 'rsd_link'); //移除离线编辑器开放接口
remove_action('wp_head', 'wlwmanifest_link'); //移除离线编辑器开放接口
remove_action('wp_head', 'index_rel_link'); //本页链接
remove_action('wp_head', 'parent_post_rel_link'); //清除前后文信息
remove_action('wp_head', 'start_post_rel_link'); //清除前后文信息
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'rel_canonical'); //本页链接
remove_action('wp_head', 'wp_generator'); //移除WordPress版本号
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); //本页短链接
add_filter('xmlrpc_enabled', '__return_false');
add_filter('embed_oembed_discover', '__return_false');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);

//阻止站内PingBack
function deel_noself_ping(&$links) {
    $home = home_url();
    foreach ($links as $l => $link) if (0 === strpos($link, $home)) unset($links[$l]);
}
if (git_get_option('git_pingback_b')){
    add_action('pre_ping', 'deel_noself_ping');
}

//移除自动保存和修订版本
if (git_get_option('git_autosave_b')) {
    add_action('wp_print_scripts', 'disable_autosave');
    function disable_autosave() {
        wp_deregister_script('autosave');
    }
    add_filter('wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2);
    function specs_wp_revisions_to_keep($num, $post) {
        return 0;
    }
}

// 屏蔽 REST API
if (git_get_option('git_restapi_b')) {
function git_disable_rest_api($access){
    return new WP_Error('rest_cannot_acess', '无访问权限', array('status' => 403));
}
add_filter('rest_authentication_errors', 'git_disable_rest_api');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);
}
//禁止 s.w.org
function git_remove_dns_prefetch($hints, $relation_type) {
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts() , $hints);
    }
    return $hints;
}
add_filter('wp_resource_hints', 'git_remove_dns_prefetch', 10, 2);

//禁用WordPress活动
function git_dweandw_remove() {
    remove_meta_box('dashboard_primary', get_current_screen() , 'side');
}
add_action('wp_network_dashboard_setup', 'git_dweandw_remove', 20);
add_action('wp_user_dashboard_setup', 'git_dweandw_remove', 20);
add_action('wp_dashboard_setup', 'git_dweandw_remove', 20);

//禁用谷歌字体
function git_remove_open_sans() {
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}
add_action('init', 'git_remove_open_sans');

//免插件去除Category
if (git_get_option('git_categroy_b')):
    add_action('load-themes.php', 'no_category_base_refresh_rules');
    add_action('created_category', 'no_category_base_refresh_rules');
    add_action('edited_category', 'no_category_base_refresh_rules');
    add_action('delete_category', 'no_category_base_refresh_rules');
    function no_category_base_refresh_rules() {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }
    add_action('init', 'no_category_base_permastruct');
    function no_category_base_permastruct() {
        global $wp_rewrite;
        $wp_rewrite->extra_permastructs['category']['struct'] = '%category%';
    }
    add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
    function no_category_base_rewrite_rules($category_rewrite) {
        $category_rewrite = array();
        $categories = get_categories(array(
            'hide_empty' => false
        ));
        foreach ($categories as $category) {
            $category_nicename = $category->slug;
            if ($category->parent == $category->cat_ID) // recursive recursion
            $category->parent = 0;
            elseif ($category->parent != 0) $category_nicename = get_category_parents($category->parent, false, '/', true) . $category_nicename;
            $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
        }
        global $wp_rewrite;
        $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
        $old_category_base = trim($old_category_base, '/');
        $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';
        return $category_rewrite;
    }
    add_filter('query_vars', 'no_category_base_query_vars');
    function no_category_base_query_vars($public_query_vars) {
        $public_query_vars[] = 'category_redirect';
        return $public_query_vars;
    }
    add_filter('request', 'no_category_base_request');
    function no_category_base_request($query_vars) {
        if (isset($query_vars['category_redirect'])) {
            $catlink = trailingslashit(home_url()) . user_trailingslashit($query_vars['category_redirect'], 'category');
            status_header(301);
            header("Location: $catlink");
            exit();
        }
        return $query_vars;
    }
endif;

//禁用响应式图片
function msiw(){
	return 1;
}
add_filter('max_srcset_image_width', 'msiw');

//移除默认的图片宽度以及高度
function remove_wps_width($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'remove_wps_width', 10);
add_filter('image_send_to_editor', 'remove_wps_width', 10);

//取消后台登陆错误的抖动提示
function git_wps_login_error() {
    remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'git_wps_login_error');

//取消静态资源的版本查询
if (git_get_option('git_query')) {
    function _remove_script_version($src){
        $parts = explode('?ver', $src);
        return $parts[0];
    }
    add_filter('script_loader_src', '_remove_script_version', 15, 1);
    add_filter('style_loader_src', '_remove_script_version', 15, 1);
}

//禁用新版编辑器
add_filter('use_block_editor_for_post', '__return_false');
remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

//屏蔽顶部工具栏
add_filter('show_admin_bar', '__return_false');

//清除wp_footer带入的embed.min.js
function git_deregister_embed_script() {
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'git_deregister_embed_script');

//新标签打开顶部网站链接
function blank_my_site_bar( $wp_admin_bar ) {
    $node = $wp_admin_bar->get_node('view-site');
    $node->meta['target'] = '_blank';
    $wp_admin_bar->add_node($node);
}
add_action( 'admin_bar_menu', 'blank_my_site_bar', 80 );

function lhu(){
	return home_url();
}
add_filter('login_headerurl', 'lhu');
function lht(){
	return get_bloginfo('name');
}
add_filter('login_headertitle', 'lht');

//固化插入图片选项
function git_attachment_display_settings() {
    update_option('image_default_align', 'center'); //居中显示
    update_option('image_default_link_type', 'file'); //连接到媒体文件本身
    update_option('image_default_size', 'full'); //完整尺寸
}
add_action('after_setup_theme', 'git_attachment_display_settings');

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

//使链接自动可点击
add_filter('the_content', 'make_clickable');

//临时修复文件删除漏洞
function git_rips_unlink_tempfix( $data ) {
    if( isset($data['thumb']) ) {
        $data['thumb'] = basename($data['thumb']);
    }
    return $data;
}
add_filter( 'wp_update_attachment_metadata', 'git_rips_unlink_tempfix' );

//自动中英文空格
if (git_get_option('git_auto_kg')) {
    function content_autospace($data){
        $data = preg_replace('/([\\x{4e00}-\\x{9fa5}]+)([A-Za-z0-9_]+)/u', '${1} ${2}', $data);
        $data = preg_replace('/([A-Za-z0-9_]+)([\\x{4e00}-\\x{9fa5}]+)/u', '${1} ${2}', $data);
        return $data;
    }
    add_filter('the_content', 'content_autospace');
}

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

/*
修复4.2表情bug
下面代码来自：http://www.9sep.org/remove-emoji-in-wordpress
*/
function disable_emoji9s_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array(
            'wpemoji'
        ));
    } else {
        return array();
    }
}
//取当前主题下img\smilies\下表情图片路径
function custom_gitsmilie_src($old, $img) {
    return GIT_URL . '/assets/img/smilies/' . $img;
}
function init_gitsmilie() {
    global $wpsmiliestrans;
    //默认表情文本与表情图片的对应关系(可自定义修改)
    $wpsmiliestrans = array(
        ':mrgreen:' => 'icon_mrgreen.gif',
        ':neutral:' => 'icon_neutral.gif',
        ':twisted:' => 'icon_twisted.gif',
        ':arrow:' => 'icon_arrow.gif',
        ':shock:' => 'icon_eek.gif',
        ':smile:' => 'icon_smile.gif',
        ':???:' => 'icon_confused.gif',
        ':cool:' => 'icon_cool.gif',
        ':evil:' => 'icon_evil.gif',
        ':grin:' => 'icon_biggrin.gif',
        ':idea:' => 'icon_idea.gif',
        ':oops:' => 'icon_redface.gif',
        ':razz:' => 'icon_razz.gif',
        ':roll:' => 'icon_rolleyes.gif',
        ':wink:' => 'icon_wink.gif',
        ':cry:' => 'icon_cry.gif',
        ':eek:' => 'icon_surprised.gif',
        ':lol:' => 'icon_lol.gif',
        ':mad:' => 'icon_mad.gif',
        ':sad:' => 'icon_sad.gif',
        '8-)' => 'icon_cool.gif',
        '8-O' => 'icon_eek.gif',
        ':-(' => 'icon_sad.gif',
        ':-)' => 'icon_smile.gif',
        ':-?' => 'icon_confused.gif',
        ':-D' => 'icon_biggrin.gif',
        ':-P' => 'icon_razz.gif',
        ':-o' => 'icon_surprised.gif',
        ':-x' => 'icon_mad.gif',
        ':-|' => 'icon_neutral.gif',
        ';-)' => 'icon_wink.gif',
        '8O' => 'icon_eek.gif',
        ':(' => 'icon_sad.gif',
        ':)' => 'icon_smile.gif',
        ':?' => 'icon_confused.gif',
        ':D' => 'icon_biggrin.gif',
        ':P' => 'icon_razz.gif',
        ':o' => 'icon_surprised.gif',
        ':x' => 'icon_mad.gif',
        ':|' => 'icon_neutral.gif',
        ';)' => 'icon_wink.gif',
        ':!:' => 'icon_exclaim.gif',
        ':?:' => 'icon_question.gif',
    );
    //移除WordPress4.2版本更新所带来的Emoji钩子同时挂上主题自带的表情路径
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emoji9s_tinymce');
    add_filter('smilies_src', 'custom_gitsmilie_src', 10, 2);
}
add_action('init', 'init_gitsmilie', 5);

//分类，标签描述添加图片
remove_filter('pre_term_description', 'wp_filter_kses');
remove_filter('pre_link_description', 'wp_filter_kses');
remove_filter('pre_link_notes', 'wp_filter_kses');
remove_filter('term_description', 'wp_kses_data');

// 友情链接扩展
add_filter('pre_option_link_manager_enabled', '__return_true');