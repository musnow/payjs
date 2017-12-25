<?php
/**
 * Created by PhpStorm.
 * User: lixia
 * Date: 2017/12/25
 * Time: 17:53
 */

namespace Payjs;

class Payjs
{
    private $MerchantID;
    private $MerchantKey;
    private $NotifyURL;
    private $AutoSign = true;
    private $AutoToObject = true;

    /**
     * Payjs constructor.
     * @param $config
     */
    public function __construct($config = null){
        if(!is_array($config)){
            return false;
        }
        if(isset($config['merchantid'])){
            $this->MerchantID = $config['merchantid'];
        }
        if(isset($config['merchantkey'])){
            $this->MerchantKey = $config['merchantkey'];
        }
        if(isset($config['notifyurl'])){
            $this->NotifyURL = $config['notifyurl'];
        }
    }

    /*
     * 扫码支付
     */
    public function QRPay($OrderID = null,$Amount = 1,$Products = '订单'){
        if (is_null($OrderID)){
            $OrderID = self::SetOrderID();
        }
        $RetURL = 'https://payjs.cn/api/native';
        $Data = [
            'mchid' => $this->MerchantID,
            'total_fee' => $Amount,
            'body' => $Products,
            'out_trade_no' => $OrderID
        ];

        return $this->Curl($RetURL,$Data);
    }

    /*
     * 收银台模式
     */
    public function Cashier($OrderID = null,$Amount = 1,$Products = '订单',$JumpURL = ''){
        if (is_null($OrderID)){
            $OrderID = self::SetOrderID();
        }
        $RetURL = 'https://payjs.cn/api/cashier';
        $Data = [
            'mchid' => $this->MerchantID,
            'total_fee' => $Amount,
            'body' => $Products,
            'out_trade_no' => $OrderID,
            'callback_url' => $JumpURL
        ];

        return $this->Curl($RetURL,$Data);
    }

    /*
     * JSpay
     * 注：无测试条件
     */
    public function JSPay($OrderID = null,$Amount = 1,$Products = '订单',$JumpURL = ''){
        if (is_null($OrderID)){
            $OrderID = self::SetOrderID();
        }
        $RetURL = 'https://payjs.cn/api/jspay';
        $Data = [
            'mchid' => $this->MerchantID,
            'total_fee' => $Amount,
            'body' => $Products,
            'out_trade_no' => $OrderID,
            'callback_url' => $JumpURL
        ];

        return $this->Curl($RetURL,$Data);
    }

    /*
     * 订单查询
     */
    public function Query($OrderID = null){
        if (is_null($OrderID)){
            return '必须填入payjs订单id';
        }
        $RetURL = 'https://payjs.cn/api/check';
        $Data['payjs_order_id'] = $OrderID;

        return $this->Curl($RetURL,$Data);
    }

    /*
     * 生成随机数字
     */
    protected static function SetOrderID($Length = 6){
        $Rand =  rand(pow(10,($Length - 1)), pow(10,$Length) -1);
        return time() . $Rand;
    }

    /*
     * 签名
     */
    protected function Sign(array $data) {
        ksort($data);
        $sign = strtoupper(md5(urldecode(http_build_query($data)).'&key='.$this->MerchantKey));
        return $sign;
    }

    /*
     * curl
     */
    protected function Curl($Url,$Arrry){
        if($this->AutoSign){
            $Arrry['sign'] = $this->Sign($Arrry);
            if (!array_key_exists('payjs_order_id',$Arrry)){
                $Arrry['notify_url'] = $this->NotifyURL;
            }
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $Arrry);
        $cexecute = curl_exec($ch);
        curl_close($ch);

        if ($cexecute) {
            if($this->AutoToObject){
                return json_decode($cexecute);
            }else{
                return $cexecute;
            }
        } else {
            return false;
        }
    }
}