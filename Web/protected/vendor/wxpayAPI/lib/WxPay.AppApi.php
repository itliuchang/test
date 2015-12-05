<?php
require_once "WxPay.Exception.php";
require_once "WxPay.Api.php";
require_once "WxPay.AppConfig.php";
require_once "WxPay.Data.php";

//微信开放平台 API
class WxPayAppApi extends WxPayApi{
    public static function orderQuery($inputObj, $timeOut = 6){
        $url = "https://api.mch.weixin.qq.com/pay/orderquery";
        //检测必填参数
        if(!$inputObj->IsOut_trade_noSet() && !$inputObj->IsTransaction_idSet()) {
            throw new WxPayException("订单查询接口中，out_trade_no、transaction_id至少填一个！");
        }
        $inputObj->SetAppid(WxPayAPPConfig::APPID);//公众账号ID
        $inputObj->SetMch_id(WxPayAPPConfig::MCHID);//商户号
        $inputObj->SetNonce_str(self::getNonceStr());//随机字符串
        
        $inputObj->SetAppSign();//签名
        $xml = $inputObj->ToXml();

        $startTimeStamp = parent::getMillisecond();//请求开始时间
        $response = parent::postXmlCurl($xml, $url, false, $timeOut);
        $result = WxPayResults::Init($response);
        parent::reportCostTime($url, $startTimeStamp, $result);//上报请求花费时间
        return $result;
    }
}