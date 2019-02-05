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
var num = 0;
var max = 30;
var timeres;
 
function weauthok(k) {
	if (k != 0) {
		clearTimeout(timeres);
		swal("微信登录成功！", "您以后都可以使用微信登录网站", "success").then((value)=> {
			swal("尚未绑定邮箱", "为了方便使用邮箱登录，我们墙裂推荐绑定邮箱", "error").then((value)=> {
				window.location.href = "?spam="+k+"";
			})
		});
	}
}

function qr_gen() {
	var a = new XMLHttpRequest(),qrdiv = document.getElementById("weauth_qr"),ssk = document.getElementById("ssk");
	a.open("POST", "<?php echo admin_url('admin-ajax.php');?>");
	a.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	a.send("action=weauth_qr_gen&wastart=1");
	a.onreadystatechange = function() {
		if (a.readyState == 4 && a.status == 200) {
      var ss = a.responseText.split("|");
      qrdiv.innerHTML = "<img style=\"width:300px;height:300px\" src="+ss[1].replace("&quot;","")+">";
      ssk.innerHTML = ss[0];
		}
	}
}

function weauth_check() {
      var ssk = document.getElementById("ssk").innerHTML;
      if (typeof(ssk) != "undefined" && ssk != null && ssk != "" && ssk.length != 0) {
	      var a = new XMLHttpRequest();
	      a.open("POST", "<?php echo admin_url('admin-ajax.php');?>");
	      a.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	      a.send("action=weauth_check&sk=" + ssk);
	      a.onreadystatechange = function() {
		      if (a.readyState == 4 && a.status == 200) {
			      weauthok(a.responseText);
		    }
	   }
  }
}
  
function timecheck(){
	num++;
	if (num < max) {
		timeres = setTimeout(timecheck,5*1000);
		weauth_check();
	}
}
timeres = setTimeout(timecheck,5*1000);
</script>
</div>
<?php get_footer(); ?>