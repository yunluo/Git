<!--
代码如诗 , 如痴如醉 !
-->
<!DOCTYPE HTML>
<html xmlns:wb="http://open.weibo.com/wb" lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<link href="/favicon.ico" rel="icon" type="image/x-icon" />
<?php
if (git_get_option('git_robot_b')): ?>
<?php
    if (is_single() || is_home()): ?>
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
if (is_home() || is_front_page()) echo '' . git_get_option('git_delimiter') . '', get_option('blogdescription');
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
echo GIT_URL ?>', ajaxpager: '<?php
echo git_get_option('git_ajaxpager_b') ?>', commenton: <?php
echo $commenton
?>, roll: [<?php
echo $sr_1
?>,<?php
echo $sr_2
?>]}
</script>
<!--[if lt IE 9]><script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script><![endif]-->
<?php
if (git_get_option('git_customcss')) echo '<style type="text/css">'.git_get_option('git_customcss').'</style>'; ?>
</head>
<?php flush(); ?>
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
        echo esc_url( GIT_URL ); ?>/assets/img/header.jpg') center 0px repeat-x;background-size: cover;" id="header" class="header">
<?php
    } ?><?php
} ?>
<?php
if (git_get_option('git_tmnav_b')) echo '<style type="text/css">#nav-header{background-color: rgba(85,84,85, 0.5);background: rgba(85,84,85, 0.5);color: rgba(85,84,85, 0.5);}</style>'; ?>
<?php
if (git_get_option('git_skin_b') == 'git_red_b') {
    $skin_nom = '#E74C3C';
    $skin_hover = '#D52D1A';
}elseif (git_get_option('git_skin_b') == 'git_blue_b'){
    $skin_nom = '#003399';
    $skin_hover = '#002266';
}elseif (git_get_option('git_skin_b') == 'git_black_b'){
    $skin_nom = '#616161';
    $skin_hover = '#474747';
}elseif (git_get_option('git_skin_b') == 'git_purple_b'){
    $skin_nom = '#9932CC';
    $skin_hover = '#7B28A4';
}elseif (git_get_option('git_skin_b') == 'git_yellow_b'){
    $skin_nom = '#f5e011';
    $skin_hover = '#C9B508';
}elseif (git_get_option('git_skin_b') == 'git_light_b'){
    $skin_nom = '#03A9F4';
    $skin_hover = '#2196F3';
}elseif (git_get_option('git_skin_b') == 'git_green_b'){
    $skin_nom = '#4CAF50';
    $skin_hover = '#388E3C';
}elseif (git_get_option('git_skin_b') == 'git_custom_color'){
    $skin_nom = git_get_option('git_color_nom');
    $skin_hover = git_get_option('git_color_hover');
}
    echo '<style type="text/css">.navbar .nav li:hover a, .navbar .nav li.current-menu-item a, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a, .navbar .nav li.current-post-ancestor a,.toggle-search ,#submit ,.pagination ul>.active>a,.pagination ul>.active>span,.bdcs-container .bdcs-search-form-submit,.metacat a{background: ' . $skin_nom . ';}.footer,.title h2,.card-item .cardpricebtn{color: ' . $skin_nom . ';}.bdcs-container .bdcs-search-form-submit ,.bdcs-container .bdcs-search {border-color: ' . $skin_nom . ';}.pagination ul>li>a:hover,.navbar .nav li a:focus, .navbar .nav li a:hover,.toggle-search:hover,#submit:hover,.cardpricebtn .cardbuy {background-color: ' . $skin_hover . ';}.tooltip-inner{background-color:' . $skin_hover . ';}.tooltip.top .tooltip-arrow{border-top-color:' . $skin_hover . ';}.tooltip.right .tooltip-arrow{border-right-color:' . $skin_hover . ';}.tooltip.left .tooltip-arrow{border-left-color:' . $skin_hover . ';}.tooltip.bottom .tooltip-arrow{border-bottom-color:' . $skin_hover . ';}</style>';
?>

<div class="container-inner"><?php
if (git_get_option('git_piclogo_left') && !git_is_mobile()) {
    echo '<div class="g-logo pull-left">';
} else {
    echo '<div class="g-logo pull-center">';
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
    if (git_get_option('git_customlogo')) { ?><img title="<?php
        bloginfo('name'); ?>" alt="<?php
        bloginfo('name'); ?>" src="<?php
        echo git_get_option('git_customlogo'); ?>"><?php
    } ?><?php
    if (!git_get_option('git_customlogo')) { ?><img title="<?php
        bloginfo('name'); ?>" alt="<?php
        bloginfo('name'); ?>" src="<?php
        echo esc_url( GIT_URL ); ?>/assets/img/logo.png"><?php
    } ?><?php
} ?>
<?php
if (is_home()) {
    echo '</h1>';
} else {
    echo '</div>';
} ?>
</a></div></div><div id="toubuads"><?php
if (git_get_option('git_toubuads') && git_get_option('git_piclogo_left') && !git_is_mobile()) echo git_get_option('git_toubuads'); ?></div>
<?php
switch ( git_get_option('git_skin_b') ){
  case 'git_red_b':
  $navcolor = '#E74C3C';
  break;
  case 'git_blue_b':
  $navcolor = '#003399';
  break;
  case 'git_black_b':
  $navcolor = '#616161';
  break;
  case 'git_purple_b':
  $navcolor = '#9932CC';
  break;
  case 'git_yellow_b':
  $navcolor = '#f5e011';
  break;
  case 'git_light_b':
  $navcolor = '#03A9F4';
  break;
  case 'git_green_b':
  $navcolor = '#4CAF50';
  break;
  case 'git_custom_color':
  $navcolor = git_get_option('git_color_nom');
  break;
  default:
  $navcolor = '#009966';
}?>
<div id="nav-header" class="navbar" style="border-bottom: 4px solid <?php echo $navcolor;?> ;">
<?php
if (git_get_option('git_bdshare_b')) echo '<style type="text/css">.bdsharebuttonbox a{cursor:pointer;border-bottom:0;margin-right:5px;width:28px;height:28px;line-height:28px;color:#fff}.bds_renren{background:#94b3eb}.bds_qzone{background:#fac33f}.bds_more{background:#40a57d}.bds_weixin{background:#7ad071}.bdsharebuttonbox a:hover{background-color:#7fb4ab;color:#fff;border-bottom:0}</style>'; ?>
<div class="toggle-search pc-hide" style="float:right;position:absolute;top:0;right:0;"><i class="fa fa-search"></i></div><div class="search-expand pc-hide" style="display:none;"><div class="search-expand-inner pc-hide">
<?php if (git_get_option('git_search_baidu')) { ?>
<?php echo git_get_option('git_search_code'); ?></div></div>
<?php }else{ ?>
<?php git_searchform();?>
<?php } ?>
<ul class="nav">
<?php
echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'nav', 'echo' => false))));?>
<li style="float:right;"><div class="toggle-search m-hide"><i class="fa fa-search"></i></div><div class="search-expand" style="display: none;"><div class="search-expand-inner">
<?php if (git_get_option('git_search_baidu')) { ?>
<?php echo git_get_option('git_search_code'); ?></div></div>
<?php }else{ ?>
<?php git_searchform();?>
<?php } ?>
</li>
</ul>
</div>
</header>
<section class="container">
<div class="speedbar">
        <?php
if (git_get_option('git_sign_b')) {
    $uid = get_current_user_id();
    $u_name = get_user_meta($uid, 'nickname', true);
?>
            <div class="login-sign pull-right">
        <?php if(git_get_option('git_fancylogin')) { /*判断是否打开弹窗登录*/ ?>
        <?php
            if(is_user_logged_in()){/*判断是否登录，如果登录了就... */
                if(defined('UM_DIR')){/*判断是否按照um插件，如果安装就...*/
                    if( current_user_can( 'manage_options' ) ) {/*如果是管理员的话...*/
                        echo '<i class="fa fa-user"></i> <a href="' . esc_url(admin_url()) . '">' . $u_name . '</a>';
                        echo '&nbsp;&nbsp;<i class="fa fa-power-off"></i> ';
                        echo wp_loginout();
                        echo '';}else{/*如果不是管理员的话就..*/
                        echo '<i class="fa fa-user"></i> <a target="_blank" href="'.esc_url(get_author_posts_url( $uid )).'">' . $u_name . '</a>';
                        echo '&nbsp;&nbsp;<i class="fa fa-power-off"></i> ';
                        echo wp_loginout();
                        echo '';}
                }else{/*如果没安装um插件就...*/
                    if( current_user_can( 'manage_options' ) ) {/*如果是管理员的话...*/
                        echo '<i class="fa fa-user"></i> <a href="' . esc_url(admin_url()) . '">' . $u_name . '</a>';
                        echo '&nbsp;&nbsp;<i class="fa fa-power-off"></i> ';
                        echo wp_loginout();
                        echo '';}else{/*如果不是管理员的话就..*/
                        echo '<i class="fa fa-user"></i> <a target="_blank" href="'.esc_url(get_author_posts_url( $uid )).'">' . $u_name . '</a>';
                        echo '&nbsp;&nbsp;<i class="fa fa-power-off"></i> ';
                        echo wp_loginout();
                        echo '';}
                }
            }else{/*如果没有登录就...*/
                if(defined('UM_DIR')){/*如果安装um的话，就...*/
                    echo '<i class="fa fa-sign-in" ></i>  <a style="cursor:pointer;" data-sign="0" class="user-login">登录</a>';
                    if(get_option('users_can_register')){
                    echo '&nbsp;&nbsp;<i class="fa fa-pencil-square-o" ></i>  <a style="cursor:pointer;" data-sign="1" class="user-reg">注册</a>';}
                }else{/*如果没有按照um插件的话就..*/
                    echo '<i class="fa fa-sign-in" ></i> <a id="showdiv" href="#loginbox" data-original-title="点击登录">登录</a>';
                    echo '&nbsp;&nbsp;<i class="fa fa-pencil-square-o" ></i>  <a href="'.esc_url( wp_registration_url() ).'">注册</a>';
                    echo '<div id="loginbox" style="width:350px;height:280px;overflow:auto;display:none;">';
                    wp_login_form(array( 'redirect' => site_url( $_SERVER['REQUEST_URI'] ) ));
                    echo '</div>';
                }
            }
            ?>
        <?php }else{ //如果没打开弹窗登录，那么就。。。?>
        <?php if (is_user_logged_in()) { /*判断是否登录 */
                    if( current_user_can( 'manage_options' ) ) {/*如果是管理员的话...*/
                        echo '<i class="fa fa-user"></i> <a href="' . esc_url(admin_url()) . '">' . $u_name . '</a>';
                        echo '&nbsp;&nbsp;<i class="fa fa-power-off"></i> ';
                        echo wp_loginout();
                        echo '';}else{/*如果不是管理员的话就..*/
                        echo '<i class="fa fa-user"></i> <a target="_blank" href="'.esc_url( get_author_posts_url( $uid )).'">' . $u_name . '</a>';
                        echo '&nbsp;&nbsp;<i class="fa fa-power-off"></i> ';
                        echo wp_loginout();
                        echo '';}
        } else {/*如果没有登录的话就...*/
        global $wp;
        $current_url = home_url(add_query_arg(array(),$wp->request));
        echo '<i class="fa fa-sign-in" ></i>  <a target="_blank" href="'.wp_login_url( $current_url ).'">登录</a>';
        if (get_option('users_can_register')){
        echo '&nbsp;&nbsp;<i class="fa fa-pencil-square-o" ></i>  <a href="'.esc_url( wp_registration_url() ).'">注册</a>';
            }
        };
    }?>
</div>
        <?php
} ?>
        <div class="toptip" id="callboard"><ul style="font-size:16px;margin-top:2px;">
		<?php
		if (git_get_option('git_gun_b') == 'git_gun_tui') {
			echo git_get_option('git_tui');
		} elseif (git_get_option('git_gun_b') == 'git_gun_shuo') {
			query_posts('post_type=shuoshuo&post_status=publish&showposts=10');
			while (have_posts()) {
				the_post();
				echo '<li>';
				strip_tags(the_content());
				echo '</li>';
			}
			wp_reset_query();
		}?>
</ul></div>
    </div>
<?php
if (git_get_option('git_adsite_01')) echo '<div class="banner banner-site">' . git_get_option('git_adsite_01') . '</div>'; ?>