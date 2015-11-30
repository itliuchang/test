<?php
class WechatJsSdk extends CComponent {
  private $appId;
  private $appSecret;
  private $requestUrl;
  private $filePath;

  //$requestUrl = '/pk2/' . Yii::app()->user->id . '.html';
  public function __construct($appId, $appSecret, $requestUrl = null) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
    $this->requestUrl = $requestUrl;
    //http://www.yiiframework.com/doc/guide/1.1/zh_cn/basics.namespace
    //Yii::getPathOfAlias('application') . DIRECTORY_SEPARATOR . 'runtime'
    //Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'runtime'
    $this->filePath = Yii::app()->getRuntimePath();
    // $this->db = Yii::app()->couchbase->getConnection();
  }

  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    //if(empty($this->requestUrl)){
      $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    //}else{
    //  $url = "$protocol$_SERVER[HTTP_HOST]{$this->requestUrl}";
    //}

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

  private function getJsApiTicket(){
    $ticketFile = $this->filePath . DIRECTORY_SEPARATOR . 'jsapi_ticket.json';
    if(!file_exists($ticketFile)) file_put_contents($ticketFile, json_encode(array('expire_time' => 0, 'jsapi_ticket' => ''))); //FILE_APPEND
    // 写进全局的couchbase,不使用session,不然每个用户都是请求一次ticket会导致微信api超出日调用限制
    // Yii::app()->couchbase->getConnection()->set('jsapi_ticket', array('expire'=> time(), 'ticket' => 'test'));
    // print_r(Yii::app()->couchbase->getConnection()->get('jsapi_ticket'));die;
    $data = json_decode(file_get_contents($ticketFile), true);
    if(empty($data) || $data['expire_time'] < time()){
      $data = array();
      $accessToken = $this->getAccessToken();
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url), true);
      $ticket = $res['ticket'];
      if($ticket){
        $data['expire_time'] = time() + 7000; //time() + $res['expires_in'] = time() + 7200
        $data['jsapi_ticket'] = $ticket;
        $fp = fopen($ticketFile, "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $ticket = $data['jsapi_ticket'];
    }

    return $ticket;
  }

  private function getAccessToken(){
    $tokenFile = $this->filePath . DIRECTORY_SEPARATOR . 'access_token.json';
    if(!file_exists($tokenFile)) file_put_contents($tokenFile, json_encode(array('expire_time' => 0, 'access_token' => '')));

    $data = json_decode(file_get_contents($tokenFile), true);
    if (empty($data) || $data['expire_time'] < time()) {
      $data = array();
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
      $res = json_decode($this->httpGet($url), true);
      $access_token = $res['access_token'];
      if ($access_token) {
        $data['expire_time'] = time() + 7000;
        $data['access_token'] = $access_token;
        $fp = fopen($tokenFile, "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
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

