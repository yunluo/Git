<?php
/*
	template name: 在线充值
	description: template for Git theme
*/
get_header();
?>
<div class="pagewrapper clearfix">
	<aside class="pagesidebar">
		<ul class="pagesider-menu">
			<?php
echo str_replace('</ul></div>', '', preg_replace('/<div[^>]*><ul[^>]*>/', '', wp_nav_menu(array('theme_location' => 'pagemenu', 'echo' => false))));?>
		</ul>
	</aside>
	<div class="pagecontent">
		<header class="pageheader clearfix">
			<h1 class="pull-left">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			<div class="pull-right"><!-- 百度分享 -->
	<?php deel_share() ?>
			</div>
		</header>
		<style type="text/css">input:not([type=search])::-ms-clear{display:none}input.ui-input{height:20px;line-height:20px;padding:9px 8px;border:1px solid #d0d0d5;border-radius:4px;background-color:#fff;font-size:14px;outline:0;color:#4c5161;-webkit-transition:border-color .15s,background-color .15s;transition:border-color .15s,background-color .15s}.ui-input:hover{border-color:#ababaf}.ui-input:focus{border-color:#2486ff}::-webkit-input-placeholder{-webkit-transition:opacity .15s;color:#a2a9b6;line-height:inherit;font-size:14px}:focus::-webkit-input-placeholder{opacity:.38}::-moz-placeholder{transition:opacity .15s;color:#a2a9b6;font-size:14px}:focus::-moz-placeholder{opacity:.38}:-ms-input-placeholder{transition:opacity .15s;color:#a2a9b6 !important;font-size:14px}:focus:-ms-input-placeholder{opacity:.38}input[type=checkbox]{position:absolute;opacity:0;width:20px;height:20px;filter:alpha(opacity=0);cursor:pointer;z-index:-1}.ui-checkbox{display:inline-block;width:20px;height:20px;border:1px solid rgba(0,0,0,0);border-radius:4px;box-sizing:border-box;box-shadow:inset 0 1px,inset 1px 0,inset -1px 0,inset 0 -1px;background-color:#fff;background-clip:content-box;color:#d0d0d5;-webkit-transition:color .2s,background-color .1s;transition:color .2s,background-color .1s;-webkit-user-select:none;-ms-user-select:none;user-select:none;vertical-align:-5px;*vertical-align:0;overflow:hidden}:disabled+.ui-checkbox{color:#ababaf}:focus+.ui-checkbox{color:#2486ff}:checked:focus+.ui-checkbox{color:#0057c3;background-color:#0057c3}:checked+.ui-checkbox,:checked+.ui-checkbox:hover{color:#2486ff;background-color:#2486ff}.ui-checkbox::after{content:'';display:block;width:100%;height:100%;background:url(data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIHZpZXdCb3g9IjAgMCAyMDAgMjAwIj4NCjxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0xNDcuNTY3LDY3LjU3NWMtMy45NzgtMy4yNDEtNC4zNTYtMy4zMzctOC45LTUuNjM5Yy0yLjA0NC0xLjA0NC01LjA1NywxLjY0NS02LjUzLDMuNjM1TDkyLDExNy43MjgNCglMNjUuODUxLDgzLjk3M2MtMS40NzktMS45ODgtNC4yMDYtMi43Mi02LjI1MS0xLjc4MmMtNC42NTgsMi40MDctNC4xODksMi4zMjYtOC4xNjgsNS40NjZjLTEuODE3LDEuNDY2LTEuOTMyLDQuMDgyLTAuNDU2LDYuMDY1DQoJYzAsMCwyOC4xODMsMzYuNDk5LDMxLjU5Miw0MC44OTZjNC45OTksNi4yNzUsMTQuMDksNS45NjUsMTguODY0LDBjMy41Mi00LjQ5OCw0Ni41OS02MS4wNzgsNDYuNTktNjEuMDc4DQoJQzE0OS40OTksNzEuNTQ5LDE0OS4zODUsNjguOTM3LDE0Ny41NjcsNjcuNTc1eiIvPg0KPC9zdmc+DQo=) no-repeat center;background-size:20px 20px;visibility:hidden}:checked+.ui-checkbox::after{visibility:visible;-webkit-animation:bounceIn .2s;animation:bounceIn .2s}:disabled+.ui-checkbox{opacity:.38}input:not([type=search])::-ms-clear{display:none}::-webkit-input-placeholder{-webkit-transition:opacity .15s;color:#a2a9b6;line-height:inherit;font-size:14px}:focus::-webkit-input-placeholder{opacity:.38}::-moz-placeholder{transition:opacity .15s;color:#a2a9b6;font-size:14px}:focus::-moz-placeholder{opacity:.38}:-ms-input-placeholder{transition:opacity .15s;color:#a2a9b6 !important;font-size:14px}:focus:-ms-input-placeholder{opacity:.38}@-webkit-keyframes bounceIn{0%{-webkit-transform:scale(0)}75%{-webkit-transform:scale(1.1)}100%{-webkit-transform:scale(1)}}@keyframes bounceIn{0%{transform:scale(0)}75%{transform:scale(1.1)}100%{transform:scale(1)}}.ui-button{display:inline-block;line-height:20px;font-size:14px;text-align:center;color:#4c5161;border:1px solid #d0d0d5;border-radius:4px;padding:9px 15px;min-width:50px;background-color:#fff;background-repeat:no-repeat;background-position:center;text-decoration:none;-webkit-transition:border-color .15s,background-color .15s,opacity .15s;transition:border-color .15s,background-color .15s,opacity .15s;cursor:pointer;overflow:visible}[type="submit"]{outline:0}input.ui-button{height:20px;-ms-box-sizing:content-box;box-sizing:content-box}.ui-button:hover{color:#4c5161;border-color:#ababaf;text-decoration:none}.ui-button:not(.disabled):active,.ui-button:not(.loading):active{background-color:#f7f9fa}.ui-button-success{border:1px solid #01cf97;background-color:#01cf97;color:#fff}.ui-button-success:hover{background-color:#00dba2;border-color:#00dba2;color:#fff}.ui-button-success:not(.disabled):active,.ui-button-success:not(.loading):active{background-color:#00bf8e;border-color:#00bf8e}input:not([type=search])::-ms-clear{display:none}::-webkit-input-placeholder{-webkit-transition:opacity .15s;color:#a2a9b6;line-height:inherit;font-size:14px}:focus::-webkit-input-placeholder{opacity:.38}::-moz-placeholder{transition:opacity .15s;color:#a2a9b6;font-size:14px}:focus::-moz-placeholder{opacity:.38}:-ms-input-placeholder{transition:opacity .15s;color:#a2a9b6 !important;font-size:14px}:focus:-ms-input-placeholder{opacity:.38}</style>
		<?php while (have_posts()) : the_post(); ?>
			<div class="article-content">
				<?php the_content(); ?>
<?php
if(git_get_option('git_pay_way')=='git_payjs_ok'){
	// 配置通信参数
	$config = [
		'mchid' => git_get_option('git_payjs_id'),   // 配置商户号
		'key'   => git_get_option('git_payjs_secret'),   // 配置通信密钥
	];
	// 初始化
	$payjs = new Payjs($config);
	$data = [
		'body' => '积分充值',   // 订单标题
		'attach' => get_current_user_id(),   // 订单备注
		'out_trade_no' => git_order_id(),       // 订单号
		'total_fee' => intval($_POST['money'])*100,             // 金额,单位:分
		'notify_url' => GIT_URL.'/modules/push.php',
		'hide' => '1'
	];
	if( git_get_option('git_payjs_alipay') && isset($_POST['alipay'])){
		$data['type'] = 'alipay';
	}
	if( git_get_option('git_payjs_alipay') && isset($_POST['alipay'])){
		$payway = '支付宝';
	}else{
		$payway = '微信';
	}
	if(git_is_mobile()){
		$rst = $payjs->cashier($data);//手机使用
		$SKQR = $rst;
	}else{
		$rst = $payjs->native($data);//电脑使用
		$SKQR = $rst['code_url'];
	}
}

if(is_user_logged_in()) {
echo '<span class="pull-center"><form method="post">
	<input class="ui-input" type="number" placeholder="1元='.git_get_option('git_chongzhi_dh').'金币" name="money" required="required">&nbsp;&nbsp;元<br>';
if( git_get_option('git_payjs_alipay') ){
	echo '<p><input type="checkbox" id="alipay" name="checkbox" value="alipay">
<label for="alipay" class="ui-checkbox"></label><label style="display:inline-block" for="alipay">&nbsp;&nbsp;&nbsp;使用支付宝支付</label></p>';
}
echo '<input type="submit" class="ui-button ui-button-success" value="点击充值">
	</form></span>';
if(isset($_POST['money'])){
	echo '<div class="pull-center">
	<p class="pull-center">请使用&nbsp;<font size="" color="#ff0000"><strong>'.$payway.'</strong></font>&nbsp;扫描二维码</p>
<p class="pull-center">你当前正在充值的金额为&nbsp;<font style="font-weight:bold;" color="#cc0000">'.intval($_POST['money']).'</font> 元</p>
<p class="pull-center"><img id="qrious"></p>
 <script src="https://cdn.bootcss.com/qrious/4.0.2/qrious.min.js"></script>
 <script type="text/javascript">
   var qr = new QRious({
	 element: document.getElementById("qrious"),
	 size : 300,
	 value: "'.$SKQR.'"
   });
 </script>
</div>';
echo '<script src="https://cdn.bootcss.com/sweetalert/2.0.0/sweetalert.min.js"></script>
<script type="text/javascript">
var num = 0;
var max = 30;
var timeres;

function payok(a) {
	if (a == 1) {
		clearTimeout(timeres);
			swal("'.$payway.'支付已到账！", "感谢大佬支付，详情查看邮箱", "success").then((value)=> {
				window.location = document.referrer;
			});
	}
}

function checkpay() {
	var a = new XMLHttpRequest();
	a.open("POST", "'.admin_url('admin-ajax.php').'");
	a.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	a.send("action=payrest&check_trade_no='.$data['out_trade_no'].'");
	a.onreadystatechange = function() {
		if (a.readyState == 4 && a.status == 200) {
			payok(a.responseText)
		}
	}
}

function timecheck(){
	num++;
	if (num < max) {
		timeres = setTimeout(timecheck,5*1000);
		checkpay();
	}
}
timeres = setTimeout(timecheck,5*1000);
if (window.Notification) {
	var popNotice = function() {
			if (Notification.permission == "granted") {
				setTimeout(function() {
					var n = new Notification("您已提交订单，请及时扫码支付", {
						body: "扫码支付之后，我们会使用邮箱通知您的支付结果，您可以打开您的注册邮箱查看充值详情，如果有异常，请联系本站管理员，祝您生活愉快，谢谢~",
						icon: "https://wx4.sinaimg.cn/mw690/0060lm7Tly1fyr3i051a8g306o06oq3w.gif"
					})
				}, 2 * 1000)
			}
		};
	if (Notification.permission == "granted") {
		popNotice()
	} else if (Notification.permission != "denied") {
		Notification.requestPermission(function(a) {
			popNotice()
		})
	}
} else {
	console.log("您的浏览器不支持Web Notification")
}
</script>';
	}
}else{
	echo '<div class="alert alert-error" role="alert">本页面需要您登录才可以操作，请先 <a target="_blank" href="'.esc_url( wp_login_url( get_permalink() ) ).'">点击登录</a>  或者<a href="'.esc_url( wp_registration_url() ).'">立即注册</a></div>';
}
?>
<style type="text/css">input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}</style>
			</div>
		<?php endwhile;  ?>
	</div>
</div>
<?php get_footer(); ?>