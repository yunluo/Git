<?php
$themename = 'G+主题';
$options = array(
      "d_footercode", "d_footercode_b", "d_slick1url_b", "d_slick2url_b", "d_slick3url_b", "d_slick4url_b", "d_slick5url_b", "d_slick6url_b", "d_slick1img_b", "d_slick2img_b", "d_slick3img_b", "d_slick4img_b", "d_slick5img_b", "d_slick6img_b", "d_slick1title_b", "d_slick2title_b", "d_slick3title_b", "d_slick4title_b", "d_slick5title_b", "d_slick6title_b", "d_slick_b", "d_slick1_b", "d_slick2_b", "d_slick3_b", "d_slick4_b", "d_slick5_b", "d_slick6_b", "d_pagehtml_b", "d_mailuser_b", "d_mailpass_b", "d_mailport_b", "d_mailsmtp_b", "d_maildizhi_b", "d_mailnichen_b", "d_stmpmail_b", "d_updates_b", "d_copydialog_b", "d_404ad", "d_404ad_b", "d_copyright_b", "d_customlogo", "d_customlogo_b", "d_customhead", "d_customhead_b", "d_piclogo_b", "d_pay_qr", "d_pay", "d_pay_b", "d_weixin_qr", "d_cdnurl_b", "d_qiniucdn_b", "d_wbpasd_b", "d_wbapky_b", "d_wbuser_b", "d_blockcat_b", "d_blockcat_2", "d_blockcat_1", "d_avatar_qn", "d_avatar_ds", "d_avatar_ssl", "d_superfoot_b", "d_foottitle1", "d_foottitle2", "d_foottitle3", "d_foottitle4", "d_footconent1", "d_footconent2", "d_footconent3", "d_footconent4", "d_copy_b", "d_qr_b", "d_snow_b", "d_baidurecord_b", "d_sinasync_b", "d_sj404_b", "d_darkhighlight_b", "d_cat_7", "d_cat_6", "d_cat_5", "d_cat_4", "d_cat_3", "d_cat_2", "d_cat_1", "d_blog_b", "d_cms_b", "d_singlecode_b", "d_singlecode", "d_yellow_b", "d_purple_b", "d_black_b", "d_blue_b", "d_red_b", "d_avataer_b", "d_pichead_b", "d_nosuojin_b", "d_categroy_b", "d_fuckziti_b", "d_autolink_b", "d_fancybox_b", "d_mobilesticky_b", "d_tui_b", "d_description", "d_description_b", "d_keywords", "d_keywords_b", "d_tui", "d_sticky_b", "d_sticky_count", "d_linkpage_cat", "d_tougao_b", "d_tougao_time", "d_tougao_mailto", "d_avatar_b", "d_avatarDate", "d_sideroll_b", "d_sideroll_1", "d_sideroll_2", "d_pingback_b", "d_autosave_b", "d_tqq_b", "d_tqq", "d_weibo_b", "d_weibo", "d_baidu_b", "d_baidu", "d_git_b", "d_git", "d_rss","d_qqContact_b","d_qqContact","d_weixin_b","d_weixin","d_emailContact_b","d_emailContact", "d_track_b", "d_track", "d_headcode_b", "d_headcode", "d_footcode_b", "d_footcode", "d_adsite_01_b", "d_adsite_01", "d_adindex_02_b", "d_adindex_02", "d_adindex_01_b", "d_adindex_01", "d_adindex_03_b", "d_adindex_03", "d_adpost_01_b", "d_adpost_01", "d_adpost_02_b", "d_adpost_02", "d_adpost_03_b", "d_adpost_03", "d_sign_b", "d_jquerybom_b", "d_ajaxpager_b", "d_thumbnail_b", "d_bdshare_b", "d_related_count", "d_post_views_b", "d_post_author_b", "d_post_comment_b", "d_post_time_b","hot_list_title","hot_list_number","hot_list_date","hot_list_check","d_post_like_b","d_singleMenu_b","Mobiled_adindex_02_b","Mobiled_adindex_02","Mobiled_adpost_01_b","Mobiled_adpost_01","Mobiled_adpost_02_b","Mobiled_adpost_02","d_spamComments_b"
);

function mytheme_add_admin() {
    global $themename, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                update_option( $value, $_REQUEST[ $value ] );
            }
            header("Location: admin.php?page=G.php&saved=true");
            die;
        }
    }
    add_theme_page($themename."设置", $themename."设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
    global $themename, $options;
    $i=0;
    if ( $_REQUEST['saved'] ) echo '<div class="updated settings-error"><p>'.$themename.'修改已保存</p></div>';
?>

<div class="wrap d_wrap">
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/admin/admin.css"/>
    <h2><?php echo $themename; ?>设置
        <span class="d_themedesc">发布来源：<a href="http://googlo.me/" target="_blank">乐趣公园</a> &nbsp;&nbsp; <a href="http://googlo.me/archives/3011.html" target="_blank">主页</a></span><span style="font-size:16px;color: rgb(245, 99, 99);padding-left:20px;">更多问题，请查看 -><a href="http://googlo.me/archives/3275.html" target="_blank">猪蹄食用说明</a>  注意：设置项含(★)的是单选项</span> <input class="button-primary" type="button" value="主题更新日志" onclick="window.open('http://git.oschina.net/yunluo/yusi/commits/master')">&nbsp;&nbsp;<input class="button-primary" type="button" value="主题反馈" onclick="window.open('http://googlo.me/go/mail')">
    </h2>

<form method="post" class="d_formwrap">
    <table>
    <thead>
        <tr>
            <th width="200"></th>
            <th></th>
        </tr>
    </thead>
    <tr>
        <td class="d_tit">网站描述</td>
        <td>
			<label class="checkbox inline">
                <input type="checkbox" id="d_description_b" name="d_description_b" <?php if(dopt('d_description_b')) echo 'checked="checked"' ?>>开启
            </label>
            <input placeholder="请在这里输入您的网站描述，简单介绍一些您的网站" class="ipt-b" type="text" id="d_description" name="d_description" value="<?php echo dopt('d_description'); ?>"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">网站关键字</td>
        <td>
			<label class="checkbox inline">
                <input type="checkbox" id="d_keywords_b" name="d_keywords_b" <?php if(dopt('d_keywords_b')) echo 'checked="checked"' ?>>开启
            </label>
            <input placeholder="请在这里输入您的网站关键词" class="ipt-b" type="text" id="d_keywords" name="d_keywords" value="<?php echo dopt('d_keywords'); ?>"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">最新消息</td>
        <td>
		<label class="checkbox inline">
<input type="checkbox" id="d_tui_b" name="d_tui_b" <?php if(dopt('d_tui_b')) echo 'checked="checked"' ?> checked>开启
        </label>
            <textarea placeholder="这里的文字将显示在公告栏" name="d_tui" id="d_tui" type="textarea" rows="2"><?php echo dopt('d_tui'); ?></textarea>
            <span class="d_tip">最新消息显示在全站导航条下方，非常给力的推广位置</span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">CMS布局设置</td>
        <td>
			<label class="checkbox inline">
                <input type="checkbox" id="d_cms_b" name="d_cms_b" <?php if(dopt('d_cms_b')) echo 'checked="checked"' ?>>开启
            </label>分类设置：
			分类1&nbsp;<input type="number" id="d_cat_1" name="d_cat_1" value="<?php echo dopt('d_cat_1'); ?>">&nbsp;
			分类2&nbsp;<input type="number" id="d_cat_2" name="d_cat_2" value="<?php echo dopt('d_cat_2'); ?>">&nbsp;
			分类3&nbsp;<input type="number" id="d_cat_3" name="d_cat_3" value="<?php echo dopt('d_cat_3'); ?>">&nbsp;
			分类4&nbsp;<input type="number" id="d_cat_4" name="d_cat_4" value="<?php echo dopt('d_cat_4'); ?>">&nbsp;
			分类5&nbsp;<input type="number" id="d_cat_5" name="d_cat_5" value="<?php echo dopt('d_cat_5'); ?>">&nbsp;
			分类6&nbsp;<input type="number" id="d_cat_6" name="d_cat_6" value="<?php echo dopt('d_cat_6'); ?>">
			分类7&nbsp;<input type="number" id="d_cat_7" name="d_cat_7" value="<?php echo dopt('d_cat_7'); ?>">
        </td>
    </tr>
    <tr>
        <td class="d_tit">网站全部分类</td>
        <td>
<span class="d_tip"><?php Bing_show_category(); ?></span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">首页隐藏分类</td>
        <td>
			<label class="checkbox inline">
                <input type="checkbox" id="d_blockcat_b" name="d_blockcat_b" <?php if(dopt('d_blockcat_b')) echo 'checked="checked"' ?>>开启
            </label><span class="d_tip">开启后，这些ID的分类将不在首页粗线</span>&nbsp;&nbsp;
		分类1&nbsp;<input type="smalltext" id="d_blockcat_1" name="d_blockcat_1" value="<?php echo dopt('d_blockcat_1'); ?>">&nbsp;

		分类2&nbsp;<input type="smalltext" id="d_blockcat_2" name="d_blockcat_2" value="<?php echo dopt('d_blockcat_2'); ?>"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">新浪微博同步</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_sinasync_b" name="d_sinasync_b" <?php if(dopt('d_sinasync_b')) echo 'checked="checked"' ?>>开启
            </label>
			APPKEY:<input type="smalltext" id="d_wbapky_b" name="d_wbapky_b" value="<?php echo dopt('d_wbapky_b'); ?>">
			用户名<input type="smalltext" id="d_wbuser_b" name="d_wbuser_b" value="<?php echo dopt('d_wbuser_b'); ?>">
			密码<input type="smalltext" id="d_wbpasd_b" name="d_wbpasd_b" value="<?php echo dopt('d_wbpasd_b'); ?>">&nbsp;&nbsp;&nbsp;<a href="javascript:about();">如何使用微博同步？</a>&nbsp;&nbsp;&nbsp;<input class="button-primary" type="button" value="微博开放平台" onclick="window.open('http://open.weibo.com/webmaster/add')">
			<br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">幻灯片【豪华版】设置</td>
        <td>
            电脑端显示<label class="checkbox inline">
                <input type="checkbox" id="d_sticky_b" name="d_sticky_b" <?php if(dopt('d_sticky_b')) echo 'checked="checked"' ?>>开启
            </label>
			移动端不显示<label class="checkbox inline">
                <input type="checkbox" id="d_mobilesticky_b" name="d_mobilesticky_b" <?php if(dopt('d_mobilesticky_b')) echo 'checked="checked"' ?>>开启
            </label>
            显示<input class="d_num" name="d_sticky_count" id="d_sticky_count" type="number" value="<?php echo dopt('d_sticky_count'); ?>">条 默认4条
            &nbsp; &nbsp;
            <span class="d_tip">开启后请设置4篇以上的置顶文章,文章第一张图片为716*297</span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">幻灯片【简约版】设置</td>
        <td>
            幻灯片显示<label class="checkbox inline">
                <input type="checkbox" id="d_slick_b" name="d_slick_b" <?php if(dopt('d_slick_b')) echo 'checked="checked"' ?>>开启
            </label><br><hr />
			幻灯片1<input type="checkbox" id="d_slick1_b" name="d_slick1_b" <?php if(dopt('d_slick1_b')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;
			幻灯片1链接<input type="smalltext" id="d_slick1url_b" name="d_slick1url_b" value="<?php echo dopt('d_slick1url_b'); ?>">
			幻灯片1图片<input type="smalltext" id="d_slick1img_b" name="d_slick1img_b" value="<?php echo dopt('d_slick1img_b'); ?>">
			幻灯片1标题<input type="text" id="d_slick1title_b" name="d_slick1title_b" value="<?php echo dopt('d_slick1title_b'); ?>"><br><hr />
			幻灯片2<input type="checkbox" id="d_slick2_b" name="d_slick2_b" <?php if(dopt('d_slick2_b')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;
			幻灯片2链接<input type="smalltext" id="d_slick2url_b" name="d_slick2url_b" value="<?php echo dopt('d_slick2url_b'); ?>">
			幻灯片2图片<input type="smalltext" id="d_slick2img_b" name="d_slick2img_b" value="<?php echo dopt('d_slick2img_b'); ?>">
			幻灯片2标题<input type="text" id="d_slick2title_b" name="d_slick2title_b" value="<?php echo dopt('d_slick2title_b'); ?>"><br><hr />
			幻灯片3<input type="checkbox" id="d_slick3_b" name="d_slick3_b" <?php if(dopt('d_slick3_b')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;
			幻灯片3链接<input type="smalltext" id="d_slick3url_b" name="d_slick3url_b" value="<?php echo dopt('d_slick3url_b'); ?>">
			幻灯片3图片<input type="smalltext" id="d_slick3img_b" name="d_slick3img_b" value="<?php echo dopt('d_slick3img_b'); ?>">
			幻灯片3标题<input type="text" id="d_slick3title_b" name="d_slick3title_b" value="<?php echo dopt('d_slick3title_b'); ?>"><br><hr />
			幻灯片4<input type="checkbox" id="d_slick4_b" name="d_slick4_b" <?php if(dopt('d_slick4_b')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;
			幻灯片4链接<input type="smalltext" id="d_slick4url_b" name="d_slick4url_b" value="<?php echo dopt('d_slick4url_b'); ?>">
			幻灯片4图片<input type="smalltext" id="d_slick4img_b" name="d_slick4img_b" value="<?php echo dopt('d_slick4img_b'); ?>">
			幻灯片4标题<input type="text" id="d_slick4title_b" name="d_slick4title_b" value="<?php echo dopt('d_slick4title_b'); ?>"><br><hr />
			幻灯片5<input type="checkbox" id="d_slick5_b" name="d_slick5_b" <?php if(dopt('d_slick5_b')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;
			幻灯片5链接<input type="smalltext" id="d_slick5url_b" name="d_slick5url_b" value="<?php echo dopt('d_slick5url_b'); ?>">
			幻灯片5图片<input type="smalltext" id="d_slick5img_b" name="d_slick5img_b" value="<?php echo dopt('d_slick5img_b'); ?>">
			幻灯片5标题<input type="text" id="d_slick5title_b" name="d_slick5title_b" value="<?php echo dopt('d_slick5title_b'); ?>"><br><hr />
			幻灯片6<input type="checkbox" id="d_slick6_b" name="d_slick6_b" <?php if(dopt('d_slick6_b')) echo 'checked="checked"' ?>>开启&nbsp;&nbsp;
			幻灯片6链接<input type="smalltext" id="d_slick6url_b" name="d_slick6url_b" value="<?php echo dopt('d_slick6url_b'); ?>">
			幻灯片6图片<input type="smalltext" id="d_slick6img_b" name="d_slick6img_b" value="<?php echo dopt('d_slick6img_b'); ?>">
			幻灯片6标题<input type="text" id="d_slick6title_b" name="d_slick6title_b" value="<?php echo dopt('d_slick6title_b'); ?>"><br><hr />

            <span class="d_tip">开启后请设置4篇以上的置顶文章,文章第一张图片为716*297</span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">友情链接页面</td>
        <td>
			<label class="checkbox inline">
                只显示分类ID为 <input placeholder="如果您不知道填写什么，您可以空着不填写，么么" name="d_linkpage_cat" id="d_linkpage_cat" type="text" value="<?php echo dopt('d_linkpage_cat'); ?>"> 的链接(id之间用英文逗号隔开)
            </label><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">文章无图时不显示缩略图</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_thumbnail_b" name="d_thumbnail_b" <?php if(dopt('d_thumbnail_b')) echo 'checked="checked"' ?>>开启
            </label>
      列表Ajax下拉加载
            <label class="checkbox inline">
                <input type="checkbox" id="d_ajaxpager_b" name="d_ajaxpager_b" <?php if(dopt('d_ajaxpager_b')) echo 'checked="checked"' ?>>开启
            </label>
		文章页顶部面包屑导航  <label class="checkbox inline">
                <input type="checkbox" id="d_singleMenu_b" name="d_singleMenu_b" <?php if(dopt('d_singleMenu_b')) echo 'checked="checked"' ?>>开启
            </label>
			白色哭泣404设置<label class="checkbox inline">
                <input type="checkbox" id="d_sj404_b" name="d_sj404_b" <?php if(dopt('d_sj404_b')) echo 'checked="checked"' ?> checked>开启
            </label><br><hr />
        </td>
    </tr>
	    <tr>
        <td class="d_tit">七牛CDN设置</td>
        <td>
		七牛CDN<label class="checkbox inline">
                <input type="checkbox" id="d_qiniucdn_b" name="d_qiniucdn_b" <?php if(dopt('d_qiniucdn_b')) echo 'checked="checked"' ?>>开启
				</label>&nbsp;
		七牛自定义域名<input placeholder="请输入您的七牛域名，结尾不带 / " type="text" id="d_cdnurl_b" name="d_cdnurl_b" value="<?php echo dopt('d_cdnurl_b'); ?>">
            &nbsp;&nbsp;
			<span class="d_tip">开启后请开通七牛服务</span>&nbsp;&nbsp;<a href="javascript:qiniu();">为何要使用七牛？</a><input class="button-primary" type="button" value="立即注册七牛" onclick="window.open('http://googlo.me/go/qiniu')"><br><hr />
        </td>
    </tr>
	    <tr>
        <td class="d_tit">STMP邮箱设置</td>
        <td>
		<label class="checkbox inline">
                <input type="checkbox" id="d_stmpmail_b" name="d_stmpmail_b" <?php if(dopt('d_stmpmail_b')) echo 'checked="checked"' ?>>开启
				</label>&nbsp;
		发件人地址：<input placeholder="邮箱地址" type="smalltext" id="d_maildizhi_b" name="d_maildizhi_b" value="<?php echo dopt('d_maildizhi_b'); ?>">
		发件人昵称：<input placeholder="随意输" type="smalltext" id="d_mailnichen_b" name="d_mailnichen_b" value="<?php echo dopt('d_mailnichen_b'); ?>">
		SMTP服务器地址：<input type="smalltext" id="d_mailsmtp_b" name="d_mailsmtp_b" value="<?php echo dopt('d_mailsmtp_b'); ?>"><br><hr />
		SMTP服务器端口：<input placeholder="25" type="number" id="d_mailport_b" name="d_mailport_b" value="<?php echo dopt('d_mailport_b'); ?>">
		邮箱账号：<input placeholder="请输入您的账号" type="smalltext" id="d_mailuser_b" name="d_mailuser_b" value="<?php echo dopt('d_mailuser_b'); ?>">
		邮箱密码：<input placeholder="请输入您的密码" type="smalltext" id="d_mailpass_b" name="d_mailpass_b" value="<?php echo dopt('d_mailpass_b'); ?>">
            &nbsp;&nbsp;
		<br><hr />
        </td>
    </tr>
	    <tr>
        <td class="d_tit">主题头部设置</td>
        <td>
        图片头部背景<label class="checkbox inline">
                <input type="checkbox" id="d_pichead_b" name="d_pichead_b" <?php if(dopt('d_pichead_b')) echo 'checked="checked"' ?>>开启
            </label>
		图片头部logo<label class="checkbox inline">
                <input type="checkbox" id="d_piclogo_b" name="d_piclogo_b" <?php if(dopt('d_piclogo_b')) echo 'checked="checked"' ?>>开启
            </label>
			<span class="d_tip">不选择的话，默认是纯色背景，文字LOGO</span><br><hr />
		自定义头部背景<label class="checkbox inline">
                <input type="checkbox" id="d_customhead_b" name="d_customhead_b" <?php if(dopt('d_customhead_b')) echo 'checked="checked"' ?>>开启
            </label>
		自定义头部背景路径<input type="smalltext" id="d_customhead" name="d_customhead" value="<?php echo dopt('d_customhead'); ?>">
		自定义头部logo<label class="checkbox inline">
                <input type="checkbox" id="d_customlogo_b" name="d_customlogo_b" <?php if(dopt('d_customlogo_b')) echo 'checked="checked"' ?>>开启
            </label>
		自定义头部logo路径<input type="smalltext" id="d_customlogo" name="d_customlogo" value="<?php echo dopt('d_customlogo'); ?>"><br><hr />
        </td>
    </tr>
	    <tr>
        <td class="d_tit">主题皮肤设置&nbsp;<span class="d_tip">★</span></td>
        <td>
		红色<label class="checkbox inline">
                <input type="checkbox" id="d_red_b" name="d_red_b" <?php if(dopt('d_red_b')) echo 'checked="checked"' ?>>
            </label>
        蓝色<label class="checkbox inline">
                <input type="checkbox" id="d_blue_b" name="d_blue_b" <?php if(dopt('d_blue_b')) echo 'checked="checked"' ?>>
            </label>
        黑色<label class="checkbox inline">
                <input type="checkbox" id="d_black_b" name="d_black_b" <?php if(dopt('d_black_b')) echo 'checked="checked"' ?>>
            </label>
        紫色<label class="checkbox inline">
                <input type="checkbox" id="d_purple_b" name="d_purple_b" <?php if(dopt('d_purple_b')) echo 'checked="checked"' ?>>
            </label>
        黄色<label class="checkbox inline">
                <input type="checkbox" id="d_yellow_b" name="d_yellow_b" <?php if(dopt('d_yellow_b')) echo 'checked="checked"' ?>>
            </label><span class="d_tip">不选择的话，默认是轻蓝色</span><br><hr />
        </td>
    </tr>
	    <tr>
        <td class="d_tit">主题高级功能</td>
        <td>
			图片弹窗<label class="checkbox inline">
                <input type="checkbox" id="d_fancybox_b" name="d_fancybox_b" <?php if(dopt('d_fancybox_b')) echo 'checked="checked"' ?>>开启
            </label>
            自动内链<label class="checkbox inline">
                <input type="checkbox" id="d_autolink_b" name="d_autolink_b" <?php if(dopt('d_autolink_b')) echo 'checked="checked"' ?>>开启
            </label>
			屏蔽谷歌字体<label class="checkbox inline">
                <input type="checkbox" id="d_fuckziti_b" name="d_fuckziti_b" <?php if(dopt('d_fuckziti_b')) echo 'checked="checked"' ?>>开启
            </label>
			链接去掉Categroy<label class="checkbox inline">
                <input type="checkbox" id="d_categroy_b" name="d_categroy_b" <?php if(dopt('d_categroy_b')) echo 'checked="checked"' ?>>开启
            </label>
			禁用首行缩进<label class="checkbox inline">
                <input type="checkbox" id="d_nosuojin_b" name="d_nosuojin_b" <?php if(dopt('d_nosuojin_b')) echo 'checked="checked"' ?>>开启
            </label><br><hr />
			头像旋转<label class="checkbox inline">
                <input type="checkbox" id="d_avataer_b" name="d_avataer_b" <?php if(dopt('d_avataer_b')) echo 'checked="checked"' ?>>开启
            </label>
			百度收录提示<label class="checkbox inline">
                <input type="checkbox" id="d_baidurecord_b" name="d_baidurecord_b" <?php if(dopt('d_baidurecord_b')) echo 'checked="checked"' ?>>开启
            </label>
			网站下雪特效<label class="checkbox inline">
                <input type="checkbox" id="d_snow_b" name="d_snow_b" <?php if(dopt('d_snow_b')) echo 'checked="checked"' ?>>开启
            </label>
			文章二维码<label class="checkbox inline">
                <input type="checkbox" id="d_qr_b" name="d_qr_b" <?php if(dopt('d_qr_b')) echo 'checked="checked"' ?>>开启
            </label><br><hr />
			代码黑色主题<label class="checkbox inline">
                <input type="checkbox" id="d_darkhighlight_b" name="d_darkhighlight_b" <?php if(dopt('d_darkhighlight_b')) echo 'checked="checked"' ?>>开启
            </label>
			网站禁止复制<label class="checkbox inline">
                <input type="checkbox" id="d_copy_b" name="d_copy_b" <?php if(dopt('d_copy_b')) echo 'checked="checked"' ?>>开启
            </label>
			复制弹窗提醒<label class="checkbox inline">
                <input type="checkbox" id="d_copydialog_b" name="d_copydialog_b" <?php if(dopt('d_copydialog_b')) echo 'checked="checked"' ?>>开启
            </label>
			</label>
			页面伪静态<label class="checkbox inline">
                <input type="checkbox" id="d_pagehtml_b" name="d_pagehtml_b" <?php if(dopt('d_pagehtml_b')) echo 'checked="checked"' ?>>开启
            </label><span class="d_tip">开启后，请重新保存下固定连接</span>
        </td>
    </tr>
 <tr>
      <td class="d_tit">热门排行</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="hot_list_check" name="hot_list_check" <?php if(dopt('hot_list_check')) echo 'checked="checked"' ?>>开启 </label>显示天数 <input class="hot_list_date" name="hot_list_date" id="hot_list_date" type="number" value="<?php echo dopt('hot_list_date'); ?>"> 天（默认7）

	显示数量 <input class="hot_list_number" name="hot_list_number" id="hot_list_number" type="number" value="<?php echo dopt('hot_list_number'); ?>">条（默认10）

	&nbsp;&nbsp; 名称 <input class="d_inp_short" name="hot_list_title" id="hot_list_title" type="smalltext" value="<?php echo dopt('hot_list_title'); ?>"><br><hr />
	</td>
    </tr>
    <tr>
        <td class="d_tit">列表文章属性开关</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_post_views_b" name="d_post_views_b" <?php if(dopt('d_post_views_b')) echo 'checked="checked"' ?>>不显示访客数
            </label> &nbsp; &nbsp;
            <label class="checkbox inline">
                <input type="checkbox" id="d_post_author_b" name="d_post_author_b" <?php if(dopt('d_post_author_b')) echo 'checked="checked"' ?>>不显示作者
            </label> &nbsp; &nbsp;
            <label class="checkbox inline">
                <input type="checkbox" id="d_post_comment_b" name="d_post_comment_b" <?php if(dopt('d_post_comment_b')) echo 'checked="checked"' ?>>不显示评论数
            </label> &nbsp; &nbsp;
            <label class="checkbox inline">
                <input type="checkbox" id="d_post_time_b" name="d_post_time_b" <?php if(dopt('d_post_time_b')) echo 'checked="checked"' ?>>不显示时间
            </label> &nbsp; &nbsp;
  	<label class="checkbox inline">
                <input type="checkbox" id="d_post_like_b" name="d_post_like_b" <?php if(dopt('d_post_like_b')) echo 'checked="checked"' ?>>不显示喜欢
            </label><br><hr />
        </td>
    </tr>
        </td>
    </tr>
    <tr>
        <td class="d_tit">文章页 - 相关文章显示条数</td>
        <td>
            显示<input class="d_num" name="d_related_count" id="d_related_count" type="number" value="<?php echo dopt('d_related_count'); ?>">条 默认 8<br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">jQuery底部加载</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_jquerybom_b" name="d_jquerybom_b" <?php if(dopt('d_jquerybom_b')) echo 'checked="checked"' ?>>开启
            </label>
            <span class="d_tip">jQuery默认在head区域加载，如果需要页面载入加速，请开启，但是有可能影响部分依赖jQuery的插件失效。</span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">用户登录信息和分享</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_sign_b" name="d_sign_b" <?php if(dopt('d_sign_b')) echo 'checked="checked"' ?>>开启用户登录信息
            </label>
 	    <label class="checkbox inline">
                <input type="checkbox" id="d_bdshare_b" name="d_bdshare_b" <?php if(dopt('d_bdshare_b')) echo 'checked="checked"' ?>>开启百度分享
            </label><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">投稿</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_tougao_b" name="d_tougao_b" <?php if(dopt('d_tougao_b')) echo 'checked="checked"' ?>>开启
            </label>
            投稿时间间隔 <input class="d_num" name="d_tougao_time" id="d_tougao_time" type="number" value="<?php echo dopt('d_tougao_time'); ?>"> 秒，默认：240
            &nbsp; &nbsp;
            投稿提醒邮箱 <input placeholder="请在这里输入您的邮箱" name="d_tougao_mailto" id="d_tougao_mailto" type="smalltext" value="<?php echo dopt('d_tougao_mailto'); ?>"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Gravatar头像设置&nbsp;<span class="d_tip">★</span></td>
        <td>
		    <label class="checkbox inline">
                SSL访问(推荐)<input type="checkbox" id="d_avatar_ssl" name="d_avatar_ssl" <?php if(dopt('d_avatar_ssl')) echo 'checked="checked"' ?>>开启
            </label>
			<label class="checkbox inline">
                多说镜像<input type="checkbox" id="d_avatar_ds" name="d_avatar_ds" <?php if(dopt('d_avatar_ds')) echo 'checked="checked"' ?>>开启
            </label>
			<label class="checkbox inline">
                七牛镜像<input type="checkbox" id="d_avatar_qn" name="d_avatar_qn" <?php if(dopt('d_avatar_qn')) echo 'checked="checked"' ?>>开启
            </label>
            <label class="checkbox inline">
                本地缓存<input type="checkbox" id="d_avatar_b" name="d_avatar_b" <?php if(dopt('d_avatar_b')) echo 'checked="checked"' ?>>开启
            </label>
            <label class="d_number">
                缓存
                <input class="d_num " name="d_avatarDate" id="d_avatarDate" type="number" value="<?php if( dopt('d_avatarDate') ) echo dopt('d_avatarDate'); else echo '15'; ?>"> 天
                &nbsp; &nbsp;
                开启后在网站根目录新建avatar文件夹，777权限
                <br><hr />
                <span class="d_tip">缓存头像有利于头像加载和防备Gravatar头像站点被墙；如有报错等异常，请关闭，可能你的主机不支持</span>
            </label><br><hr />
        </td>
    </tr>
 <tr>
        <td class="d_tit">评论内容过滤</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_spamComments_b" name="d_spamComments_b" <?php if(dopt('d_spamComments_b')) echo 'checked="checked"' ?>>开启
            </label>
           <span class="d_tip">启用后，屏蔽外文评论，屏蔽含有WordPress设置黑名单内容的评论，屏蔽过长网址的评论，屏蔽字数少于2或者多余200的评论，屏蔽内容或者评论昵称含有链接的评论。另，在WordPress-设置-讨论-黑名单中添加想要屏蔽的关键词，邮箱，网址，IP地址，每行一个。</span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">侧栏模块固定</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_sideroll_b" name="d_sideroll_b" <?php if(dopt('d_sideroll_b')) echo 'checked="checked"' ?>>开启
            </label>
            <label class="d_number">
                滚动时 固定侧栏的 第
                <input class="d_num " name="d_sideroll_1" id="d_sideroll_1" type="number" value="<?php echo dopt('d_sideroll_1'); ?>"> 个模块
            </label>
            和
            <label class="d_number">
                第
                <input class="d_num " name="d_sideroll_2" id="d_sideroll_2" type="number" value="<?php echo dopt('d_sideroll_2'); ?>"> 个模块
            </label><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">禁止站内文章Pingback</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_pingback_b" name="d_pingback_b" <?php if(dopt('d_pingback_b')) echo 'checked="checked"' ?>>开启
                &nbsp; &nbsp;
                <span class="d_tip">开启后，不会发送站内Pingback，建议开启</span>
            </label><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">禁止后台编辑时自动保存</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_autosave_b" name="d_autosave_b" <?php if(dopt('d_autosave_b')) echo 'checked="checked"' ?>>开启
                &nbsp; &nbsp;
                <span class="d_tip">开启后，后台编辑文章时候不会定时保存，有效缩减数据库存储量；但是，一般不建议开启，除非你的数据库容量很小</span>
            </label><br><hr />
        </td>
    </tr>

    <tr>
        <td class="d_tit">腾讯微博</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_tqq_b" name="d_tqq_b" <?php if(dopt('d_tqq_b')) echo 'checked="checked"' ?>>开启
            </label>
            网址：<input placeholder="实例：http://t.qq.com/sp865113728" class="d_inp_short" name="d_tqq" id="d_tqq" type="url" value="<?php echo dopt('d_tqq'); ?>"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">新浪微博</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_weibo_b" name="d_weibo_b" <?php if(dopt('d_weibo_b')) echo 'checked="checked"' ?>>开启
            </label>
            网址：<input placeholder="实例：http://weibo.com/igooglo" class="d_inp_short" name="d_weibo" id="d_weibo" type="url" value="<?php echo dopt('d_weibo'); ?>"><br><hr />
        </td>
    </tr>
   <tr>
        <td class="d_tit">腾讯微信</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_weixin_b" name="d_weixin_b" <?php if(dopt('d_weixin_b')) echo 'checked="checked"' ?>>开启
            </label>
            微信号：<input placeholder="您的微信号" class="d_inp_short" name="d_weixin" id="d_weixin" type="smalltext" value="<?php echo dopt('d_weixin'); ?>">&nbsp;&nbsp;微信二维码：<input placeholder="请在此输入您的二维码地址链接" class="d_inp_short" name="d_weixin_qr" id="d_weixin_qr" type="text" value="<?php echo dopt('d_weixin_qr'); ?>"><br><hr />
        </td>
    </tr>
   <tr>
        <td class="d_tit">腾讯QQ</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_qqContact_b" name="d_qqContact_b" <?php if(dopt('d_qqContact_b')) echo 'checked="checked"' ?>>开启
            </label>
            QQ号：<input placeholder="请在此填写您的QQ号" class="d_inp_short" name="d_qqContact" id="d_qqContact" type="text" value="<?php echo dopt('d_qqContact'); ?>"><br><hr />
        </td>
    </tr>
   <tr>
        <td class="d_tit">Email</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_emailContact_b" name="d_emailContact_b" <?php if(dopt('d_emailContact_b')) echo 'checked="checked"' ?>>开启
            </label>
            网址：<input placeholder="请填写好您的邮我代码" class="d_inp_short" name="d_emailContact" id="d_emailContact" type="url" value="<?php echo dopt('d_emailContact'); ?>">&nbsp;&nbsp;&nbsp;<input class="button-primary" type="button" value="点击获取邮箱代码" onclick="window.open('http://open.mail.qq.com/cgi-bin/qm_help_mailme?sid=,2,zh_CN&t=open_mailme')"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">百度贴吧</td>
        <td>
            <label class="checkbox inline">
               <input type="checkbox" id="d_baidu_b" name="d_baidu_b" <?php if(dopt('d_baidu_b')) echo 'checked="checked"' ?>>开启
            </label>
            网址：<input class="d_inp_short" name="d_baidu" id="d_baidu" type="url" value="<?php echo dopt('d_baidu'); ?>"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">GIT系统</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_git_b" name="d_git_b" <?php if(dopt('d_git_b')) echo 'checked="checked"' ?>>开启
            </label>
            网址：<input class="d_inp_short" name="d_git" id="d_git" type="url" value="<?php echo dopt('d_git'); ?>"><br><hr />
        </td>
    </tr>
   <tr>
        <td class="d_tit">支付宝</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_pay_b" name="d_pay_b" <?php if(dopt('d_pay_b')) echo 'checked="checked"' ?>>开启
            </label>
            支付宝账号：<input placeholder="您的支付宝账号" class="d_inp_short" name="d_pay" id="d_pay" type="smalltext" value="<?php echo dopt('d_pay'); ?>">&nbsp;&nbsp;支付宝二维码：<input placeholder="请在此输入您的二维码图片链接" class="d_inp_short" name="d_pay_qr" id="d_pay_qr" type="text" value="<?php echo dopt('d_pay_qr'); ?>"><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">RSS订阅地址</td>
        <td>
            <input placeholder="一般是网站域名/feed，例如：http://googlo.me/feed" class="d_inp_short" name="d_rss" id="d_rss" type="url" value="<?php echo dopt('d_rss'); ?>">
            <span class="d_tip">可以是其他订阅托管站点的地址。边栏只能选择六个社交账户，否则会错位。</span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">流量统计代码</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_track_b" name="d_track_b" <?php if(dopt('d_track_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea placeholder="统计网站流量，推荐使用百度统计，国内比较优秀且速度快；还可使用Google统计、CNZZ等" name="d_track" id="d_track" type="textarea" rows="2"><?php echo dopt('d_track'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">文章版权声明</td>
        <td>
		<textarea placeholder="此处输入的文字将出现在每篇文章最底部" name="d_copyright_b" id="d_copyright_b" type="textarea" rows=""><?php echo dopt('d_copyright_b'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">超级Footer</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_superfoot_b" name="d_superfoot_b" <?php if(dopt('d_superfoot_b')) echo 'checked="checked"' ?>>开启
            </label><span class="d_tip">开启后下面输入的数据才有效果</span><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer1标题</td>
        <td>
            <input placeholder="在这里输入foot1的标题" class="d_inp_short" name="d_foottitle1" id="d_foottitle1" type="smalltext" value="<?php echo dopt('d_foottitle1'); ?>"><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer1内容</td>
        <td>
            <textarea placeholder="在这里输入foot1的内容" name="d_footconent1" id="d_footconent1" type="textarea" rows="2"><?php echo dopt('d_footconent1'); ?></textarea><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer2标题</td>
        <td>
            <input placeholder="在这里输入foot2的标题" class="d_inp_short" name="d_foottitle2" id="d_foottitle2" type="smalltext" value="<?php echo dopt('d_foottitle2'); ?>"><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer2内容</td>
        <td>
            <textarea placeholder="在这里输入foot2的内容" name="d_footconent2" id="d_footconent2" type="textarea" rows="2"><?php echo dopt('d_footconent2'); ?></textarea><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer3标题</td>
        <td>
            <input placeholder="在这里输入foot3的标题" class="d_inp_short" name="d_foottitle3" id="d_foottitle3" type="smalltext" value="<?php echo dopt('d_foottitle3'); ?>"><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer3内容</td>
        <td>
            <textarea placeholder="在这里输入foot3的内容" name="d_footconent3" id="d_footconent3" type="textarea" rows="2"><?php echo dopt('d_footconent3'); ?></textarea><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer4标题</td>
        <td>
            <input placeholder="在这里输入foot4的标题" class="d_inp_short" name="d_foottitle4" id="d_foottitle4" type="smalltext" value="<?php echo dopt('d_foottitle4'); ?>"><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">Footer4内容</td>
        <td>
            <textarea placeholder="在这里输入foot4的内容" name="d_footconent4" id="d_footconent4" type="textarea" rows="2"><?php echo dopt('d_footconent4'); ?></textarea><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">文章页自定义代码</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_singlecode_b" name="d_singlecode_b" <?php if(dopt('d_singlecode_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea placeholder="放置自定义（css或js）的代码块" name="d_singlecode" id="d_singlecode" type="textarea" rows="2"><?php echo dopt('d_singlecode'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">页面头部公共代码</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_headcode_b" name="d_headcode_b" <?php if(dopt('d_headcode_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea placeholder="会自动出现在页面头部（head区域），可放置广告代码等自定义（css或js）的全局代码块" name="d_headcode" id="d_headcode" type="textarea" rows="2"><?php echo dopt('d_headcode'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">网站footer公共代码</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_footcode_b" name="d_footcode_b" <?php if(dopt('d_footcode_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea placeholder="同上，但是在全站页面footer部分出现" name="d_footcode" id="d_footcode" type="textarea" rows="2"><?php echo dopt('d_footcode'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">全站底部脚本</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_footercode_b" name="d_footercode_b" <?php if(dopt('d_footercode_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_footercode" id="d_footercode" type="textarea" rows="2"><?php echo dopt('d_footercode'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">广告：404页面广告</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_404ad_b" name="d_404ad_b" <?php if(dopt('d_404ad_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea placeholder="广告区域，任意联盟广告和自定义广告的代码均可" name="d_404ad" id="d_404ad" type="textarea" rows=""><?php echo dopt('d_404ad'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">广告：全站 - 导航下横幅</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_adsite_01_b" name="d_adsite_01_b" <?php if(dopt('d_adsite_01_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea placeholder="广告区域，任意联盟广告和自定义广告的代码均可，下同" name="d_adsite_01" id="d_adsite_01" type="textarea" rows=""><?php echo dopt('d_adsite_01'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">广告：全站正文列表最前</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_adindex_02_b" name="d_adindex_02_b" <?php if(dopt('d_adindex_02_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_adindex_02" id="d_adindex_02" type="textarea" rows=""><?php echo dopt('d_adindex_02'); ?></textarea><br>
        </td>
    </tr>

    <tr>
        <td class="d_tit">广告：首页 - 导航下横幅</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_adindex_01_b" name="d_adindex_01_b" <?php if(dopt('d_adindex_01_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_adindex_01" id="d_adindex_01" type="textarea" rows=""><?php echo dopt('d_adindex_01'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">广告：首页 - 正文最前上</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_adindex_03_b" name="d_adindex_03_b" <?php if(dopt('d_adindex_03_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_adindex_03" id="d_adindex_03" type="textarea" rows=""><?php echo dopt('d_adindex_03'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">广告：文章页 - 页面标题下</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_adpost_01_b" name="d_adpost_01_b" <?php if(dopt('d_adpost_01_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_adpost_01" id="d_adpost_01" type="textarea" rows=""><?php echo dopt('d_adpost_01'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">广告：文章页 - 相关文章下</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_adpost_02_b" name="d_adpost_02_b" <?php if(dopt('d_adpost_02_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_adpost_02" id="d_adpost_02" type="textarea" rows=""><?php echo dopt('d_adpost_02'); ?></textarea><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit">广告：文章页 - 网友评论下</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_adpost_03_b" name="d_adpost_03_b" <?php if(dopt('d_adpost_03_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="d_adpost_03" id="d_adpost_03" type="textarea" rows=""><?php echo dopt('d_adpost_03'); ?></textarea><br><hr />
        </td>
    </tr>
 <tr>
        <td class="d_tit">手机广告：全站正文列表最前</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="Mobiled_adindex_02_b" name="Mobiled_adindex_02_b" <?php if(dopt('Mobiled_adindex_02_b')) echo 'checked="checked"' ?>>开启
			</label>
            <textarea placeholder="手机广告只适合在手机中投放。例如百度联盟移动广告，PC端不会显示。下同" name="Mobiled_adindex_02" id="Mobiled_adindex_02" type="textarea" rows=""><?php echo dopt('Mobiled_adindex_02'); ?></textarea><br><hr />
        </td>
    </tr>
 <tr>
        <td class="d_tit">手机广告：文章页 - 页面标题下</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="Mobiled_adpost_01_b" name="Mobiled_adpost_01_b" <?php if(dopt('Mobiled_adpost_01_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="Mobiled_adpost_01" id="Mobiled_adpost_01" type="textarea" rows=""><?php echo dopt('Mobiled_adpost_01'); ?></textarea><br><hr />
        </td>
    </tr>
 <tr>
        <td class="d_tit">手机广告：文章页 - 相关文章下</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="Mobiled_adpost_02_b" name="Mobiled_adpost_02_b" <?php if(dopt('Mobiled_adpost_02_b')) echo 'checked="checked"' ?>>开启
            </label>
            <textarea name="Mobiled_adpost_02" id="Mobiled_adpost_02" type="textarea" rows=""><?php echo dopt('Mobiled_adpost_02'); ?></textarea><br><hr />
        </td>
    </tr>
        <td class="d_tit">主题更新设置</td>
        <td>
            <label class="checkbox inline">
                <input type="checkbox" id="d_updates_b" name="d_updates_b" <?php if(dopt('d_updates_b')) echo 'checked="checked"' ?>> 禁止主题更新
            </label><span class="d_tip">选择后，您将无法收到本主题的更新推送，所以云落墙裂不推荐选择勾选</span><br><hr />
        </td>
    </tr>
    <tr>
        <td class="d_tit"></td>
        <td>
            <div class="d_desc">
                <input class="button-primary" name="save" type="submit" value="保存设置">
            </div>
            <input type="hidden" name="action" value="save">
        </td>
    </tr>

    </table>
</form>
</div>
<script>
var aaa = []
jQuery('.d_wrap input, .d_wrap textarea').each(function(e){
    if( jQuery(this).attr('id') ) aaa.push( jQuery(this).attr('id') )
})
console.log( aaa )

function about(){
alert("首先去微博开放平台创建网站应用，然后静等通过（未备案域名发送域名证书截图即可）\n将新浪的代码放进下方的head代码框，然后将appkey，用户名，密码输入即可！\n 如果审核不通过的话，看原因.审核通过后再申请高级写入权限");
}
function qiniu(){
alert("七牛可以视为免备案免费CDN，可以加速网站静态资源加载\n另外七牛可以免费拥有10G储存，10G流量（可提升），可以为主题提供稳定的缩略图服务\n本主题采用七牛云储存之后，可以直接删除占网站空间最大的uploads目录文件\n可以为有流量限制，空间大小限制的主机大幅节约成本\n如果你觉得七牛不错，点击右侧注册按钮立即注册七牛吧(邀请链接，若在意，请勿点)");
}
</script>
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');?>