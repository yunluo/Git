<?php

/*
*使用
*<?php echo git_get_option('@id', '@defult'); ?>格式获取值
*举例：<?php echo git_get_option('git_meta_description', '这是一个网站描述文字'); ?>
*/
$options = array(
    //开始第一个选项标签
    array(
        'title' => '常规选项',
        'id'    => 'panel_general',
        'type'  => 'panelstart' //panelatart 是顶部标签的意思
    ),
    array(
        'title' => '搜索引擎优化（SEO）',//标题文字
        'type'  => 'subtitle'//subtitle 是标签下的标题
    ),
    array(
        'name'  => '网站关键字',//选项显示的文字，选填
        'desc'  => '各关键字间用半角逗号","分割，数量在6个以内最佳。',//选项显示的一段描述文字，选填
        'id'    => "git_keywords",//选项的id，必须是唯一，后面根据这个获取值，必填
        'type'  => 'text',//种类，这个是普通的文字输入，必填
        'std'   => ''//选项的默认值，选填
    ),
    array(
        'name'  => '网站描述',
        'desc'  => '用简洁的文字描述本站点，字数建议在120个字以内。',
        'id'    => "git_description",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '公告栏信息',
        'desc'  => '最新消息显示在全站导航条下方，非常给力的推广位置',
        'id'    => "git_tui",
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '自动内链',
        'desc'  => '启用',
        'id'    => "git_autolink_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '图片自动添加alt',
        'desc'  => '启用',
        'id'    => "git_imgalt_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '友情链接页面',
        'desc'  => '只显示输入分类的链接，id之间用英文逗号隔开，一般默认空着就行',
        'id'    => 'git_linkpage_cat',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '文章无图时不显示缩略图',
        'desc'  => '注意：主题主要是为显示缩略图的，选择本项目可能会导致错位',
        'id'    => 'git_thumbnail_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '列表Ajax下拉加载',
        'desc'  => '开启本选项之后网站会采用ajax方式下拉自动加载',
        'id'    => 'git_ajaxpager_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '自定义404页面',
        'desc'  => '默认的404是神经猫游戏，开启后十一个白色哭泣的404',
        'id'    => 'git_sj404_b',
        'type'  => 'checkbox'
    ),
    array(
        'title' => '热门排行',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '开启',
        'id'    => 'hot_list_check',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '显示天数',
        'desc'  => '天（默认30天）',
        'id'    => 'hot_list_date',
        'type'  => 'number',
        'std'   => 30
    ),
    array(
        'name'  => '显示数量',
        'desc'  => '条（默认5条）',
        'id'    => 'hot_list_number',
        'type'  => 'number',
        'std'   => 5
    ),
    array(
        'name'  => '排行名称',
        'desc'  => '这里是显示在网站首页热门排行那里',
        'id'    => "hot_list_title",
        'type'  => 'text',
        'std'   => '本周热门'
    ),
    array(
        'name'  => 'jQuery底部加载',
        'desc'  => '开启 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; jQuery默认在head区域加载，如果需要页面载入加速，请开启，但是有可能影响部分依赖jQuery的插件失效。',
        'id'    => 'git_jquerybom_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '用户登录信息',
        'desc'  => '开启',
        'id'    => 'git_sign_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '百度分享',
        'desc'  => '开启',
        'id'    => 'git_bdshare_b',
        'type'  => 'checkbox'
    ),
    array(
        'title' => '占位文本',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '搜索框',
        'desc'  => '占位文本',
        'id'    => "git_search_placeholder",
        'type'  => 'text',
        'std'   => '输入内容并回车'
    ),
    array(
        'name'  => '评论',
        'desc'  => '评论框占位文本',
        'id'    => "git_comment_placeholder",
        'type'  => 'text',
        'std'   => '说点什么吧…'
    ),
    array(
        'title' => '投稿设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '开启',
        'desc'  => '开启后，再后台新建一个页面，模板选择投稿',
        'id'    => 'git_tougao_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '投稿时间间隔',
        'desc'  => '秒，默认：240',
        'id'    => "git_tougao_time",
        'type'  => 'number',
        'std'   => 240
    ),
    array(
        'name'  => '投稿提醒邮箱',
        'desc'  => '这里的邮箱一般是站长的邮箱，默认是获取网站自带的邮箱，另外，SMTP服务必须保证正常使用',
        'id'    => "git_tougao_mailto",
        'type'  => 'text',
        'std'   => get_bloginfo( 'admin_email' )
    ),
    array(
        'name'  => '评论内容过滤',
        'desc'  => '开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 启用后，屏蔽外文评论，屏蔽含有WordPress设置黑名单内容的评论，屏蔽过长网址的评论，屏蔽字数少于2或者多余200的评论，屏蔽内容或者评论昵称含有链接的评论。另，在WordPress-设置-讨论-黑名单中添加想要屏蔽的关键词，邮箱，网址，IP地址，每行一个。',
        'id'    => 'git_spamComments_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '流量统计代码',
        'desc'  => '统计网站流量，推荐使用百度统计，国内比较优秀且速度快；还可使用Google统计、CNZZ等',
        'id'    => 'git_track',
        'type'  => 'textarea'
    ),
    array(
        'name'  => '网站头部代码',
        'desc'  => '会自动出现在页面头部（head区域），可放置广告代码等自定义（css或js）的全局代码块',
        'id'    => 'git_headcode',
        'type'  => 'textarea'
    ),
    array(
        'name'  => '主题更新设置',
        'desc'  => '禁止主题更新&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 选择后，您将无法收到本主题的更新推送，所以云落墙裂不推荐选择勾选',
        'id'    => 'git_updates_b',
        'onclick'   => "return confirm('你确定要取消更新吗？');",
        'type'  => 'checkbox'
    ),
    array(
        'type'  => 'panelend'//标签段的结束
    ),
    
    
    array(
        'title' => '文章设置',
        'id'    => 'panel_aritical',
        'type'  => 'panelstart'
    ),
    
    array(
        'title' => '列表文章属性',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '访客数',
        'desc'  => '不显示',
        'id'    => 'git_post_views_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '作者名',
        'desc'  => '不显示',
        'id'    => 'git_post_author_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '评论数',
        'desc'  => '不显示',
        'id'    => 'git_post_comment_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '发布时间',
        'desc'  => '不显示',
        'id'    => 'git_post_time_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '喜欢数',
        'desc'  => '不显示',
        'id'    => 'git_post_like_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '文章摘要',
        'desc'  => '个字',
        'id'    => 'git_excerpt_length',
        'type'  => 'number',
        'std'   => 180
    ),
    array(
        'name'  => '文章二维码',
        'desc'  => '启用',
        'id'    => 'git_qr_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '自动超链接',
        'desc'  => '启用【就是那种可以把一个链接自动变成可以点击的超链接】',
        'id'    => 'git_linktrue_b',
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '首行缩进',
        'desc'  => '禁用【默认是有首行缩进的，但是某些时候不太好，选择此选项可以禁用】',
        'id'    => "git_nosuojin_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '相关文章显示条数',
        'desc'  => '条&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 这是是显示文章下面的相关文章数目的',
        'id'    => "git_related_count",
        'type'  => 'number',
        'std'   => 8
    ),
    array(
        'name'  => '禁止站内文章Pingback',
        'desc'  => '开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 开启后，不会发送站内Pingback，建议开启',
        'id'    => "git_pingback_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '禁止后台编辑时自动保存',
        'desc'  => '开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 开启后，后台编辑文章时候不会定时保存，有效缩减数据库存储量；但是，一般不建议开启，除非你的数据库容量很小',
        'id'    => "git_autosave_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '文章版权声明',
        'desc'  => '此处输入的文字将出现在每篇文章最底部，你可以使用：{{title}}表示文章标题，{{link}}表示文章链接',
        'id'    => "git_copyright_b",
        'type'  => 'textarea',
        'std'   => '乐趣公园 , 版权所有丨如未注明 , 均为原创丨本网站采用<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" rel="nofollow" target="_blank" title="BY-NC-SA授权协议">BY-NC-SA</a>协议进行授权 , 转载请注明<a href="{{link}}" target="_blank" title="{{title}}">{{title}}</a>！'
    ),
    array(
        'name'  => '文章页自定义代码',
        'desc'  => '此选项可放置作用于文章的css代码或者JavaScript代码块',
        'id'    => "git_singlecode_b",
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    ),
    
    array(
        'title' => '样式设置',
        'id'    => 'panel_header',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '导航栏设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '顶部悬浮菜单导航',
        'desc'  => '开启【开启后您的菜单导航就会悬停在网站顶部】',
        'id'    => "git_topnav_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '透明导航栏',
        'desc'  => '开启【开启后您的菜单导航栏就会变成半透明】',
        'id'    => "git_tmnav_b",
        'type'  => 'checkbox'
    ),
    array(
        'title' => '缩略图尺寸自定义，不选择这显示默认尺寸200*123[不建议选择]',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '宽度：',
        'desc'  => 'px',
        'id'    => "git_thumb_width",
        'type'  => 'number',
        'std'   => 200
    ),
    array(
        'name'  => '高度：',
        'desc'  => 'px',
        'id'    => "git_thumb_height",
        'type'  => 'number',
        'std'   => 123
    ),
    array(
        'title' => '网站头部设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '图片头部背景',
        'desc'  => '开启【开启后您的头部背景将显示默认背景图，不开启则显示默认纯色背景】',
        'id'    => "git_pichead_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '自定义头部背景',
        'desc'  => '请在这里输入您的图片路径',
        'id'    => 'git_customhead',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '图片头部logo',
        'desc'  => '开启【开启后您的头部背景将显示默认图片logo，不开启则显示默认文字logo】',
        'id'    => "git_piclogo_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '自定义头部logo',
        'desc'  => '请在这里输入您的图片路径',
        'id'    => 'git_customlogo',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => 'logo居左',
        'desc'  => '开启【开启后您的logo将居左显示】',
        'id'    => "git_piclogo_left",
        'type'  => 'checkbox'
    ),
    array(
        'title' => '主题皮肤设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '网站配色',
        'desc'  => '选择一个色调作为您网站的主色调，如果这里的色彩还不够，您可以使用下面的自定义色彩',
        'id'    => "git_skin_b",
        'type'  => 'radio',
        'options' => array(
            '幽红色' => 'git_red_b',
            '深蓝色' => 'git_blue_b',
            '暗黑色' => 'git_black_b',
            '亮紫色' => 'git_purple_b',
            '淡黄色' => 'git_yellow_b',
            '轻蓝色' => 'git_light_b',
            '鲜绿色' => 'git_green_b'
        ),
        'std'   => 'git_light_b'
    ),
/*
获取单选的方法是
<?php if (git_get_option('git_skin_b') == 'git_red_b') ?>
*/ 
    array(
        'name'  => '自定义皮肤设置',
        'desc'  => '开启【开启后将使用下面的配色方案】<a rel="nofollow" href="http://tool.c7sky.com/webcolor/" target="_blank">获取颜色代码</a>',
        'id'    => "git_custom_color",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '颜色代码',
        'desc'  => '请在这里输入你选择的颜色代码，举例：#000000',
        'id'    => 'git_color_nom',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => 'Hover颜色代码',
        'desc'  => '请在这里输入你选择的Hover颜色代码，一般这里的颜色和上面的一样，只是会略深而已',
        'id'    => 'git_color_hover',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'title' => '主题侧边栏跟随设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '侧边栏跟随',
        'desc'  => '开启【开启后为下面的选项选择侧边栏序号】',
        'id'    => "git_sideroll_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '第一个侧边栏：',
        'desc'  => '跟随',
        'id'    => "git_sideroll_1",
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '第二个侧边栏：',
        'desc'  => '跟随',
        'id'    => "git_sideroll_2",
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '幻灯设置',
        'id'    => 'panel_slide',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '幻灯片【豪华版】设置[716*297]',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '是否开启',
        'desc'  => '开启【开启后请设置4篇以上的置顶文章,文章第一张图片为716*297】',
        'id'    => "git_sticky_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '移动端不显示',
        'desc'  => '开启',
        'id'    => "git_mobilesticky_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '幻灯片显示数目',
        'desc'  => '个',
        'id'    => 'git_sticky_count',
        'type'  => 'number',
        'std'   => '4'
    ),
    array(
        'title' => '幻灯片【简约版】设置[855*300]',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '是否开启',
        'desc'  => '开启【本幻灯片与上方幻灯片不能同时开启，否则DUANG！！！】',
        'id'    => "git_slick_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '幻灯片一图片',
        'desc'  => '在这里输入您的幻灯片的图片路径',
        'id'    => "git_slick1img_b",
        'type'  => 'text',
        'std'   => 'http://i1.tietuku.com/4d78aebacd716fa1.png'
    ),
    array(
        'name'  => '幻灯片一链接',
        'desc'  => '在这里输入您的幻灯片的引用链接',
        'id'    => "git_slick1url_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片一标题',
        'desc'  => '在这里输入您的幻灯片的标题',
        'id'    => "git_slick1title_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片二图片',
        'desc'  => '在这里输入您的幻灯片的图片路径',
        'id'    => "git_slick2img_b",
        'type'  => 'text',
        'std'   => 'http://i1.tietuku.com/8cc27226d364646d.png'
    ),
    array(
        'name'  => '幻灯片二链接',
        'desc'  => '在这里输入您的幻灯片的引用链接',
        'id'    => "git_slick2url_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片二标题',
        'desc'  => '在这里输入您的幻灯片的标题',
        'id'    => "git_slick2title_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片三图片',
        'desc'  => '在这里输入您的幻灯片的图片路径',
        'id'    => "git_slick3img_b",
        'type'  => 'text',
        'std'   => 'http://i1.tietuku.com/10b38e0699c19f13.png'
    ),
    array(
        'name'  => '幻灯片三链接',
        'desc'  => '在这里输入您的幻灯片的引用链接',
        'id'    => "git_slick3url_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片三标题',
        'desc'  => '在这里输入您的幻灯片的标题',
        'id'    => "git_slick3title_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片四图片',
        'desc'  => '在这里输入您的幻灯片的图片路径',
        'id'    => "git_slick4img_b",
        'type'  => 'text',
        'std'   => 'http://i1.tietuku.com/e363019d7956a1b8.png'
    ),
    array(
        'name'  => '幻灯片四链接',
        'desc'  => '在这里输入您的幻灯片的引用链接',
        'id'    => "git_slick4url_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片四标题',
        'desc'  => '在这里输入您的幻灯片的标题',
        'id'    => "git_slick4title_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片五图片',
        'desc'  => '在这里输入您的幻灯片的图片路径',
        'id'    => "git_slick5img_b",
        'type'  => 'text',
        'std'   => 'http://i1.tietuku.com/4be202dae236d98e.png'
    ),
    array(
        'name'  => '幻灯片五链接',
        'desc'  => '在这里输入您的幻灯片的引用链接',
        'id'    => "git_slick5url_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片五标题',
        'desc'  => '在这里输入您的幻灯片的标题',
        'id'    => "git_slick5title_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片六图片',
        'desc'  => '在这里输入您的幻灯片的图片路径',
        'id'    => "git_slick6img_b",
        'type'  => 'text',
        'std'   => 'http://i1.tietuku.com/15ff831524d8bbde.png'
    ),
    array(
        'name'  => '幻灯片六链接',
        'desc'  => '在这里输入您的幻灯片的引用链接',
        'id'    => "git_slick6url_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '幻灯片六标题',
        'desc'  => '在这里输入您的幻灯片的标题',
        'id'    => "git_slick6title_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '分类设置',
        'id'    => 'panel_cat',
        'type'  => 'panelstart'
    ),
    array(
        'name'  => '分类banner图',
        'desc'  => '启用【启用后，再分类目录那里的图片描述里面添加img图片链接】',
        'id'    => "git_cattu_b",
        'type'  => 'checkbox'
    ),
    array(
        'title' => 'CMS分类布局',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '是否开启',
        'desc'  => '启用',
        'id'    => "git_cms_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '分类一',
        'desc'  => '启用',
        'id'    => 'git_cat_1',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '分类二',
        'desc'  => '启用',
        'id'    => 'git_cat_2',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '分类三',
        'desc'  => '启用',
        'id'    => 'git_cat_3',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '分类四',
        'desc'  => '启用',
        'id'    => 'git_cat_4',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '分类五',
        'desc'  => '启用',
        'id'    => 'git_cat_5',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '分类六',
        'desc'  => '启用',
        'id'    => 'git_cat_6',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '分类七',
        'desc'  => '启用',
        'id'    => 'git_cat_7',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '分类八',
        'desc'  => '启用',
        'id'    => 'git_cat_8',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'title' => '首页隐藏分类',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '是否开启',
        'desc'  => '启用',
        'id'    => "git_blockcat_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '屏蔽分类一',
        'desc'  => '启用',
        'id'    => 'git_blockcat_1',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'name'  => '屏蔽分类二',
        'desc'  => '启用',
        'id'    => 'git_blockcat_2',
        'type'  => 'number',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '社交设置',
        'id'    => 'panel_ad',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '社交小图标，空置默认为不启用，建议别超过六个',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => 'RSS订阅地址',
        'desc'  => '如果您想使用自定义的RSS地址，请在这里输入您期望的地址。',
        'id'    => 'git_rss_url',
        'type'  => 'text',
        'std'   => get_bloginfo('rss2_url')
    ),
    array(
        'name'  => '新浪微博',
        'desc'  => '填写新浪微博个人主页链接',
        'id'    => 'git_weibo',
        'type'  => 'text',
        'std'   => 'http://weibo.com/igooglo'
    ),
    array(
        'name'  => '腾讯微博',
        'desc'  => '填写腾讯微博个人主页链接',
        'id'    => 'git_tqq',
        'type'  => 'text',
        'std'   => 'http://t.qq.com/sp865113728'
    ),
    array(
        'name'  => '腾讯微信',
        'desc'  => '请输入您的微信号',
        'id'    => 'git_weixin_b',
        'type'  => 'text',
        'std'   => 'yunluoV587'
    ),
    array(
        'name'  => '微信二维码',
        'desc'  => '请输入您的二维码图片路径',
        'id'    => 'git_weixin_qr',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '腾讯QQ',
        'desc'  => '直接输入QQ号即可',
        'id'    => 'git_qqContact',
        'type'  => 'text',
        'std'   => '865113728'
    ),
    array(
        'name'  => 'Email',
        'desc'  => '请填写好您的邮我代码，<a class="button-primary" rel="nofollow" href="http://web.chacuo.net/color" target="_blank">获取颜色代码</a>',
        'id'    => 'git_emailContact',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '百度贴吧',
        'desc'  => '',
        'id'    => 'git_baidu',
        'type'  => 'text',
        'std'   => 'http://tieba.baidu.com/home/main?un=%E6%97%A0%E6%B3%95%E8%AF%89%E8%AF%B4%E7%9A%84%E5%90%9F%E8%8D%A1&ie=utf-8'
    ),
    array(
        'name'  => '支付宝',
        'desc'  => '',
        'id'    => 'git_pay',
        'type'  => 'text',
        'std'   => 'sp91@qq.com'
    ),
    array(
        'name'  => '支付宝二维码',
        'desc'  => '请输入您的支付宝图片路径',
        'id'    => 'git_pay_qr',
        'type'  => 'text',
        'std'   => 'http://i1.tietuku.com/d6c43b39f0c3c64c.jpg'
    ),
    array(
        'name'  => 'GitHub',
        'desc'  => '',
        'id'    => 'git_git',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '底部设置',
        'id'    => 'panel_footer',
        'type'  => 'panelstart'
    ),
    array(
        'name'  => '超级Footer',
        'desc'  => '启用【开启后，下面的设置才会有效】',
        'id'    => "git_superfoot_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => 'Footer1标题',
        'desc'  => '在这里输入第一个footer的标题',
        'id'    => "git_foottitle1",
        'type'  => 'text',
        'std'   => '版权声明'
    ),
    array(
        'name'  => 'Footer1内容',
        'desc'  => '在这里输入第一个footer的内容',
        'id'    => "git_footconent1",
        'type'  => 'textarea',
        'std'   => "本站的文章和资源来自互联网或者站 长的原创，按照CC BY-NC-SA 3.0 CN 协议发布和共享，转载或引用本站文章 应遵循相同协议。如果有侵犯版权的资 源请尽快联系站长，我们会在24h内 删除有争议的资源。"
    ),
    array(
        'name'  => 'Footer2标题',
        'desc'  => '在这里输入第二个footer的标题',
        'id'    => "git_foottitle2",
        'type'  => 'text',
        'std'   => '网站驱动'
    ),
    array(
        'name'  => 'Footer2内容',
        'desc'  => '在这里输入第二个footer的内容',
        'id'    => "git_footconent2",
        'type'  => 'textarea',
        'std'   => '<ul><li><a href="http://googlo.me/go/hengtian" title="横天主机" target="_blank">横天主机</a></li>
<li><a href="http://googlo.me/go/qiniu" title="七牛云" target="_blank">七牛云</a></li>
<li><a href="http://www.dbfen.com/index.php/users/newuser_by/0A8CD12B" title="多备份" target="_blank">多备份</a></li></ul>'
    ),
    array(
        'name'  => 'Footer3标题',
        'desc'  => '在这里输入第三个footer的标题',
        'id'    => "git_foottitle3",
        'type'  => 'text',
        'std'   => '友情链接'
    ),
    array(
        'name'  => 'Footer3内容',
        'desc'  => '在这里输入第三个footer的内容',
        'id'    => "git_footconent3",
        'type'  => 'textarea',
        'std'   => '<ul><li><a href="http://weibo.com/igooglo" title="云落的新浪微博" target="_blank">云落的新浪微博</a></li>
<li><a href="http://t.qq.com/sp865113728" title="云落的腾讯微博" target="_blank">云落的腾讯微博</a></li>
<li><a href="http://git.oschina.net/yunluo/" title="云落的代码" target="_blank">云落的代码</a></li>
<li><a href="http://tieba.baidu.com/home/main?un=%E6%97%A0%E6%B3%95%E8%AF%89%E8%AF%B4%E7%9A%84%E5%90%9F%E8%8D%A1&ie=utf-8&fr=frs" title="云落的贴吧" target="_blank">云落的贴吧</a></li>
<li><a href="http://googlo.me/" title="云落的网站" target="_blank">云落的网站</a></li></ul>'
    ),
    array(
        'name'  => 'Footer4标题',
        'desc'  => '在这里输入第四个footer的标题',
        'id'    => "git_foottitle4",
        'type'  => 'text',
        'std'   => '支持主题'
    ),
    array(
        'name'  => 'Footer4内容',
        'desc'  => '在这里输入第四个footer的内容',
        'id'    => "git_footconent4",
        'type'  => 'textarea',
        'std'   => '<img src="http://i1.tietuku.com/d6c43b39f0c3c64c.jpg" alt="yunluo">'
    ),
    array(
        'name'  => '网站footer公共代码',
        'desc'  => '在全站页面footer部分出现，可放置网站的版权信息等等',
        'id'    => 'git_footcode',
        'type'  => 'textarea',
        'std'   => '<a rel="nofollow" target="_blank" href="/about.html">关于网站</a>   |  <a rel="nofollow" target="_blank" href="/tags.html">标签汇总</a>   |  <a rel="nofollow" target="_blank" href="/archive.html">文章归档</a>   |  <a rel="nofollow" target="_blank" href="/links.html">友情链接</a>   |   <a href="/sitemap.html" target="_blank" title="站点地图（HTML版）">网站地图</a>   |  由 <a rel="nofollow" target="_blank" href="/go/hengtian">衡天主机</a> &amp; <a rel="nofollow" target="_blank" href="/go/qiniu">七牛</a>  强力驱动'
    ),
    array(
        'name'  => '全站底部脚本代码',
        'desc'  => '可放置广告代码等自定义（css或js）的全局代码块',
        'id'    => 'git_footercode',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '广告设置',
        'id'    => 'panel_ads',
        'type'  => 'panelstart'
    ),
    array(
        'name'  => '网站顶部广告',
        'desc'  => '开启',
        'id'    => 'git_toubuads',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '广告：弹窗下载广告',
        'desc'  => '开启【广告区域，任意联盟广告和自定义广告的代码均可】',
        'id'    => 'git_fancydlad',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '弹窗下载版权声明',
        'desc'  => '开启【就是那种本文件收集自网络，有问题联系站长那些装X的文字】',
        'id'    => 'git_fancydlcp',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '广告：404页面广告',
        'desc'  => '开启',
        'id'    => 'git_404ad',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '广告：全站 - 导航下横幅',
        'desc'  => '开启',
        'id'    => 'git_adsite_01',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '广告：全站正文列表最前',
        'desc'  => '开启',
        'id'    => 'git_adindex_02',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '广告：首页 - 导航下横幅',
        'desc'  => '开启',
        'id'    => 'git_adindex_01',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '广告：首页 - 正文最前上',
        'desc'  => '开启',
        'id'    => 'git_adindex_03',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '广告：文章页 - 页面标题下',
        'desc'  => '开启',
        'id'    => 'git_adpost_01',
        'type'  => 'textarea',
        'std'   => '<a target="_blank" href="http://googlo.me/go/hengtian"><img style="width:100%" src="http://i2.tietuku.com/24a66f5351e84813.jpg" title="立刻购买专业WordPress主机-衡天主机" alt="立刻购买专业WordPress主机-衡天主机" ></a>'
    ),
    array(
        'name'  => '广告：文章页 - 相关文章下',
        'desc'  => '开启',
        'id'    => 'git_adpost_02',
        'type'  => 'textarea',
        'std'   => '<a target="_blank" href="http://googlo.me/go/hengtian"><img style="width:100%" src="http://i2.tietuku.com/24a66f5351e84813.jpg" title="立刻购买专业WordPress主机-衡天主机" alt="立刻购买专业WordPress主机-衡天主机" ></a>'
    ),
    array(
        'name'  => '广告：文章页 - 网友评论下',
        'desc'  => '开启',
        'id'    => 'git_adpost_03',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '手机广告：全站正文列表最',
        'desc'  => '开启【手机广告只适合在手机中投放。例如百度联盟移动广告，PC端不会显示。下同】',
        'id'    => 'Mobiled_adindex_02',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '手机广告：文章页 - 页面标题下',
        'desc'  => '开启',
        'id'    => 'Mobiled_adpost_01',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'name'  => '手机广告：文章页 - 相关文章下',
        'desc'  => '开启',
        'id'    => 'Mobiled_adpost_02',
        'type'  => 'textarea',
        'std'   => ''
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '插件设置',
        'id'    => 'panel_plugin',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '本页面中的一些功能主要是为了替代一些插件，可能会和一些插件发生冲突',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '图片弹窗',
        'desc'  => '启用  【网站常用的功能，建议开启】',
        'id'    => "git_fancybox_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '屏蔽谷歌字体',
        'desc'  => '启用  【貌似谷歌字体国内已经可以访问了，是否开启看心情吧】',
        'id'    => "git_fuckziti_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '链接去掉Categroy',
        'desc'  => '启用   【开启这个功能之后如果发生404的话，前往固定链接重新保存一下】',
        'id'    => "git_categroy_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '头像旋转',
        'desc'  => '启用',
        'id'    => "git_avataer_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '百度收录提示',
        'desc'  => '启用   【鸡肋功能，其实并不是太准确的，作为一个装X的功能挺不错的】',
        'id'    => "git_baidurecord_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '网站下雪特效',
        'desc'  => '启用    【鸡肋功能，开启后网站会有一定成的卡顿】',
        'id'    => "git_snow_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '留言链接二维码',
        'desc'  => '启用  【开启之后，您的留言者的网站会生成一个二维码】',
        'id'    => "git_autherqr_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '代码黑色主题',
        'desc'  => '启用  【启用非常流行的暗色主题】',
        'id'    => "git_darkhighlight_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '网站禁止复制',
        'desc'  => '启用    【启用后访客无法使用右键复制】',
        'id'    => "git_copy_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '复制弹窗提醒',
        'desc'  => '启用   【启用之后，访客复制之后会弹出提示弹窗】',
        'id'    => "git_copydialog_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '保存远程图片',
        'desc'  => '启用   【启用之后，会自动将文章里面的外链图片保存为本地图片，在媒体库里面不显示图片内容，只显示缩略图】',
        'id'    => "git_yuanpic_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '页面伪静态',
        'desc'  => '启用   【开启之后，请前往固定连接重新保存一下，否则404】',
        'id'    => "git_pagehtml_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '评论UA',
        'desc'  => '启用',
        'id'    => "git_ua_b",
        'type'  => 'checkbox'
    ),
    array(
        'type'  => 'panelend'
    ),
    array(
        'title' => '高级设置',
        'id'    => 'panel_advence',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '新浪微博同步设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '是否开启',
        'desc'  => '启用',
        'id'    => "git_sinasync_b",
        'type'  => 'checkbox'
    ),
    array(
        'name'  => '新浪用户名',
        'desc'  => '最好输入您的微博的登陆邮箱',
        'id'    => "git_wbuser_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '新浪密码',
        'desc'  => '请输入您的微博密码',
        'id'    => "git_wbpasd_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '新浪appkey',
        'desc'  => '请输入您的微博appkey，这个需要您自己去<a class="button-primary" target="_blank" href="http://open.weibo.com/webmaster/add" title="微博开放平台">微博开放平台</a>申请',
        'id'    => "git_wbpasd_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'title' => '七牛云CDN设置',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '七牛自定义域名',
        'desc'  => '输入您的七牛云自定义域名，必须带http://  如果留空则禁用七牛云CDN功能  <a class="button-primary" target="_blank" href="http://googlo.me/go/qiniu" title="注册七牛">注册七牛</a>',
        'id'    => "git_cdnurl_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'title' => 'STMP邮箱设置【为了稳定考虑，未使用HTTPS模式】',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => '发件人地址',
        'desc'  => '请输入您的邮箱地址',
        'id'    => "git_maildizhi_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '发件人昵称',
        'desc'  => '请输入您的网站名称',
        'id'    => "git_mailnichen_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => 'SMTP服务器地址',
        'desc'  => '请输入您的邮箱的SMTP服务器，查看<a class="button-primary" target="_blank" href="http://wenku.baidu.com/link?url=Xc_mRFw2K-dimKX845QalqLpZzly07mC4a_t_QjOSPov0uFx3MWTl3wgw4tOAyTbDlS7lT8TOAj8VOxDYU186wQLKPt1fKncz7k_jbP_RQi">查看常用SMTP地址</a>',
        'id'    => "git_mailsmtp_b",
        'type'  => 'text',
        'std'   => 'smtp.qq.com'
    ),
    array(
        'name'  => 'SMTP服务器端口',
        'desc'  => '请输入您的smtp端口，一般QQ邮箱25就可以了',
        'id'    => "git_mailport_b",
        'type'  => 'text',
        'std'   => '25'
    ),
    array(
        'name'  => '邮箱账号',
        'desc'  => '请输入您的邮箱地址，比如云落的sp91@qq.com',
        'id'    => "git_mailuser_b",
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '邮箱密码',
        'desc'  => '请输入您的邮箱密码',
        'id'    => "git_mailpass_b",
        'type'  => 'text',
        'std'   => ''
    ),
        array(
        'name'  => 'Gravatar头像设置',
        'desc'  => '任选一个合适的头像解决方案，另外，如果选择本地缓存的话，请在WordPress根目录（wp-content同级）',
        'id'    => "git_avater",
        'type'  => 'radio',
        'options' => array(
            'SSL访问' => 'git_avatar_ssl',
            '多说镜像' => 'git_avatar_ds',
            '七牛镜像' => 'git_avatar_qn',
            '本地缓存' => 'git_avatar_b'
        ),
        'std'   => 'git_avatar_qn'
    ),
    array(
        'type'  => 'panelend'
    )
);

function git_add_theme_options_page() {
    global $options;
    if ($_GET['page'] == basename(__FILE__)) {
        if ('update' == $_REQUEST['action']) {
            foreach($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }
            update_option('git_options_setup', true);
            header('Location: themes.php?page=theme-options.php&update=true');
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option($value['id']);
            }
            delete_option('git_options_setup');
            header('Location: themes.php?page=theme-options.php&reset=true');
            die;
        }
    }
    add_theme_page('主题选项', '主题选项', 'edit_theme_options', basename(__FILE__) , 'git_options_page');
}
add_action('admin_menu', 'git_add_theme_options_page');

function git_options_page() {
    global $options;
    $optionsSetup = git_get_option('git_options_setup') != '';
    if ($_REQUEST['update']) echo '<div class="updated"><p><strong>设置已保存。</strong></p></div>';
    if ($_REQUEST['reset']) echo '<div class="updated"><p><strong>设置已重置。</strong></p></div>';
?>

<div class="wrap">
    <h2>Git 主题选项&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="button-primary" type="button" value="主题主页" onclick="window.open('http://googlo.me/archives/3011.html')">&nbsp;&nbsp;<input class="button-primary" type="button" value="邮箱反馈" onclick="window.open('http://googlo.me/go/mail')">&nbsp;&nbsp;<input class="button-primary" type="button" value="支持主题" onclick="window.open('http://googlo.me/pay')">&nbsp;&nbsp;<input class="button-primary" type="button" value="功能建议" onclick="window.open('http://googlo.me/about.html')">&nbsp;&nbsp;<input class="button-primary" type="button" value="食用文档" onclick="window.open('http://googlo.me/archives/3275.html')">&nbsp;&nbsp;<input class="button-primary" type="button" value="定制修改" onclick="window.open('http://googlo.me/go/qq')">&nbsp;&nbsp;<input class="button-primary" type="button" value="加入QQ群" onclick="window.open('http://googlo.me/go/qun')"></h2>
    <input placeholder="筛选主题选项…" type="search" id="theme-options-search" />
    <div class="yunluotips"><?php echo file_get_contents( "https://coding.net/u/googlo/p/api/git/raw/master/notice.txt" ); ?></div>
    <div class="catlist">您的网站分类列表：<?php echo Bing_show_category(); ?></div>
    <form method="post">
        <h2 class="nav-tab-wrapper">
<?php
$panelIndex = 0;
foreach ($options as $value ) {
    if ( $value['type'] == 'panelstart' ) echo '<a href="#' . $value['id'] . '" class="nav-tab' . ( $panelIndex == 0 ? ' nav-tab-active' : '' ) . '">' . $value['title'] . '</a>';
    $panelIndex++;
}
echo '<a href="#about_theme" class="nav-tab">关于主题</a>';

?>
</h2>

<?php
$panelIndex = 0;
foreach ($options as $value) {
switch ( $value['type'] ) {
    case 'panelstart':
        echo '<div class="panel" id="' . $value['id'] . '" ' . ( $panelIndex == 0 ? ' style="display:block"' : '' ) . '><table class="form-table">';
        $panelIndex++;
        break;
    case 'panelend':
        echo '</table></div>';
        break;
    case 'subtitle':
        echo '<tr><th colspan="2"><h3>' . $value['title'] . '</h3></th></tr>';
        break;
    case 'text':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="regular-text" id="<?php echo $value['id']; ?>" type='text' value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'number':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="small-text" id="<?php echo $value['id']; ?>" type="number" value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'textarea':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <p><label for="<?php echo $value['id']; ?>"><?php echo $value['desc']; ?></label></p>
        <p><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="5" cols="50" class="large-text code"><?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea></p>
    </td>
</tr>
<?php
    break;
    case 'select':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) : ?>
                <option value="<?php echo $option; ?>" <?php selected( get_option( $value['id'] ), $option); ?>>
                    <?php echo $option; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>

<?php
    break;
    case 'radio':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <?php foreach ($value['options'] as $name => $option) : ?>
        <label>
            <input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php echo $option; ?>" <?php checked( get_option( $value['id'] ), $option); ?>>
            <?php echo $name; ?>
        </label>
        <?php endforeach; ?>
        <p><span class="description"><?php echo $value['desc']; ?></span></p>
    </td>
</tr>
 
<?php
    break;
    case 'checkbox':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <label>
            <input type='checkbox' name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="1" <?php echo checked(get_option($value['id']), 1); ?> />
            <span><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>

<?php
    break;
    case 'checkboxs':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <?php $checkboxsValue = get_option( $value['id'] );
        if ( !is_array($checkboxsValue) ) $checkboxsValue = array();
        foreach ( $value['options'] as $id => $title ) : ?>
        <label>
            <input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>[]" value="<?php echo $id; ?>" <?php checked( in_array($id, $checkboxsValue), true); ?>>
            <?php echo $title; ?>
        </label>
        <?php endforeach; ?>
        <span class="description"><?php echo $value['desc']; ?></span>
    </td>
</tr>
 
<?php
    break;
}
}
?>
<div class="panel" id="about_theme">
<h2>主题的那些事</h2>
        <p>&nbsp;&nbsp;这款主题一开始来自于大前端的D8主题，优秀的D8主题在经过欲思这里，欲思对这款主题进行了大量的修改，对本款主题的流行起到了非常重要的作用。</p>
        <p>&nbsp;&nbsp;云落在正式建站的时候选择了这款主题并且一直使用到现在，期间对这款主题进行了N次的代码修改，有的地方是小修改，有的地方事一些大的修改，在欲思主题的基础上面做了很多二次开发，随着主题的修改进程，个人对WordPress的理解也随之加深，对于WordPress的应用也较以前有了更深的熟练。</p>
        <p>&nbsp;&nbsp;故，在经过多次修改后，自觉主题修改的足够对其更名以将其与欲思主题以区分，并且将其代码托管至<a href="http://git.oschina.net/yunluo/git" target="_blank">开源中国</a>，并且将其更名为：Git ！</p>
        <p>&nbsp;&nbsp;定名为Git，首先是因为主题采用Git版本系统管理代码的，写的最多的代码就是git了，另外G代表我的Googlo.Me，并且一直采用开源中国托管代码，遂定名为Git。</p>
        <p>&nbsp;&nbsp;感谢大前端的D8主题，感谢欲思的欲思主题，感谢小影的主题，感谢知更鸟的主题，感谢露兜博客，感谢devework，感谢开源中国，感谢一直跟随主题版本升级的朋友们</p>
<h2>支持云落</h2>
<p>如果您觉的这款主题很赞，欢迎您扫码支持云落</p>
<img style="width :300px;height :300px" src="http://i1.tietuku.com/d6c43b39f0c3c64c.jpg"></img>
<h2>联系云落</h2>
<a href="http://googlo.me/about.html" target="_blank">乐趣公园留言板</a>
</div>
<p class="submit">
    <input name="submit" type="submit" class="button button-primary" value="保存选项"/>
    <input type="hidden" name="action" value="update" />
</p>
</form>
<form method="post">
<p>
    <input name="reset" type="submit" class="button button-secondary" value="重置选项" onclick="return confirm('你确定要重置选项吗？');"/>
    <input type="hidden" name="action" value="reset" />
</p>
</form>
</div>
<style>.catlist{background-color:#FFB6C1;border:2px solid #FFB6C1;padding:5px;margin-top: 12px;text-align: center;color:#FFFFFF;}.catlist:hover{background-color:transparent;color: #000000}.yunluotips{border: 2px solid #FFCC33;padding: 20px}.yunluotips:hover{background: #FFCC33;}.panel{display:none}.panel h3{margin:0;font-size:1.2em}#panel_update ul{list-style-type:disc}.nav-tab-wrapper{clear:both}.nav-tab{position:relative}.nav-tab i:before{position:absolute;top:-10px;right:-8px;display:inline-block;padding:2px;border-radius:50%;background:#e14d43;color:#fff;content:"\f463";vertical-align:text-bottom;font:400 18px/1 dashicons;speak:none}#theme-options-search{display:none;float:right;margin-top:-34px;width:280px;font-weight:300;font-size:16px;line-height:1.5}.updated+#theme-options-search{margin-top:-91px}.wrap.searching .nav-tab-wrapper a,.wrap.searching .panel tr,#attrselector{display:none}.wrap.searching .panel{display:block !important}#attrselector[attrselector*=ok]{display:block}</style>
<style id="theme-options-filter"></style>
<div id="attrselector" attrselector="ok" ></div>
<script>
jQuery(function ($) {
    $(".nav-tab").click(function () {
        $(this).addClass("nav-tab-active").siblings().removeClass("nav-tab-active");
        $(".panel").hide();
        $($(this).attr("href")).show();
        return false;
    });

    var themeOptionsFilter = $("#theme-options-filter");
    themeOptionsFilter.text("ok");
    if ($("#attrselector").is(":visible") && themeOptionsFilter.text() != "") {
        $(".panel tr").each(function (el) {
            $(this).attr("data-searchtext", $(this).text().replace(/\r|\n/g, '').replace(/ +/g, ' ').toLowerCase());
        });

        var wrap = $(".wrap");
        $("#theme-options-search").show().on("input propertychange", function () {
            var text = $(this).val().replace(/^ +| +$/, "").toLowerCase();
            if (text != "") {
                wrap.addClass("searching");
                themeOptionsFilter.text(".wrap.searching .panel tr[data-searchtext*='" + text + "']{display:block}");
            } else {
                wrap.removeClass("searching");
                themeOptionsFilter.text("");
            };
        });
    };
});
</script>

<?php
}
//启用主题后自动跳转至选项页面
global $pagenow;
    if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
    {
        wp_redirect( admin_url( 'themes.php?page=theme-options.php' ) );
    exit;
}
function git_enqueue_pointer_script_style( $hook_suffix ) {
    $enqueue_pointer_script_style = false;
    $dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    if( !in_array( 'git_options_pointer', $dismissed_pointers ) ) {
        $enqueue_pointer_script_style = true;
        add_action( 'admin_print_footer_scripts', 'git_pointer_print_scripts' );
    }
    if( $enqueue_pointer_script_style ) {
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
    }
}
add_action( 'admin_enqueue_scripts', 'git_enqueue_pointer_script_style' );

function git_pointer_print_scripts() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        var $menuAppearance = $("#menu-appearance");
        $menuAppearance.pointer({
            content: '<h3>恭喜，Git 主题安装成功！</h3><p>该主题支持选项，请访问<a href="themes.php?page=theme-options.php">主题选项</a>页面进行配置。</p>',
            position: {
                edge: "left",
                align: "center"
            },
            close: function() {
                $.post(ajaxurl, {
                    pointer: "git_options_pointer",
                    action: "dismiss-wp-pointer"
                });
            }
        }).pointer("open").pointer("widget").find("a").eq(0).click(function() {
            var href = $(this).attr("href");
            $menuAppearance.pointer("close");
            setTimeout(function(){
                location.href = href;
            }, 700);
            return false;
        });

        $(window).on("resize scroll", function() {
            $menuAppearance.pointer("reposition");
        });
        $("#collapse-menu").click(function() {
            $menuAppearance.pointer("reposition");
        });
    });
    </script>

<?php
}