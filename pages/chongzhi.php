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
global $wpdb;
global $current_user;
$tokon = $current_user->ID;
if (isset($_POST['pay_form']) && $_POST['pay_form'] == 'send') {
	$last_chongzhi = $wpdb->get_row("SELECT datetime FROM " . Points_Database::points_get_table( "users" ) . " ORDER BY `datetime` desc LIMIT 0, 1;", ARRAY_A )['datetime'];
	$yanchi = current_time('timestamp') - strtotime($last_chongzhi);
    $rmb_number = isset($_POST['pay_number']) ? trim(htmlspecialchars($_POST['pay_number'], ENT_QUOTES)) : '';//输入的金额
    $point_number = $rmb_number * git_get_option('git_chongzhi_dh');
    $tomail = get_bloginfo('admin_email');
	if($yanchi > 28860){
		if (!empty($rmb_number)) {
			Points::set_points($point_number, $current_user->ID, array('description' => 'chongzhi_' . $tokon . '', 'status' => 'Pending'));//增加金币金币
			$pointid = $wpdb->get_row( "SELECT point_id FROM " . Points_Database::points_get_table( "users" ) . " WHERE user_id=$tokon AND points=$point_number AND description LIKE '%chongzhi%' AND status='Pending' ORDER BY `datetime` desc LIMIT 0, 1;", ARRAY_A )['point_id'];
			$post_content = '<div class="wrapper" style="width:100%;padding-top:16px;padding-bottom:10px;"><br style="clear:both;height:0"><div class="content" style="background: none repeat scroll 0 0 #FFFFFF;border:1px solid #E9E9E9;margin: 2px 0 0; padding: 30px;">尊敬的管理员，您好：<p style="border-top: 1px solid #DDDDDD;margin:15px 0 25px;padding:15px;">充值RMB金额：' . $rmb_number . '元<br>充值人昵称：' . $current_user->display_name . '<br>充值邮箱：' . $current_user->user_email . '<br>充值金币：' . $point_number . '金币<br>充值码：' . $tokon . '<br>如果您确定已支付宝充值到账，<a target="_blank" href="'.admin_url().'admin.php?page=points&action=success&point_id='.$pointid.'">请立即点击更新金币状态</a><br><br>如果您确定未扫码支付，<a target="_blank" href="'.admin_url().'admin.php?page=points&action=delete&point_id='.$pointid.'">请立即点击删除金币记录</a><br><br>如果您确定用户重复提交订单，<a target="_blank" href="'.admin_url().'admin.php?page=points&action=cancel&point_id='.$pointid.'">请立即点击关闭充值订单</a><br><br><a target="_blank" href="'.admin_url().'admin.php?page=points"></a></p><p class="footer" style="border-top: 1px solid #DDDDDD; padding-top:6px;margin-top:25px;color:#838383;">系统邮件，请勿回复<span style="float:right;"><a href="'.admin_url().'admin.php?page=points" target="_blank">积分管理中心</a></span></p></div></div>';
			$headers = "Content-Type:text/html;charset=UTF-8\n";
			wp_mail($tomail, 'Hi,站长，有人充值!充值ID：' . $current_user->ID . '', $post_content, $headers);
			echo '<script type="text/javascript">alert("充值已提交，请稍后\n充值RMB金额：' . $rmb_number . '元\n订单处理时间：8-20点");window.location = document.referrer;</script>';
		} else {
			echo '<script type="text/javascript">alert("充值失败，请输入充值金额！");window.location = document.referrer;</script>';
		}
	}else{
		echo '<script type="text/javascript">alert("充值太过频繁，请10秒后再操作！");window.location = document.referrer;</script>';
	}
}
?>
<?php if(is_user_logged_in()) {?>
<div class="alert alert-warning" role="alert" style="font-size:16px;">本站金币规则：<span style="font-style:italic;font-weight:bold;color:#E53333;">1RMB=<?php echo git_get_option('git_chongzhi_dh');?>金币</span>，充值的时候请输入RMB金额数目</div>
<blockquote>您当前拥有 <?php
$jinbis = Points::get_user_total_points($current_user->ID, POINTS_STATUS_ACCEPTED );
if($jinbis != ""){echo $jinbis;}else{ echo '0';}?> 金币</blockquote>
<hr />
<div class="alert alert-success" role="alert">
	充值步骤一：输入将要充值的金额数量，输入的为RMB金额
</div>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"];?>">
	<p>
		<label for="pay_number"><span class="pay_number">RMB金额:</span>&nbsp;
		<input type="number" placeholder="请输入充值的RMB金额" name="pay_number" id="pay_number" onkeyup="javascript:senddata(this);"/> 元 &nbsp;&nbsp; <span id="outdiv"></span></label>
	</p>
	<div class="alert alert-error" role="alert">
		充值步骤二：将下方红色充值码输入二维码转账备注中【必须，重要，否则无法自动到账】
	</div>
	<p style="padding-top:5px;padding-bottom:5px;">
	<label>您的专属充值码：<span style="font-style:italic;font-weight:bold;color:#E53333;font-size:16px;"><?php echo $tokon; ?></span></label>
	</p>
	<div class="alert alert-info" role="alert">
		充值步骤三：下面直接扫码，金额与上方输入保持一致，并将上方充值码输入备注中！重要！！！
	</div>
	<p>
		<label for="pay_qr"><span class="pay_qr">扫描下方二维码或转账至账号：<span style="font-style:italic;font-weight:bold;color:#E53333;font-size:16px;"><?php echo git_get_option('git_chongzhi_hao');?></span></span></label>
	</p>
	<hr/>
	<p>
	<img style="margin-left:0px;height:300px;width:auto" src="<?php echo git_get_option('git_chongzhi_qr');?>">
	</p>
	<hr/>
	<input type="hidden" value="send" name="pay_form"/>
	<p>
		<input type="submit" class="czbtn" value="点击立即充值"/>
	</p>
</form>
<?php }else{?>
<div class="alert alert-error" role="alert">本页面需要您登录才可以操作，请先 <a id="showdiv" href="#loginbox" data-original-title="点击登录">点击登录</a>  或者<a target="_blank" href="/wp-login.php?action=register">立即注册</a></div>
<?php }?>
<style type="text/css">input[type=number]{-moz-appearance:textfield}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}.czbtn{background:#e27575;border:none;padding:10px 50px 30px;color:#fff;box-shadow:1px 1px 5px #b6b6b6;border-radius:3px;text-shadow:1px 1px 1px #9e3f3f;cursor:pointer}.czbtn:hover{background:#cf7a7a}.pay_qr,.pay_number{line-height:150%;}</style>
<script type="text/javascript">
function senddata(inputobj) {
	var obj;
	obj = document.getElementById("outdiv");
	obj.innerHTML = '您将充值<strong><em><span style="color:#E53333;font-size:16px;">' + inputobj.value * <?php echo git_get_option('git_chongzhi_dh');?> + '</span></em></strong>金币';
}
</script>
			</div>
		<?php comments_template('', true); endwhile;  ?>
	</div>
</div>
<?php get_footer(); ?>