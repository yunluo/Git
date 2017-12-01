QTags.addButton( 'zyy', '引用',  "<blockquote>", "</blockquote>\n" );//添加引用
QTags.addButton( 'hr', '横线', "<hr />\n" );//添加横线
QTags.addButton( 'h2', 'H2标签', "<h2>", "</h2>\n" ); //添加标题2
QTags.addButton( 'h3', 'H3标签', "<h3>", "</h3>\n" ); //添加标题3
QTags.addButton( 'shsj', '首行缩进', "&nbsp;&nbsp;" );
QTags.addButton( 'hc', '回车', "<br />" );
QTags.addButton( 'jz', '居中', "<center>","</center>" );
QTags.addButton( 'mark', '黄字', "<mark>","</mark>" );
QTags.addButton( 'xhx', '下划线', "<u>","</u>" );
QTags.addButton( 'g</>', '</>', "&lt;", "&gt;" );
QTags.addButton( 'ipre', '代码高亮', '<pre class="prettyprint linenums" >\n\n</pre>', "" );//添加高亮代码
QTags.addButton( 'ilinks', '链接按钮', "[dm href='']", "[/dm]" );
QTags.addButton( 'idownload', '下载按钮', "[dl href='']", "[/dl]" );
QTags.addButton( 'ikaiyuan', '开源按钮', "[gt href='']开源地址[/gt]", "" );
QTags.addButton( 'v_notice', '绿色通知', "[v_notice]", "[/v_notice]" );
QTags.addButton( 'v_error', '红色警告', "[v_error]", "[/v_error]" );
QTags.addButton( 'v_warn', '黄色错误', "[v_warn]", "[/v_warn]" );
QTags.addButton( 'v_tips', '灰色提示', "[v_tips]", "[/v_tips]" );
QTags.addButton( 'v_blue', '蓝色提示', "[v_blue]", "[/v_blue]" );
QTags.addButton( 'v_act', '蓝边文本', "[v_act]", "[/v_act]" );
QTags.addButton( 'bs_notice', 'BS绿色', '<div class="alert alert-success" role="alert">', '</div>' );
QTags.addButton( 'bs_error', 'BS蓝色', '<div class="alert alert-info" role="alert">', '</div>' );
QTags.addButton( 'bs_warn', 'BS黄色', '<div class="alert alert-warning" role="alert">', '</div>' );
QTags.addButton( 'bs_tip', 'BS红色', '<div class="alert alert-error" role="alert">', '</div>' );
QTags.addButton( 'gb', '绿色按钮', "[gb href='']", "[/gb]" );
QTags.addButton( 'bb', '蓝色按钮', "[bb href='']", "[/bb]" );
QTags.addButton( 'yb', '黄色按钮', "[yb href='']", "[/yb]" );
QTags.addButton( 'lhb', '透明按钮', "[lhb href='']", "[/lhb]" );
QTags.addButton( 'netmusic', '网易云音乐', "[netmusic play='1']", "[/netmusic]" );
QTags.addButton( 'video', '视频按钮', "[video play='0']", "[/video]" );
QTags.addButton( 'audio', '音频按钮', "[audio play='0']", "[/audio]" );
QTags.addButton( 'collapse', '隐藏收缩', '[collapse title=""]\n\n[/collapse]', "" );
QTags.addButton( 'reply', '回复可见', "[reply]", "[/reply]" );
QTags.addButton( 'vip', '登录可见', "[vip]", "[/vip]" );
QTags.addButton( 'mimakejian', '密码可见', '[secret wx=0]', '[/secret]' );
QTags.addButton( 'fancydl', '弹窗下载', "[fanctdl filename='这里填写文件名' filesize='这里填写文件大小' href='这里填写的主下载链接' filedown='这里填写的是文件的主下载名称']这里填写的文件的辅助下载链接，A标签即可！[/fanctdl]" );
QTags.addButton( 'dltable', '下载面板', '[dltable file="在此处写下文件名称" size="在这里写下文件大小"]这里留文件下载A标签链接，可以放多个链接[/dltable]' );
QTags.addButton( 'download', '单页下载', "[download]", "[/download]" );
QTags.addButton( 'nextpage', '下一页', '<!--nextpage-->', "" );
QTags.addButton( 'demo', '代码演示', "[demo]", "[/demo]" );
QTags.addButton( 'phpcode', '运行PHP', '[phpcode file="文件名"]', "" );
QTags.addButton( 'nl', '文章内链', '[neilian ids=]', '');
QTags.addButton( 'wl', '文章外链', '[wailian]', '[/wailian]');
QTags.addButton( 'ulli', '无序列表', '[list]', '[/list]' );
QTags.addButton( 'pay', '付费查看', '[pay point="10"]', '[/pay]' );
//这儿共有四对引号，分别是按钮的ID、显示名、点一下输入内容、再点一下关闭内容（此为空则一次输入全部内容），\n表示换行。