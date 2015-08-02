<?php
/*
	template name: 下载单页
	description: template for Git theme
*/
$pid = isset( $_GET['pid'] ) ? trim(htmlspecialchars($_GET['pid'], ENT_QUOTES)) : '';
if( !$pid ) die('暂无页面下载');
$title = get_the_title($pid);
$values = get_post_custom_values('git_download',$pid);
empty($values) ? Header('Location:/') : $theCode = $values[0];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />
<title>代码演示: <?php echo $title ?> -- <?php echo bloginfo('name'); ?></title>
<style>
body,h1,h2,h3,h4,p,ul,li,ol,dl,dt,dd,input,textarea,figure,form{margin:0;padding:0}
body,input,textarea{font-size:12px;font-family:microsoft yahei}
body{text-align:center;color:#33383D;background:#eee}
ul,ol{list-style:none}
img{border:0}
button,input {line-height:normal;*overflow:visible}
input,textarea{outline:none}
a{color:#428BD1;text-decoration:none}
a:hover{color:#3071A9}
.download-header{position:relative;height:32px;background-color:#4A4A4A;line-height:32px;text-align: left;}
.download-name{background-color: #428BCA;color: #fff;display: inline-block;padding: 0 20px;}
.download-name:hover{color: #fff;}
.download-title{height:0;overflow:hidden}
.download-container{clear: both;padding:30px 20px;text-align:left;margin:0 auto;line-height: 18px;}
.download h2{font-size: 15px;padding-bottom: 6px;margin-bottom: 20px;border-bottom: solid 1px #ddd;}
</style>
</head>
<body>
<h1 class="download-title">代码演示: <?php echo $title ?> -- <?php echo bloginfo('name'); ?></h1>
<div class="download-header">
	<a class="download-name" href="<?php echo get_permalink($pid); ?>">&laquo; <?php echo $title ?></a>
	<span style="display:none"><?php if( git_get_option('git_track') != '' ) echo git_get_option('git_track'); ?></span>
</div>
<div class="download-container download"><?php echo $theCode; ?></div>
<div style="display:none"><?php if( git_get_option('git_track') ) echo git_get_option('git_track'); ?></div>
</body>
</html>