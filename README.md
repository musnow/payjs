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
    //商户id
    'merchantid' => '',
    //商户key
    'merchantkey' => '',
    'notifyurl' => ''
]);

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


水平有限，如果哪里有错误请指出。

#License
Medoo is under the MIT license.
