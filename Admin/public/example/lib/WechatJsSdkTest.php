<?php
class WechatJsSdkTest extends CComponent {
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }

  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $jsapi_ticket = Yii::app()->session['jsapi_ticket'];
    $data = json_decode($jsapi_ticket, true);
    if (empty($data) || $data['expire_time'] < time()) {
      $data = array();
      $accessToken = $this->getAccessToken();

      // 如果是企业号用以下 URL 获取 ticket
      // http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html#.E9.99.84.E5.BD.955-.E5.B8.B8.E8.A7.81.E9.94.99.E8.AF.AF.E5.8F.8A.E8.A7.A3.E5.86.B3.E6.96.B9.E6.B3.95
      // http://qydev.weixin.qq.com/wiki/index.php?title=WeixinJS%E6%8E%A5%E5%8F%A3
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url), true);
      // print_r($res);die;
      $ticket = $res['ticket'];
      if ($ticket) {
        $data['expire_time'] = time() + 7200; //$res['expires_in']
        $data['jsapi_ticket'] = $ticket;
        Yii::app()->session['jsapi_ticket'] = json_encode($data); 
      }
    } else {
      // echo 11;print_r($data);die;
      $ticket = $data['jsapi_ticket'];
    }

    return $ticket;
  }

  private function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $access_token = Yii::app()->session['access_token'];
    $data = json_decode($access_token, true);
    if (empty($data) || $data['expire_time'] < time()) {
      $data = array();
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
      $res = json_decode($this->httpGet($url), true);
      $access_token = $res['access_token'];
      if ($access_token) {
        //有效期为7200秒，过期了需要维护
        //http://mp.weixin.qq.com/wiki/15/54ce45d8d30b6bf6758f68d2e95bc627.html
        $data['expire_time'] = time() + 7200; //$res['expires_in']
        $data['access_token'] = $access_token;
        Yii::app()->session['access_token'] = json_encode($data);
      }
    } else {
      $access_token = $data['access_token'];
    }
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }
}

