<?php
class WxJSSDK extends CComponent{
    private $appId;
    private $appSecret;

    static function init($appId = '', $appSecret = ''){
        $appId = $appId ?: Yii::app()->params['partner']['wechat']['appid'];
        $appSecret = $appSecret ?: Yii::app()->params['partner']['wechat']['appsecret'];
        return new self($appId, $appSecret);
    }

    public function __construct($appId, $appSecret){
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    public function getSignPackage(){
        $jsapiTicket = WechatHelper::getJsApiTicket();

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);
        $signPackage = array(
            'appId' => $this->appId, 'nonceStr' => $nonceStr,
            'timestamp' => $timestamp, 'url' => $url,
            'signature' => $signature, 'rawString' => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for($i = 0; $i < $length; $i++){
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}