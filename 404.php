<?php get_header(); ?>
<div class="content-wrap">
	<?php echo '<style type="text/css">
.cont { margin:0 auto; line-height:20px; }
.c1 { text-align:center; }
.c1 .img1, .c1 .img2{ margin-top:80px; }
.cont h2{ text-align:center; color:#555; font-size:18px; font-weight:normal; height:35px; }
.c2{ height:35px; text-align:center; }
.c2 a{ display:inline-block; margin:0 4px; font-size:14px; height:23px; color:#626262; padding-top:1px; text-decoration:none; text-align:left; }
.c2 a:hover{ color:#626262; text-decoration:none;}
.c2 a.home{ width:66px; background:url("'.get_template_directory_uri().'/css/img/02.png"); padding-left:30px; }
.c2 a.home:hover{ background:url("'.get_template_directory_uri().'/css/img/02.png") 0 -24px; }
.c2 a.home:active{ background:url("'.get_template_directory_uri().'/css/img/02.png") 0 -48px; }
.c2 a.re{ width:66px; background:url("'.get_template_directory_uri().'/css/img/03.png"); padding-left:30px; }
.c2 a.re:hover{ background:url("'.get_template_directory_uri().'/css/img/03.png") 0 -24px; }
.c2 a.re:active{ background:url("'.get_template_directory_uri().'/css/img/03.png") 0 -48px; }
.c2 a.sr{ width:153px; background:url("'.get_template_directory_uri().'/css/img/04.png"); padding-left:28px; }
.c2 a.sr:hover{ background:url("'.get_template_directory_uri().'/css/img/04.png") 0 -24px; }
.c2 a.sr:active{ background:url("'.get_template_directory_uri().'/css/img/04.png") 0 -48px; }
.c3{ height:180px; text-align:center; color:#999; font-size:12px; }
</style>
		<div class="cont">
			<div class="c1"><img src="'.get_template_directory_uri().'/css/img/01.png" class="img1" /></div>
			<h2>404页面咯~你访问的页面不存在</h2>
			<div class="c2"><a href="javascript:;" class="re" onclick="javascript:location.reload();">刷新本页</a><a href="/" class="home">网站首页</a></div>
			<div class="c3">通过搜索把你想找的文章给揪出来吧...</div>
		</div>
</div>';?>
<?php if( git_get_option('git_404ad') ) echo git_get_option('git_404ad'); ?>
<?php get_footer(); ?>