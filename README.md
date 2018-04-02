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
    "musnow/payjs": "^1.0.2"
}
```
更新
```$xslt
$ composer update
```


```$xslt
<?php
require 'vendor/autoload.php';

use \Payjs\Payjs;

$payjs = new Payjs([
    //jspay商户号id
    'merchantid' => '',
    //jspay商户密钥
    'merchantkey' => '',
    //异步通知的URL；必须为可直接访问的URL，不能带参数、session验证、csrf验证；留空则不通知
    'notifyurl' => '',
    //将返回值转换为对象，如需使用收银台模式请勿开启；不填默认开启
    'toobject' = false
]);

//订单id
$OrderID = 'wixin_order' . time();
//订单金额
$Amount = 100;
//商品说明
$Products = '测试订单';
//用户自定义数据，在notify的时候会原样返回
$Attach = null
//前端跳转地址
$JumpURL = '';
//jspay的订单id
$PayjsOrderID = '2017122519xxxxxxx26265498';

//扫码支付
$retData = $payjs->QRPay($OrderID,$Amount,$Products,$Attach);
print_r($retData);

//收银台模式
$retData = $payjs->Cashier($OrderID,$Amount,$Products,$JumpURL,$Attach);
print_r($retData);

//查询订单
$retData = $payjs->Query($PayjsOrderID);
print_r($retData);

//检查验证notify数据是否被篡改、伪造
//http://php.net/manual/en/reserved.variables.request.php
$retData = $payjs->Checking($_REQUEST);
print_r($retData);
```

传入参数说明

| 变量名 | 类型 | 必填 | 说明 |
| :----- |:------| :-- | :-----------|
| $OrderID | string(32) | Y | 订单id；不填写默认使用时间戳+随机六位数字(仅限测试) |
| $Amount | int(16) | Y | 订单金额；单位（分）如果不填写默认为￥0.01 |
| $Products | string(32) | N | 商品说明；如果不填写默认为“订单” |
| $JumpURL  | 	string(32) | N | 前端跳转地址；收银台模式和jsapi模式需要，根据文档内容显示目前未开启 |
| $PayjsOrderID | string(32) | Y | jspay的订单id |
| $Attach | string(127) | N | 用户自定义数据，在notify的时候会原样返回 |
| $_REQUEST | array() | Y | http://php.net/manual/en/reserved.variables.request.php |

水平有限，如果你发现哪里有错误请提交issues，感激不尽。
Y

#License  
payjs is under the MIT license.
