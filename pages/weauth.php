<?php
/*
	template name: 微信登陆
	description: template for Git theme
*/
get_header();
?>
<div class="pagewrapper clearfix">
  		<header class="pageheader clearfix">
			<h1 class="pull-left">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			<div class="pull-right"><!-- 百度分享 -->
	<?php deel_share() ?>
			</div>
		</header>
		<?php while (have_posts()) : the_post(); ?>
			<div class="article-content" style="height:600px">
				<?php the_content(); ?>
        <div id="sc_notice" class="pull-center">请点击下方按钮生成二维码，再使用微信扫码登录，点击授权应用即可</div>
        <p class="pull-center"><a class="lhb" href="javascript:void(0);" onclick="qr_gen();">点击生成微信二维码</a></p>
        <div class="pull-center" id="weauth_qr"></div><span style="display:none" id="ssk"></span>
			</div>
		<?php comments_template('', true); endwhile;  ?>
<script src="https://cdn.bootcss.com/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
function qr_gen() {
    ajax.post("<?php echo admin_url('admin-ajax.php');?>", "action=weauth_qr_gen&wastart=1", function(n) {
        var t = n.split("|"), e = document.getElementById("weauth_qr"), a = document.getElementById("ssk");
        e.innerHTML = '<img style="width:300px;height:300px" src=' + t[1].replace("&quot;", "") + ">", 
        a.innerHTML = t[0];
    });
}

function weauth_check() {
    var n = document.getElementById("ssk").innerHTML;
    void 0 !== n && null != n && "" != n && 0 != n.length && ajax.post("<?php echo admin_url('admin-ajax.php');?>", "action=weauth_check&sk=" + n, function(n) {
        0 != n && (clearTimeout(timeres), swal("微信登录成功！", "您以后都可以使用微信登录网站", "success").then(function(t) {
            swal("绑定邮箱小Tips", "为了方便使用邮箱登录，我们墙裂推荐您绑定邮箱", "info").then(function(t) {
                window.location.href = "?spam=" + n;
            });
        }));
    });
}

function timecheck() {
    ++num < max && (timeres = setTimeout(timecheck, 5e3), weauth_check());
}

var num = 0, max = 30, timeres;
timeres = setTimeout(timecheck, 5e3);
</script>
</div>
<?php get_footer(); ?>