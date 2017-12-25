# payjs
本项目是为payjs.cn适配的

如果你想使用请使用 composer 安装

```$xslt
composer require musnow/payjs
```

更新

```$xslt
composer update
```

```$xslt
require 'vendor/autoload.php';
use \Payjs\Payjs;

$payjs = new Payjs([
    //jspay商户号id
    'merchantid' => '',
    //jspay商户密钥
    'merchantkey' => '',
    //异步通知的URL；必须为可直接访问的URL，不能带参数、session验证、csrf验证。留空则不通知
    'notifyurl' => ''
]);

// 传入参数说明
// $OrderID        订单id；如果不填写使用时间戳+随机六位数字
// $Amount         金额；单位（分）如果不填写默认为￥0.01
// $Products       商品说明；如果不填写默认为“订单”
// $JumpURL        前端跳转地址；收银台模式和jspay需要 根据文档说的目前未开启
// $PayjsOrderID   jspay的订单id

//扫码支付
$retData = $payjs->QRPay($OrderID,$Amount,$Products);
print_r($retData);

//收银台模式
$retData = $payjs->Cashier($OrderID,$Amount,$Products,$JumpURL);
print_r($retData);

//jspay
$retData = $payjs->JSPay($OrderID,$Amount,$Products,$JumpURL);
print_r($retData);

//查询订单
$retData = $payjs->Query($PayjsOrderID);
print_r($retData);
```


水平有限，如果你发现哪里有错误请提交issues，感激不尽。

#License  

Medoo is under the MIT license.
