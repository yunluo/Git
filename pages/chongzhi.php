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
if(git_get_option('git_pay_way')=='git_youzan_ok'){
	/*开始有赞*/
	$client_id = git_get_option('git_yzclient_id');
    $client_secret = git_get_option('git_yzclient_secret');
	$kdt_id = git_get_option('git_yzkdt_id');
    $token_client = new YZGetTokenClient($client_id, $client_secret);
    $type = 'self';
    $keys = array(
        'grant_type' => 'silent',
        'kdt_id' => intval($kdt_id),
    );
    $token = $token_client->get_token($type, $keys);
    $client = new YZTokenClient($token['access_token']);
    $method = 'youzan.pay.qrcode.create'; //要调用的api名称
    $api_version = '3.0.0'; //要调用的api版本号
	$my_params = [
    'qr_name' => get_current_user_id(),
    'qr_price' => $_POST['money']*100,
    'qr_type' => 'QR_TYPE_DYNAMIC',
	];
	$SKQR = $client->post($method, $api_version, $my_params)['response']['qr_code'];
}
if(git_get_option('git_pay_way')=='git_payjs_ok'){
	// 配置通信参数
	$config = [
		'mchid' => git_get_option('git_payjs_id'),   // 配置商户号
		'key'   => git_get_option('git_payjs_secret'),   // 配置通信密钥
	];
	// 初始化
	$payjs = new Payjs($config);
	$arr = [
		'body' => '积分充值',   // 订单标题
		'attach' => get_current_user_id(),   // 订单备注
		'out_trade_no' => 'E'.date("YmdHis").mt_rand(100000000, 999999999),       // 订单号
		'total_fee' => $_POST['money']*100,             // 金额,单位:分
		'notify_url' => home_url().'/wp-content/themes/Git-alpha/modules/push.php',
	];
	$rst = $payjs->native($arr);
	//var_dump($rst);
	$SKQR = $rst['qrcode'];
}

if(git_get_option('git_pay_way')=='git_eapay_ok'){
	$eapay = new Eapay($config);
	$data = array(
		'out_trade_no' => 'E' . date("YmdHis") . mt_rand(100000000, 999999999), //举例为：E20181125153426343026279
		'total_fee' => $_POST['money'], //充值的钱，注意金额单位为元
		'subject' => '积分充值',//根据业务需要吗，一般是固定的
		'body' => get_current_user_id(),//订单备注
		'show_url' => get_permalink(git_page_id('chongzhi')),
	);
	$userid = $data['body'];
	$point_number = $data['total_fee'] * git_get_option('git_chongzhi_dh');
	$YZid = $data['out_trade_no'];
}
	/*有赞结束*/
if(is_user_logged_in()) {
echo '<span class="pull-center"><form method="post">
	<input type="number" placeholder="1元='.git_get_option('git_chongzhi_dh').'金币" name="money" required="required">&nbsp;&nbsp;元
	<input type="submit" value="点击充值">
	</form></span>';
if(isset($_POST['money'])){
	if(git_get_option('git_pay_way')=='git_eapay_ok'){
	Points::set_points($point_number, $userid, array('description' => $YZid , 'status' => 'pending'));//增加金币待审核
	header("Location:{$eapay->cashier($data)}");
	}else{echo '<div class="pull-center">
	<p class="pull-center">请使用微信或者支付宝扫描二维码</p>
<p class="pull-center">你当前正在充值的金额为&nbsp;<font style="font-weight:bold;" color="#cc0000">'.filter_var($_POST['money'], FILTER_SANITIZE_NUMBER_INT).'</font> 元</p>
<img class="pull-center" src="' . $SKQR . '" />
</div>';}
}
}else{
	echo '<div class="alert alert-error" role="alert">本页面需要您登录才可以操作，请先 <a target="_blank" href="'.esc_url( wp_login_url( get_permalink() ) ).'">点击登录</a>  或者<a href="'.esc_url( wp_registration_url() ).'">立即注册</a></div>';
}
?>
<style type="text/css">input[type=number]{-moz-appearance:textfield}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}</style>
			</div>
		<?php endwhile;  ?>
	</div>
</div>
<?php get_footer(); ?>