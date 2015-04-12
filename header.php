<!-- 苍茫的代码是我的爱！！！  -->
<!DOCTYPE HTML>
<html xmlns:wb=“http://open.weibo.com/wb”>
<head>
<meta charset="UTF-8">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<?php

wp_head();
if (dopt('d_headcode_b')) echo dopt('d_headcode'); ?>
<title><?php
wp_title('-', true, 'right');
echo get_option('blogname');
if (is_home()) echo ' — ', get_option('blogdescription');
if ($paged > 1) echo '-Page ', $paged; ?></title>
<?php
$sr_1 = 0;
$sr_2 = 0;
$commenton = 0;
if (dopt('d_sideroll_b')) {
    $sr_1 = dopt('d_sideroll_1');
    $sr_2 = dopt('d_sideroll_2');
}
if (is_singular()) {
    if (comments_open()) $commenton = 1;
}
?>
<script>
window._deel = {name: '<?php
bloginfo('name') ?>',url: '<?php
echo get_bloginfo("template_url") ?>', ajaxpager: '<?php
echo dopt('d_ajaxpager_b') ?>', commenton: <?php
echo $commenton ?>, roll: [<?php
echo $sr_1 ?>,<?php
echo $sr_2 ?>]}
</script>
<!--[if lt IE 9]><script src="<?php bloginfo('template_url'); ?>/js/html5.js"></script><![endif]-->
<?php
if (dopt('d_nosuojin_b')) echo '<style type="text/css">.article-content{text-indent:0px;}</style>'; ?>
</head>
<body <?php
body_class(); ?>>
<?php if (dopt('d_topnav_b') && !G_is_mobile()) { ?>
<script type="text/Javascript">
$(function(){
	$('#nav-header').posfixed({
		distance : 0,
		pos : 'top',
		type : 'while',
		hide : false
	});
});
</script>
<style type="text/css">#nav-header{background-color: rgba(85,84,85);background: rgba(85,84,85);color: rgba(85,84,85,);}</style>
<?php } ?>
<?php
if (!dopt('d_pichead_b')) { ?>
<?php
    if (dopt('d_red_b')) {
        echo '<header id="header" class="header" style="background-color: #E74C3C;">';
    } elseif (dopt('d_blue_b')) {
        echo '<header id="header" class="header" style="background-color: #3B5998;">';
    } elseif (dopt('d_black_b')) {
        echo '<header id="header" class="header" style="background-color: #616161;">';
    } elseif (dopt('d_purple_b')) {
        echo '<header id="header" class="header" style="background-color: #9932CC;">';
    } elseif (dopt('d_yellow_b')) {
        echo '<header id="header" class="header" style="background-color: #f5e011;">';
    } elseif (dopt('d_custom_color')) {
        echo '<header id="header" class="header" style="background-color: ' . dopt('d_color_nom') . ';">';
    } else {
        echo '<header id="header" class="header" style="background-color: #03A9F4;">';
    } ?>
<?php
} ?>
<?php
if (dopt('d_pichead_b')) { ?>
<?php
    if (dopt('d_customhead_b')) { ?>
<header style="background: url('<?php
        echo dopt('d_customhead'); ?>') center 0px repeat-x;background-size: cover;" id="header" class="header">
<?php
    } ?>
<?php
    if (!dopt('d_customhead_b')) { ?>
<header style="background: url('<?php
        bloginfo('template_url'); ?>/img/header.jpg') center 0px repeat-x;background-size: cover;" id="header" class="header">
<?php
    } ?><?php
} ?>
<?php
if (dopt('d_pichead_b') || !dopt('d_topnav_b') ) echo '<style type="text/css">#nav-header{background-color: rgba(85,84,85, 0.5);background: rgba(85,84,85, 0.5);color: rgba(85,84,85, 0.5);}</style>'; ?>
<?php
if (dopt('d_red_b')) {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span{background: #E74C3C;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #E74C3C;}.footer{color: #E74C3C;}#footbar{border-top:#E74C3C;} </style>';
} elseif (dopt('d_blue_b')) {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span{background: #3B5998;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #3B5998;}.footer{color: #3B5998;}</style>';
} elseif (dopt('d_black_b')) {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span{background: #616161;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #616161;}.footer{color: #616161;}</style>';
} elseif (dopt('d_purple_b')) {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span{background: #9932CC;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover{background-color: #9932CC;}.footer{color: #9932CC;}</style>';
} elseif (dopt('d_yellow_b')) {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span{background: #f5e011;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: #f5e011;}.footer{color: #f5e011;}</style>';
} elseif (dopt('d_custom_color')) {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span{background: ' . dopt('d_color_nom') . ';}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: ' . dopt('d_color_hover') . ';}.footer{color: ' . dopt('d_color_nom') . ';}</style>';
} else {
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.btn,.pagination ul>.active>a,.pagination ul>.active>span{background: #03A9F4;}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.btn:hover {background-color: #2196F3;}.footer{color: #03A9F4;}</style>';
} ?>
<?php
if (dopt('d_avataer_b')) echo '<style type="text/css">.avatar{-webkit-transition:0.4s;-webkit-transition:-webkit-transform 0.4s ease-out;transition:transform 0.4s ease-out;-moz-transition:-moz-transform 0.4s ease-out;}.avatar:hover{transform:rotateZ(360deg);-webkit-transform:rotateZ(360deg);-moz-transform:rotateZ(360deg);}</style>'; ?>

<div class="container-inner"><?php
if (dopt('d_piclogo_left') && !G_is_mobile()) {
    echo '<div class="g-logo pull-left">';
} else {
    echo '<div align="center" class="g-logo">';
} ?><a href="/"><h1><?php
if (!dopt('d_piclogo_b')) { ?>
<span class="g-mono" style="font-family:楷体;"><?php
    bloginfo('name'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="g-bloger" style="font-family:楷体;"><?php
    bloginfo('description'); ?></span><?php
} ?><?php
if (dopt('d_piclogo_b')) { ?><?php
    if (dopt('d_customlogo_b')) { ?><img src="<?php
        echo dopt('d_customlogo'); ?>"><?php
    } ?><?php
    if (!dopt('d_customlogo_b')) { ?><img src="<?php
        bloginfo('template_url'); ?>/img/logo.png"><?php
    } ?><?php
} ?></h1></a></div></div><div id="toubuads"><?php
if (dopt('d_toubuads_b') && dopt('d_piclogo_left') && !G_is_mobile()) echo dopt('d_toubuads'); ?></div>

<?php
if (dopt('d_red_b')) {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #E74C3C ;">';
} elseif (dopt('d_blue_b')) {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #3B5998 ;">';
} elseif (dopt('d_black_b')) {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #616161 ;">';
} elseif (dopt('d_purple_b')) {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #9932CC ;">';
} elseif (dopt('d_yellow_b')) {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #f5e011 ;">';
} elseif (dopt('d_custom_color')) {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid ' . dopt('d_color_nom') . ' ;">';
} else {
    echo '<div id="nav-header" class="navbar" style="border-bottom: 4px solid #03A9F4 ;">';
} ?>

<?php
if (dopt('d_bdshare_b')) echo '<style type="text/css">.bdsharebuttonbox a{cursor:pointer;border-bottom:0;margin-right:5px;width:28px;height:28px;line-height:28px;color:#fff}.bds_renren{background:#94b3eb}.bds_qzone{background:#fac33f}.bds_more{background:#40a57d}.bds_weixin{background:#7ad071}.bdsharebuttonbox a:hover{background-color:#7fb4ab;color:#fff;border-bottom:0}</style>'; ?>

<ul class="nav"><?php
echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array(
    'theme_location' => 'nav',
    'echo' => false
)))); ?>
<li style="float:right;"><div class="toggle-search"><i class="fa fa-search"></i></div><div class="search-expand" style="display: none;"><div class="search-expand-inner"><form method="get" class="searchform themeform" onsubmit="location.href='<?php
echo home_url('/search/'); ?>' + encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;" action="/"><div> <input type="ext" class="search" name="s" onblur="if(this.value=='')this.value='输入内容并回车';" onfocus="if(this.value=='输入内容并回车')this.value='';" value="输入内容并回车"></div></form></div></div>
</li>
</ul>
</div></div>
</header>
<section class="container"><?php
if (dopt('d_tui_b')) { ?><div class="speedbar">
		<?php
    if (dopt('d_sign_b')) {
        global $current_user;
        get_currentuserinfo();
        $uid = $current_user->ID;
        $u_name = get_user_meta($uid, 'nickname', true);
?>
			<div class="pull-right">
				<?php
        if (is_user_logged_in()) {
            echo '<i class="fa fa-user"></i> <a href="/wp-admin">' . $u_name . '</a> ';
        } else {
            echo '<i class="fa fa-user"></i> <a href="/wp-login.php?action=register">注册</a>';
        };
        echo ' &nbsp; <i class="fa fa-power-off"></i> ';
        echo wp_loginout();
        echo ''; ?>
			</div>
		<?php
    } ?>
		<div class="toptip"><strong class="text-success"><i class="fa fa-volume-up"></i> </strong> <?php
    echo dopt('d_tui'); ?></div>
	</div>
	<?php
} ?>
	<?php
if (dopt('d_adsite_01_b')) echo '<div class="banner banner-site">' . dopt('d_adsite_01') . '</div>'; ?>