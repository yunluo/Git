<?php
/*
  template name: 微信登陆
  description: template for Git theme
*/
get_header();
nocache_headers();
$user_ID = get_current_user_id();
if ($user_ID > 0) {
    $email = get_user_by('id', $user_ID)->user_email;
    if (!empty($email) && !isset($_COOKIE['bind'])) {
        setcookie('bind', 1, time() + 2592000, COOKIEPATH, COOKIE_DOMAIN, false);
    }
}
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
    <style type="text/css">.swal-button{line-height: normal;}.swal-footer{text-align:center;}</style>
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
setCookie('wp-nocache',1,500);
function qr_gen() {
    ajax.post("<?php echo admin_url('admin-ajax.php');?>", "action=weauth_qr_gen&wastart=1", function(n) {
        var t = n.split("|"), e = document.getElementById("weauth_qr"), a = document.getElementById("ssk");
        e.innerHTML = '<img id="weaqr" style="width:300px;height:300px" src=' + t[1].replace("&quot;", "") + "><p id='qr_success'></p>", 
        a.innerHTML = t[0];
    });
}

function isemail(t) {
    return 1 == /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/.test(t);
}

function weauth_auto_login(k,m){
	if(0 !== m && null != m && "" != m && 0 != m.length){
		ajax.post("<?php echo admin_url('admin-ajax.php');?>", "action=weauth_oauth_login&spam=" + k + "&email=" + m, function(n) {
  console.log(n);
  });
	}else{
  ajax.post("<?php echo admin_url('admin-ajax.php');?>", "action=weauth_oauth_login&spam=" + k, function(n) {
  console.log(n);
  });
	}
}

function weauth_check() {
  var n = document.getElementById("ssk").innerHTML;
    void 0 !== n && null != n && "" != n && 0 != n.length && ajax.post("<?php echo admin_url('admin-ajax.php');?>", "action=weauth_check&sk=" + n, function(n) {
        0 != n  && (clearTimeout(timeres), swal("微信登录成功！", "如未登录，请手动刷新一下！", "success").then(function(t) {

if(getCookie('bind') == 1){
    weauth_auto_login(n);
}else{
swal("绑定邮箱", "为了方便使用邮箱登录，我们墙裂推荐您绑定邮箱",{
    content: {element: "input",attributes: { placeholder: "请输入您的邮箱",type: "text",},},
    buttons: ["以后再说", "立刻绑定"],
    dangerMode: true,
})
.then((value) => {
  if (value) {
    if(isemail(`${value}`)){
      ajax.post("<?php echo admin_url('admin-ajax.php');?>", `action=bind_email_check&email=${value}`, function(n) {
        if( n == 1){
          swal("邮箱绑定错误","您输入的邮箱已被绑定，请更换邮箱或者联系管理员，谢谢",{icon: "error",dangerMode: true});
        }else{
          setCookie('bind',1,50);
          weauth_auto_login(n,`${value}`); 
        }
      });
    }else{
      swal("邮箱输入错误","您输入的邮箱格式错误，请重新扫码绑定，谢谢",{icon: "error",dangerMode: true});
      weauth_auto_login(n);
    }
  } else {
    weauth_auto_login(n);
  }
});
}

document.getElementById("weaqr").style.display = "none", document.getElementById("qr_success").innerHTML = "<p><i class='fa fa-check-circle' style='font-size:222pt;color:#45d445;'></i></p><span class='alert alert-success'>微信扫码已登录，请刷新下~</span>";
        }));
    });
}

function timecheck() {
    ++num < max && (timeres = setTimeout(timecheck, 1e3), weauth_check());
}
var num = 0, max = 30, timeres;
timeres = setTimeout(timecheck, 1e3);
</script>
</div>
<?php get_footer(); ?>