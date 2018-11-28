<?php

class Payjs
{
    private $mchid;
    private $key;
    private $api_url_native;
    private $api_url_cashier;
    private $api_url_check;

    public function __construct($config = null)
    {
        if (!$config) exit('config needed');

        $this->mchid = $config['mchid'];
        $this->key   = $config['key'];
        $api_url     = isset($config['api_url']) ? $config['api_url'] : 'https://payjs.cn/api/';

        $this->api_url_native  = $api_url . 'native';
        $this->api_url_cashier = $api_url . 'cashier';
        $this->api_url_close   = $api_url . 'close';
        $this->api_url_check   = $api_url . 'check';
    }

    // 扫码支付
    public function native(array $data)
    {
        $this->url = $this->api_url_native;
        return $this->post($data);
    }

    // 收银台模式
    public function cashier(array $data)
    {
        $this->url = $this->api_url_cashier;
        $data      = $this->sign($data);
        $url       = $this->url . '?' . http_build_query($data);
        return $url;
    }

    // 检查订单
    public function check($payjs_order_id)
    {
        $this->url = $this->api_url_check;
        $data      = ['payjs_order_id' => $payjs_order_id];
        return $this->post($data);
    }

    // 异步通知接收
    public function notify()
    {
        $data = $_POST;
        if ($this->checkSign($data) === true) {
            return $data;
        } else {
            exit("验签失败");
        }
    }

    // 数据签名
    public function sign(array $data)
    {
        $data['mchid'] = $this->mchid;
        array_filter($data);
        ksort($data);
        $data['sign'] = strtoupper(md5(urldecode(http_build_query($data) . '&key=' . $this->key)));
        return $data;
    }

    // 校验数据签名
    public function checkSign($data)
    {
        $in_sign = $data['sign'];
        unset($data['sign']);
        array_filter($data);
        ksort($data);
        $sign = strtoupper(md5(urldecode(http_build_query($data) . '&key=' . $this->key)));
        return $in_sign == $sign ? true : false;
    }

    // 数据发送
	public function post($data) {
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