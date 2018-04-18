# payjs
本项目是为payjs.cn适配的，可以为你的项目接入微信支付功能。

PAYJS 旨在解决需要使用交易数据流的个人、创业者、个体户等小微支付需求，帮助开发者使想法快速转变为原型   

https://payjs.cn/


如果你想使用本项目请使用 composer 安装

```$xslt
$ composer require musnow/payjs
```
或者在你的项目跟目录编辑 ```composer.json```
```$xslt
"require": {
    "musnow/payjs": "^2.0.0"
}
```
更新
```$xslt
$ composer update
```


```$xslt
<?php
require '../vendor/autoload.php';

$config = [
    'MerchantID' => '',                      //商户号
    'MerchantKey' => '',                     //密钥
    'NotifyURL' => 'https://www.baidu.com/', //notify地址 接收微信支付异步通知的回调地址。必须为可直接访问的URL，不能带参数、session验证、csrf验证。留空则不通知 需要保留最后的斜杠
];

$payjs = new \Musnow\Payjs\Pay($config);

$data = [
    'TotalFee' => 1,          //金额，单位 分
    'Body' => '测试订单',       //订单标题
    'Attach' => '测试订单s',    //用户自定义数据，在notify时会原样返回
    'outTradeNo' => time(),   //商户订单号，需要保证唯一
];

$ret = $payjs->qrPay($data);  //扫码支付
print_r($ret);              //返回数据

```

为方便参数扩展新版本改动比较大，不再兼容v1.0x版本，建议阅读example内demo进行编码使用。

水平有限，如果你发现哪里有错误请提交issues，感激不尽。


#License  
payjs is under the MIT license.
