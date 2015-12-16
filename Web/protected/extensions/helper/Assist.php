<?php
Yii::import('application.vendor.php-useragent.*');
Yii::import('application.vendor.converemojitostr.*');
Yii::import('application.vendor.qiniu2.*');
use Qiniu\Auth;

require_once('useragent.class.php');
require_once('emoji.php');

class Assist{
    public static function getQiniuDomain($imgUrl, $extend = ''){
        if(preg_match('/^https?:/i', $imgUrl)){
            $res = $imgUrl;
        }else{
            $res = Yii::app()->params['partner']['qiniu']['domain'] . '/' . $imgUrl;
        }
        return empty($extend)? $res : $res . '?' . $extend;
    }

    //七牛获取token和domain
    public static function getQiniuToken(){
        $bucket = Yii::app()->params['partner']['qiniu']['bucket'];
        $ak = Yii::app()->params['partner']['qiniu']['ak'];
        $sk = Yii::app()->params['partner']['qiniu']['sk'];
        $domain = Yii::app()->params['partner']['qiniu']['domain'];
        $auth = new Auth($ak, $sk);
        $upToken = $auth->uploadToken($bucket);
        return array('uptoken'=>$upToken,'domain'=>$domain);
    }

    public static function convertToPayAmount($price){
        return $price * 100;
    }

    public static function convertToDisplayAmount($price){
        return $price / 100;
    }

    public static function getOrderExpireTime($timestamp){
        $timestamp = $timestamp ?: time();
        if(date('Ymd', $timestamp) <= date('Ymd', strtotime('+1 day'))){
            return date('YmdHis', time() + 60 * 60 * 3); //3小时
        }else{
            // return date('YmdHis', strtotime('-12 hours', $timestamp)); //减去12小时
            return date('YmdHis', strtotime('+24 hours', time()));
        }
    }

    public static function getPayURL($orderID, $payType){
        $payType = $payType ?: CConstant::PAYMETHOD_WX;
        $url = '';
        switch($payType){
            case CConstant::PAYMETHOD_WX:
                $url = '/payment/wxpay/jsapi/pay-' . $orderID . '.html';
                break;
        }
        return $url;
    }

    //不支持大于100的数字大写转换
    public static function numtoupper($v, $unit = false){
        $nmap = array('O', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十');
        $convert = function($n) use ($unit, $nmap){
            if($unit && $n === 0) return '零';
            return is_int($n)? preg_replace_callback('/\d/', function($m) use ($nmap){
                return $nmap[intval($m[0])];
            }, (string)$n) : '';
        };
        if($unit){
            $v = strval($v);
            $units = array('', '十', '百', '千', '万', '十万', '百万', '千万', '亿');
            $len = strlen($v);
            $result = '';
            for($i = 0; $i < $len; $i++){
               if($v[$i] === 0 && $v > 100 && $len - 1 !== $i){
                    $result .= $convert(intval($v[$i]));
               }elseif($v[$i] !== 0){
                    $result .= $convert(intval($v[$i])) . $units[$len - $i - 1];
               }
            }
            $result = preg_replace('/^一十(.*?)$/', "十\${1}", $result);
            return preg_replace('/(零十)?零$/', '', $result);
        }else{
            return $convert($v);
        }
    }

    public static function amountformat($number){
        return number_format($number, 2, '.', ''); //money_format
    }

    public static function formatCount($i = 0){
        $i = $i ?: 0;
        return $i > 9999? '9999+' : $i;
    }

    public static function stripEmptyTag($content){
        return preg_replace('/<p><br\/?><\/p>/im', '', str_replace(array("\r\n", "\r", "\n"), '', $content));
    }

    public static function getHashcode($data){
        $str = '';
        foreach($data as $v) {
            $str .= $v['lng'] . '' . $v['lat'];
        }
        return md5($str);
    }

    public static function removeEmoji($content, $replaceStr = ':)'){
        //[\ud83c\udc00-\ud83c\udfff]|[\ud83d\udc00-\ud83d\udfff]|[\u2600-\u27ff]
        // return preg_replace('/\\\ue[0-9a-f]{3}/ie', '', $content);
        return emoji_to_string($content, $replaceStr);
    }

    public static function removeXSS($data){
        return is_array($data)? CClean::cleanArray($data) : CClean::cleanInput($data);
    }

    public static function removeXSS2($data){
        $data = preg_replace('/<[^>]*?(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*?>/im', '', $data);
        $data = preg_replace('/\son/im', '  on', $data);
        $data = preg_replace('/\son[^>]+?(\s?=[^>]+?)?([\s>])/im', '$2', $data);
        return $data;
    }

    public static function isWeixin(){
        return stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false;
    }

    public static function isQQBrowser(){
        return !self::isWeixin() && stripos($_SERVER['HTTP_USER_AGENT'], 'MQQBrowser') !== false;
    }

    public static function isAndroid() {
    	return Yii::app()->session['android-webview'];
    }

    public static function isIphone(){
        return preg_match('/iphone/i', $_SERVER['HTTP_USER_AGENT']);
    }

    public static function isIOS(){
        return preg_match('/(iPhone|iPad|iPod)/i', $_SERVER['HTTP_USER_AGENT']);
    }
    
    public static function mergeArray(){
        $args=func_get_args();
        $res=array_shift($args);
        while(!empty($args)){
            $next=array_shift($args);
            foreach($next as $k => $v){
                if(is_array($v) && isset($res[$k]) && is_array($res[$k]))
                    $res[$k]=self::mergeArray($res[$k],$v);
                elseif(is_numeric($k))
                    isset($res[$k]) ? $res[]=$v : $res[$k]=$v;
                else
                    $res[$k]=$v;
            }
        }
        return $res;
    }

    public static function getDeviceInfo($useragent = ''){
        $detect = Yii::app()->mdetect;
        if($useragent) $detect->setUserAgent($useragent);
        $ua = UserAgentFactory::analyze($useragent ?: $_SERVER['HTTP_USER_AGENT']);

        //操作系统类型:ios,android
        $os = $detect->getOS();
        // $osType = strtolower($os['title'] ?: ($ua->os['title'] ?: 'unkown'));
        $osType = strtolower($os['title'] ?: ($ua->os['code'] ?: 'unkown'));
        //浏览器类型
        $browser = $detect->getBrowser();
        $browserType = strtolower($browser['title'] ?: ($ua->browser['code'] ?: 'unkown'));
        //--浏览器版本号,格式:最多4段,每段3位整数
        $browserVersion = $browser['version'] ?: '0';
        //终端类型
        $device = $detect->getDevice();
        $deviceType = strtolower($device['title'] ?: ($ua->platform['code'] ?: 'unkown'));
        //终端唯一标识
        // $deviceID = Yii::app()->session['IMEI'];
        // $deviceID = self::getIMEI();
        $deviceID = 1;
        // demo: ios/safari/4.0.0/ipad/xxx或android/UC/10.3.2.559/xiaomi/xxx
        return sprintf('%s/%s/%s/%s/%s', $osType, $browserType, $browserVersion, $deviceType, $deviceID);
    }

    public static function getDefaultURL(){
        return '/post/newlist';
    }
}