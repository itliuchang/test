<?php
Yii::import('application.vendor.wxpayAPI.lib.*');
require_once('WxPay.Api.php');
require_once('WxPay.AppApi.php');
require_once('WxPay.Notify.php');

class WxJSPayNotifyHelper extends WxPayNotify{
    //查询订单
    public function __construct(){
        Yii::log('heeee',LEVEL_ERROR);
    }
    public function Queryorder($transaction_id, $scope = 'JSAPI'){
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        if($scope == 'APP'){
            $result = WxPayAppApi::orderQuery($input);
        }else{
            $result = WxPayApi::orderQuery($input);
        }
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS"){
            return true;
        }
        return false;
    }

    //重写回调处理函数并更新订单状态
    public function NotifyProcess($data, &$msg){
        // Array( <- $data
        //     [appid] => wx043b7e57e5b34701
        //     [attach] => tst
        //     [bank_type] => CFT
        //     [cash_fee] => 1
        //     [fee_type] => CNY
        //     [is_subscribe] => Y
        //     [mch_id] => 1255284001
        //     [nonce_str] => m5kw5jw21ymyy97an9zzu4tn9pzr8ut2
        //     [openid] => oRqCWt8RWZA9-JoDs2TbhvKBl-kA
        //     [out_trade_no] => 125528400120150727185109
        //     [result_code] => SUCCESS
        //     [return_code] => SUCCESS
        //     [sign] => AB42A3E63459944637BF05771D86669E
        //     [time_end] => 20150727185147
        //     [total_fee] => 1
        //     [trade_type] => JSAPI
        //     [transaction_id] => 1005280712201507270489874922
        // )
        // Yii::log(print_r($data, true), CLogger::LEVEL_ERROR, 'payment.notify');

        $notfiyOutput = array();
        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"], $data['trade_type'])){
            $msg = "订单查询失败";
            return false;
        }
        //更新订单状态
       
       $order = new COrder;
       $result = $order->update($data['transaction_id']);
       if($result['code']!==200){
            Yii::log('update fail', CLogger::LEVEL_ERROR, 'payment.notify');
       }

    }
}