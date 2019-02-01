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
	if(git_is_mobile()){
		$rst = $payjs->cashier($data);//手机使用
		$SKQR = $rst;
	}else{
		$rst = $payjs->native($data);//电脑使用
		$SKQR = $rst['code_url'];
	}
}

if(git_get_option('git_pay_way')=='git_eapay_ok'){
	$eapay = new Eapay($config);
	$data = array(
		'out_trade_no' => git_order_id(), //举例为：E20181125153426343026279
		'total_fee' => intval($_POST['money']), //充值的钱，注意金额单位为元
		'subject' => '积分充值',//根据业务需要吗，一般是固定的
		'body' => get_current_user_id(),//订单备注
		'show_url' => get_permalink(git_page_id('chongzhi')),
	);
	$userid = $data['body'];
	$point_number = $data['total_fee'] * git_get_option('git_chongzhi_dh');
	$YZid = $data['out_trade_no'];
}
/*简付结束*/
if(is_user_logged_in()) {
echo '<span class="pull-center"><form method="post">
	<input type="number" placeholder="1元='.git_get_option('git_chongzhi_dh').'金币" name="money" required="required">&nbsp;&nbsp;元
	<input type="submit" value="点击充值">
	</form></span>';
if(isset($_POST['money'])){
	if(git_get_option('git_pay_way')=='git_eapay_ok'){
	Points::set_points($point_number, $userid, array('description' => $YZid , 'status' => 'pending'));//增加金币待审核
	$SKQR = $eapay->cashier($data);
	}
	echo '<div class="pull-center">
	<p class="pull-center">请使用微信或者支付宝扫描二维码</p>
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
		swal("支付已到账！", "感谢大佬支付，详情查看邮箱", "success");
		clearTimeout(timeres);
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