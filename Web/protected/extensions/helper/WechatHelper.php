<?php
class WechatHelper{
    static function getUserInfo($openid){
        $wechat = Yii::app()->params['partner']['wechat'];
        $params = array(
            'access_token' => self::getAccessToken(),
            'openid' => $openid,
            'lang' => 'zh_CN'
        );
        $output = Yii::app()->curl->get($wechat['connect']['userinfo'], $params);
        $res = CJSON::decode($output, true);
        return empty($res['errcode'])? $res : array();
    }

    //获取全局/基础access_token
    static function getAccessToken(){
        $wxtoken = Storage::model()->findOne(array('name' => 'wxtoken'));
        $data = $wxtoken? json_decode($wxtoken['data'], true) : null;
        if(empty($data) || $data['expire_time'] < time()){
            $data = array();
            $wechat = Yii::app()->params['partner']['wechat'];
            $params = array(
                'grant_type' => 'client_credential',
                'appid' => $wechat['appid'],
                'secret' => $wechat['appsecret'],
            );
            $output = Yii::app()->curl->get($wechat['connect']['token'], $params);
            $res = json_decode($output, true);
            $access_token = $res['access_token'];
            if($access_token){
                $data['expire_time'] = time() + 7000; // $res['expires_in'] = 7200
                $data['access_token'] = $access_token;
                if(empty($wxtoken)){
                    $storage = new Storage();
                    $storage->setAttributes(array(
                        'name' => 'wxtoken', 'data' => json_encode($data),
                        'gtime' => date('Y-m-d H:i:s'),
                    ), false);
                    $storage->save();
                }else{
                    $wxtoken->saveAttributes(array(
                        'data' => json_encode($data), 'gtime' => date('Y-m-d H:i:s'),
                    ));
                }
            }
        }else{
            $access_token = $data['access_token'];
        }
        return $access_token;
    }

    static function getJsApiTicket(){
        $wxTicket = Storage::model()->findOne(array('name' => 'wxticket'));
        $data = $wxTicket? json_decode($wxTicket['data'], true) : null;
        if(empty($data) || $data['expire_time'] < time()){
            $data = array();
            $wechat = Yii::app()->params['partner']['wechat'];
            $accessToken = self::getAccessToken();
            $params = array(
                'type' => 'jsapi',
                'access_token' => $accessToken,
            );
            $output = Yii::app()->curl->get($wechat['connect']['ticket'], $params);
            $res = json_decode($output, true);
            //Array([errcode] => 0 [errmsg] => ok [ticket] => sM4AOVdWfPE4DxkXGEs8VORfHVGyGSlNVxREFNRDWF4L36Ay9lnv91cKzF1UUWfgvhoK8a8JcN_f898KExvUZA [expires_in] => 7200)
            $ticket = $res['ticket'];
            if($ticket){
                $data['expire_time'] = time() + 7000;
                $data['ticket'] = $ticket;
                if(empty($wxTicket)){
                    $storage = new Storage();
                    $storage->setAttributes(array(
                        'name' => 'wxticket', 'data' => json_encode($data),
                        'gtime' => date('Y-m-d H:i:s'),
                    ), false);
                    $storage->save();
                }else{
                    $wxTicket->saveAttributes(array(
                        'data' => json_encode($data), 'gtime' => date('Y-m-d H:i:s'),
                    ));
                }
            }
        }else{
            $ticket = $data['ticket'];
        }
        return $ticket;
    }
}