<?php
/*
*   本文件为支付类文件，无需修改，供支付和推送文件调用
*/
// 配置通信参数
$config = [
	'appid' => git_get_option('git_eapay_id'),   // 配置商户号
	'appkey'   => git_get_option('git_eapay_secret'),   // 配置通信密钥
];

class Eapay
{
    private $appid;
    private $appkey;
    private $api_url_cashier;
	private $api_url_cashier_url;

    public function __construct($config = null)
    {
        if (!$config) exit('config needed');
        $this->appid = $config['appid'];
        $this->appkey   = $config['appkey'];
        $api_url     = isset($config['api_url']) ? $config['api_url'] : 'https://api.eapay.cc/v1/order/';
        $this->api_url_cashier = $api_url . 'add';
		$this->api_url_cashier_url = $api_url . 'pay/no/';
    }

    // 收银台模式
    public function cashier(array $data)
    {
		$cashier_url = $this->api_url_cashier_url;
		$data = $this->post($data);
		if(!$data['status']) exit('requst fail');
		$no = $data['data']['no'];
		return $cashier_url . $no;
    }

    // 异步通知接收
    public function notify()
    {
        $data = $_POST;
        if ($this->checkSign($data) === true) {
            return $data;
        } else {
            exit('验签失败');
        }
    }

    // 数据签名
    public function sign(array $data)
    {
        $data['appid'] = $this->appid;
        array_filter($data);
        ksort($data);
        $data['sign'] = strtoupper(md5(urldecode(http_build_query($data) . '&key=' . $this->appkey)));
        return $data;
    }

    // 校验数据签名
    public function checkSign($data)
    {
        $in_sign = $data['sign'];
        unset($data['sign']);
        array_filter($data);
        ksort($data);
        $sign = strtoupper(md5(urldecode(http_build_query($data) . '&key=' . $this->appkey)));
        return $in_sign == $sign ? true : false;
    }

    // 数据发送
	public function post($data) {
		$this->url = $this->api_url_cashier;
		$data   = $this->sign($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $rst = curl_exec($ch);
        curl_close($ch);
        return json_decode($rst, true);
    }

}
?>