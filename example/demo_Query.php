<?php
/**
 * Created by PhpStorm.
 * User: lixia
 * Date: 2018/4/18
 * Time: 19:24
 */
require '../vendor/autoload.php';

/*
官方文档：https://payjs.cn/help/api-lie-biao/ding-dan-cha-xun.html
*/

$config = [
    'MerchantID' => '',                      //商户号
    'MerchantKey' => '',                     //密钥
    'NotifyURL' => 'https://www.baidu.com/', //notify地址 接收微信支付异步通知的回调地址。必须为可直接访问的URL，不能带参数、session验证、csrf验证。留空则不通知 需要保留最后的斜杠
];

$payjs = new \Musnow\Payjs\Pay($config);

$data = [
    'PayjsOrderId' => 20180418191722003805784411,   //payjs的订单号
];

$ret = $payjs->Query($data);    //查询订单
print_r($payjs);                //返回数据
