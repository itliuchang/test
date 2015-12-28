<?php
class WechatConnectCallbackAction extends CAction{
    public function run(){
        if(Yii::app()->user->isGuest){
            if(Assist::isWeixin()){
                $code = Yii::app()->request->getParam('code');
                $state = Yii::app()->request->getParam('state');
                if(empty($code)){
                    throw new CException(Yii::t('yii', '授权码缺失'));
                }else{
                    $wechat = Yii::app()->params['partner']['wechat'];
                    $params = array(
                        'appid' => $wechat['appid'],
                        'secret' => $wechat['appsecret'],
                        'code' => $code,
                        'grant_type' => 'authorization_code'
                    );
                    
                    try{
                        $output = Yii::app()->curl->get($wechat['oauth2']['token'], $params);
                        $value = json_decode($output, true);
                        if(Yii::app()->curl->getStatus() == 200 && isset($value['access_token'])){
                            $userinfo = json_decode(Yii::app()->curl->get($wechat['oauth2']['userinfo'], array(
                                 'access_token' => $value['access_token'],
                                 'openid' => $value['openid'], 'lang' => 'zh_CN'
                            )), true);
                            
                            if(Yii::app()->curl->getStatus() == 200 && isset($userinfo['unionid'])){
                            	$_identity = new UserIdentity();
                            	$_identity->authWechat($userinfo, $value['openid']);
                            	if($_identity->errorCode === UserIdentity::ERROR_NONE){
                            		$duration = 86400;
                            		Yii::app()->user->login($_identity, $duration);
                            		$this->controller->redirect(Yii::app()->user->getReturnUrl(Assist::getDefaultURL()));
                            	} elseif ($_identity->errorCode === UserIdentity::ERROR_NO_BIND) {
                            		$this->controller->render('index');

                            	}
                            } else {
                            	throw new CException(Yii::t('yii','密钥错误或丢失。'));
                            }
                        }else{
                            Yii::log(print_r($value, true), CLogger::LEVEL_ERROR, 'user.wx.auth');
                            throw new CException(Yii::t('yii', '获取有效凭证失败'));
                        }
                    }catch(Exception $e){
                        throw new CException(Yii::t('yii', $e->getMessage() ?: '内部服务错误'));
                    }
                }
            }else{
                throw new CHttpException(403, Yii::t('yii', '仅支持微信访问'));
            }
        }else{
            $this->controller->redirect(Assist::getDefaultURL());
        }
    }
}