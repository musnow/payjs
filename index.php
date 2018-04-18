<?php
/**
 * Created by PhpStorm.
 * User: lixia
 * Date: 2018/4/18
 * Time: 19:06
 */

require 'vendor/autoload.php';

$config = [
//    'ToObject' => false,
    'MerchantID' => 'XZMXND',
    'MerchantKey' => 'vVNQnFTkTeU4eMH9',
    'NotifyURL' => 'https://pay.yubanmei.com/',
];

$payjs = new \Musnow\Payjs\Pay($config);

$data = [
    'TotalFee' => 1,
    'Body' => '测试订单',
    'Attach' => '测试订单s',
    'outTradeNo' => time(),
];

$data = [
    'PayjsOrderId' => '2018041819172100350246940'
];

$ret = $payjs->Query($data);
print_r($ret);
