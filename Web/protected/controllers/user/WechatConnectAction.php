<?php
class WechatConnectAction extends CAction{
    public function run(){
        if(Yii::app()->user->isGuest){
            if(Assist::isWeixin()){
                //login valid for ajax request
                $returnurl = Yii::app()->request->getParam('returnurl'); //->encodeURIComponent
                if(!empty($returnurl)){
                    Yii::app()->user->setReturnUrl($returnurl); //urldecode($returnurl)
                }

                $wechat = Yii::app()->params['partner']['wechat'];
                $params = array(
                    'appid' => $wechat['appid'],
                    'redirect_uri' => 'http://hubapp.livenaked.com' . $wechat['oauth2']['callback'],
                    'response_type' => 'code',
                    //snsapi_base只能取到openid，但如果之前用snsapi_userinfo已经授权过则再用snsapi_base的token就也
                    //可以取得用户信息(在一段时间内或者针对已授权过的用户snsapi_userinfo与snsapi_base取得的
                    //token权限是一样的，都可以用此token有权调用sns_usernifo接口)。
                    //但如果之前没有授权过用snsapi_base的access_token是不能调用sns_usernifo接口的，会报未获授权的
                    //错误，故只能取到用户的openid。
                    'scope' => $wechat['oauth2']['scope'][1],
                    'state' => 1
                );
                
                $url = $wechat['oauth2']['authorize'] . http_build_query($params). '#wechat_redirect';
                $this->controller->redirect($url);
            }else{
                // throw new CException(Yii::t('yii', '请在微信客户端打开链接'));
                throw new CHttpException(403, Yii::t('yii', '请在微信客户端打开链接'));
            }
        }else{
            $this->controller->redirect(Assist::getDefaultURL());
        }
    }
}