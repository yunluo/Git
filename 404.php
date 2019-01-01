<?php get_header(); ?>
<style type="text/css">.cont{margin:0 auto;line-height:20px;background:url("<?php echo GIT_URL; ?>/assets/img/01.jpg")}.c1{text-align:center}.c1 .img1,.c1 .img2{margin-top:5pc}.cont h2{color:#555;font-weight:400;font-size:18px}.c2,.cont h2{height:35px;text-align:center}.c2 a{display:inline-block;margin:0 4px;padding-top:1px;height:23px;text-align:left;font-size:14px}.c2 a,.c2 a:hover{color:#626262;text-decoration:none}.c2 a.home{padding-left:30px;width:66px;background:url("<?php echo GIT_URL; ?>/assets/img/02.png")}.c2 a.home:hover{background:url("<?php echo GIT_URL; ?>/assets/img/02.png") 0 -24px}.c2 a.home:active{background:url("<?php echo GIT_URL; ?>/assets/img/02.png") 0 -3pc}.c2 a.re{padding-left:30px;width:66px;background:url("<?php echo GIT_URL; ?>/assets/img/03.png")}.c2 a.re:hover{background:url("<?php echo GIT_URL; ?>/assets/img/03.png") 0 -24px}.c2 a.re:active{background:url("<?php echo GIT_URL; ?>/assets/img/03.png") 0 -3pc}.c3{height:180px;color:#999;text-align:center;font-size:9pt}</style>
<div class="content-wrap">
		<div class="cont">
			<div class="c1"><img src="<?php echo GIT_URL; ?>/assets/img/01.png" class="img1" /></div>
			<h2>404页面咯~你访问的页面不存在</h2>
			<div class="c2"><a href="javascript:;" class="re" onclick="javascript:location.reload();">刷新本页</a><a href="/" class="home">网站首页</a></div>
			<div class="c3">通过搜索把你想找的文章给揪出来吧...</div>
		</div>
</div>
<?php if( git_get_option('git_404ad') ) { echo git_get_option('git_404ad'); } ?>
<?php get_footer(); ?>