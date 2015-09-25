<!--
苍茫的代码是我的爱！！！
如果你觉得主题的某个功能非常的棒，那么那肯定是云落（me@googlo.me）写的
如果你觉得主题的某个功能非常的弱智脑残，哦，鬼知道谁写的，反正不是我写的
-->
<!DOCTYPE HTML>
<html xmlns:wb=“http://open.weibo.com/wb”>
<head>
<meta charset="UTF-8">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<link href="/favicon.ico" rel="icon" type="image/x-icon" />
<?php
if (git_get_option('git_robot_b')): ?>
<?php
    if (is_single() || is_page() || is_home()): ?>
<meta name="robots" content="index,follow" />
<?php
    else: ?>
<meta name="robots" content="noindex,follow" />
<?php
    endif; ?>
<?php
endif; ?>
<?php
wp_head();
if (git_get_option('git_headcode')) echo git_get_option('git_headcode'); ?>
<title><?php
wp_title('' . git_get_option('git_delimiter') . '', true, 'right');
echo get_option('blogname');
if (is_home()) echo '' . git_get_option('git_delimiter') . '', get_option('blogdescription');
if ($paged > 1) echo '-Page ', $paged; ?></title>
<?php
$sr_1 = 0;
$sr_2 = 0;
$commenton = 0;
if (git_get_option('git_sideroll_b')) {
    $sr_1 = git_get_option('git_sideroll_1');
    $sr_2 = git_get_option('git_sideroll_2');
}
?>
<script>
window._deel = {name: '<?php
bloginfo('name') ?>',url: '<?php
echo get_bloginfo("template_url") ?>', ajaxpager: '<?php
echo git_get_option('git_ajaxpager_b') ?>', commenton: <?php
echo $commenton
?>, roll: [<?php
echo $sr_1
?>,<?php
echo $sr_2
?>]}
</script>
<!--[if lt IE 9]><script src="<?php
bloginfo('template_url'); ?>/js/html5.js"></script><![endif]-->
<?php
echo get_post_meta($post->ID, 'git_customer', true); ?>
</head>
<body <?php
body_class(); ?>>
<?php
if (!git_get_option('git_pichead_b')) { ?>
<?php
    if (git_get_option('git_skin_b') == 'git_red_b') {
        echo '<header id="header" class="header" style="background-color: #E74C3C;">';
    } elseif (git_get_option('git_skin_b') == 'git_blue_b') {
        echo '<header id="header" class="header" style="background-color: #003399;">';
    } elseif (git_get_option('git_skin_b') == 'git_black_b') {
        echo '<header id="header" class="header" style="background-color: #616161;">';
    } elseif (git_get_option('git_skin_b') == 'git_purple_b') {
        echo '<header id="header" class="header" style="background-color: #9932CC;">';
    } elseif (git_get_option('git_skin_b') == 'git_yellow_b') {
        echo '<header id="header" class="header" style="background-color: #f5e011;">';
    } elseif (git_get_option('git_skin_b') == 'git_light_b') {
        echo '<header id="header" class="header" style="background-color: #03A9F4;">';
    } elseif (git_get_option('git_skin_b') == 'git_green_b') {
        echo '<header id="header" class="header" style="background-color: #4CAF50;">';
    } elseif (git_get_option('git_skin_b') == 'git_custom_color') {
        echo '<header id="header" class="header" style="background-color: ' . git_get_option('git_color_nom') . ';">';
    } else {
        echo '<header id="header" class="header" style="background-color: #009966;">';
    } ?>
<?php
} ?>
<?php
if (git_get_option('git_pichead_b')) { ?>
<?php
    if (git_get_option('git_customhead')) { ?>
<header style="background: url('<?php
        echo git_get_option('git_customhead'); ?>') center 0px repeat-x;background-size: cover;background-repeat:repeat-x\9" id="header" class="header">
<?php
    } ?>
<?php
    if (!git_get_option('git_customhead')) { ?>
<header style="background: url('<?php
        bloginfo('template_url'); ?>/img/header.jpg') center 0px repeat-x;background-size: cover;" id="header" class="header">
<?php
    } ?><?php
} ?>
<?php
if (git_get_option('git_tmnav_b')) echo '<style type="text/css">#nav-header{background-color: rgba(85,84,85, 0.5);background: rgba(85,84,85, 0.5);color: rgba(85,84,85, 0.5);}</style>'; ?>
<?php
if (git_get_option('git_skin_b') == 'git_red_b') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #E74C3C;}.footer,.title h2{color: #E74C3C;}#footbar{border-top:#E74C3C;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #E74C3C;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #D52D1A;}</style>';
} elseif (git_get_option('git_skin_b') == 'git_blue_b') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #003399;}.footer,.title h2{color: #003399;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #003399;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #002266;}</style>';
} elseif (git_get_option('git_skin_b') == 'git_black_b') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #616161;}.footer,.title h2{color: #616161;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #616161;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #474747;}</style>';
} elseif (git_get_option('git_skin_b') == 'git_purple_b') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #9932CC;}.footer,.title h2{color: #9932CC;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #9932CC;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #7B28A4;}</style>';
} elseif (git_get_option('git_skin_b') == 'git_yellow_b') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #f5e011;}.footer,.title h2{color: #f5e011;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #f5e011;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: #C9B508;}</style>';
} elseif (git_get_option('git_skin_b') == 'git_light_b') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #03A9F4;}.footer,.title h2{color: #03A9F4;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #03A9F4;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: #2196F3;}</style>';
} elseif (git_get_option('git_skin_b') == 'git_green_b') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #4CAF50;}.footer,.title h2{color: #4CAF50;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #4CAF50;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: #388E3C;}</style>';
} elseif (git_get_option('git_skin_b') == 'git_custom_color') {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: ' . git_get_option('git_color_nom') . ';}.footer,.title h2{color: ' . git_get_option('git_color_nom') . ';}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: ' . git_get_option('git_color_nom') . ';}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: ' . git_get_option('git_color_hover') . ';}</style>';
} else {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit{background: #009966;}.footer,.title h2{color: #009966;}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: #009966;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: #008055;}</style>';
} ?>
<?php
if (git_get_option('git_avataer_b')) echo '<style type="text/css">.avatar{-webkit-transition:0.4s;-webkit-transition:-webkit-transform 0.4s ease-out;transition:transform 0.4s ease-out;-moz-transition:-moz-transform 0.4s ease-out;}.avatar:hover{transform:rotateZ(360deg);-webkit-transform:rotateZ(360deg);-moz-transform:rotateZ(360deg);}</style>'; ?>

<div class="container-inner"><?php
if (git_get_option('git_piclogo_left') && !G_is_mobile()) {
    echo '<div class="g-logo pull-left">';
} else {
    echo '<div align="center" class="g-logo">';
} ?><a href="/">
<?php
if (is_home()) {
    echo '<h1>';
} else {
    echo '<div class="h1logo" >';
} ?>
<?php
if (!git_get_option('git_piclogo_b')) { ?>
<span class="g-mono" style="font-family:楷体;"><?php
    bloginfo('name'); ?></span>  <span class="g-bloger" style="font-family:楷体;"><?php
    bloginfo('description'); ?></span><?php
} ?><?php
if (git_get_option('git_piclogo_b')) { ?><?php
    if (git_get_option('git_customlogo')) { ?><img alt="<?php
        bloginfo('name'); ?>" src="<?php
        echo git_get_option('git_customlogo'); ?>"><?php
    } ?><?php
    if (!git_get_option('git_customlogo')) { ?><img alt="<?php
        bloginfo('name'); ?>" src="<?php
        bloginfo('template_url'); ?>/img/logo.png"><?php
    } ?><?php
} ?>
<?php
if (is_home()) {
    echo '</h1>';
} else {
    echo '</div>';
} ?>
</a></div></div><div id="toubuads"><?php
if (git_get_option('git_toubuads') && git_get_option('git_piclogo_left') && !G_is_mobile()) echo git_get_option('git_toubuads'); ?></div>
<?php
if (git_get_option('git_skin_b') == 'git_red_b') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #E74C3C ;">';
} elseif (git_get_option('git_skin_b') == 'git_blue_b') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #003399 ;">';
} elseif (git_get_option('git_skin_b') == 'git_black_b') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #616161 ;">';
} elseif (git_get_option('git_skin_b') == 'git_purple_b') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #9932CC ;">';
} elseif (git_get_option('git_skin_b') == 'git_yellow_b') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #f5e011 ;">';
} elseif (git_get_option('git_skin_b') == 'git_light_b') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #03A9F4 ;">';
} elseif (git_get_option('git_skin_b') == 'git_green_b') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #4CAF50 ;">';
} elseif (git_get_option('git_skin_b') == 'git_custom_color') {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid ' . git_get_option('git_color_nom') . ' ;">';
} else {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #009966 ;">';
} ?>

<?php
if (git_get_option('git_bdshare_b')) echo '<style type="text/css">.bdsharebuttonbox a{cursor:pointer;border-bottom:0;margin-right:5px;width:28px;height:28px;line-height:28px;color:#fff}.bds_renren{background:#94b3eb}.bds_qzone{background:#fac33f}.bds_more{background:#40a57d}.bds_weixin{background:#7ad071}.bdsharebuttonbox a:hover{background-color:#7fb4ab;color:#fff;border-bottom:0}</style>'; ?>

<ul class="nav"><?php
echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array(
    'theme_location' => 'nav',
    'echo' => false
)))); ?>
<li style="float:right;"><div class="toggle-search"><i class="fa fa-search"></i></div><div class="search-expand" style="display: none;"><div class="search-expand-inner">
    <?php
if (git_get_option('git_search_baidu')) { ?>
    <?php
    echo git_get_option('git_search_code'); ?></div></div>
<?php
} elseif (git_get_option('git_search') && !git_get_option('git_search_baidu')) { ?>
<form method="get" class="searchform themeform" onsubmit="location.href='/?s=' + encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;" action="/"><div><input type="ext" class="search" name="s" onblur="if(this.value=='')this.value='<?php
    echo git_get_option('git_search_placeholder', '输入内容并回车'); ?>';" onfocus="if(this.value=='<?php
    echo git_get_option('git_search_placeholder', '输入内容并回车'); ?>')this.value='';" value="<?php
    echo git_get_option('git_search_placeholder', '输入内容并回车'); ?>"></div></form></div></div>
<?php
} elseif (!git_get_option('git_search') && !git_get_option('git_search_baidu')) { ?>
<form method="get" class="searchform themeform" onsubmit="location.href='<?php
    echo home_url('/search/'); ?>' + encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;" action="/"><div><input type="ext" class="search" name="s" onblur="if(this.value=='')this.value='<?php
    echo git_get_option('git_search_placeholder', '输入内容并回车'); ?>';" onfocus="if(this.value=='<?php
    echo git_get_option('git_search_placeholder', '输入内容并回车'); ?>')this.value='';" value="<?php
    echo git_get_option('git_search_placeholder', '输入内容并回车'); ?>"></div></form></div></div>
 <?php
} ?>
</li>
</ul>
</div></div>
</header>
<section class="container">
<div class="speedbar">
		<?php
if (git_get_option('git_sign_b')) {
    global $current_user;
    get_currentuserinfo();
    $uid = $current_user->ID;
    $u_name = get_user_meta($uid, 'nickname', true);
?>
			<div class="pull-right">
				<?php
    if (is_user_logged_in()) {
        echo '<i class="fa fa-user"></i> <a href="' . site_url() . '/wp-admin">' . $u_name . '</a> ';
    } elseif (get_option('users_can_register')) {
        echo '<i class="fa fa-user"></i> <a href="' . site_url() . '/wp-login.php?action=register">注册</a>';
    };
    echo '  <i class="fa fa-power-off"></i> ';
    echo wp_loginout();
    echo ''; ?>
			</div>
		<?php
} ?>
		<div class="toptip" id="callboard"><ul style="font-size:16px;margin-top: 2px;"><?php
echo git_get_option('git_tui'); ?></ul></div>
	</div>
<?php
if (git_get_option('git_adsite_01')) echo '<div class="banner banner-site">' . git_get_option('git_adsite_01') . '</div>'; ?>