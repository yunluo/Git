<?php
/*
	template name: 新版在线充值
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
	require_once POINTS_CORE_LIB.'/youzan/YZGetTokenClient.php';
    require_once POINTS_CORE_LIB.'/youzan/YZTokenClient.php';
	global $current_user;
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
    'qr_name' => $current_user->ID,
    'qr_price' => $_POST['money']*100,
    'qr_type' => 'QR_TYPE_DYNAMIC',
];
if(is_user_logged_in()) {
echo '<span class="pull-center"><form method="post">
	<input type="number" placeholder="1元='.git_get_option('git_chongzhi_dh').'金币" name="money">&nbsp;&nbsp;元
	<input type="submit" value="点击充值">
	</form></span>';
if(isset($_POST['money'])){
echo '<p class="pull-center">请使用微信或者支付宝扫描二维码</p>
<p class="pull-center">你当前正在充值的金额为&nbsp;<font style="font-weight:bold;" color="#cc0000">'.$_POST['money'].'</font> 元</p>
<img src="' . $client->post($method, $api_version, $my_params)['response']['qr_code'] . '" />';}
}else{
	echo '<div class="alert alert-error" role="alert">本页面需要您登录才可以操作，请先 <a id="showdiv" href="#loginbox" data-original-title="点击登录">点击登录</a>  或者<a target="_blank" href="/wp-login.php?action=register">立即注册</a></div>';
}

?>
<style type="text/css">input[type=number]{-moz-appearance:textfield}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}</style>
			</div>
		<?php endwhile;  ?>
	</div>
</div>
<?php get_footer(); ?>