<?php
class WechatController extends CController{
	public function actions(){
		return array(
			'wechatconnect' => 'application.controllers.wechat.WechatConnectAction',
            'wechatconnectcallback' => 'application.controllers.wechat.WechatConnectCallbackAction',
            'login' => 'application.controllers.wechat.LoginAction'		
		);
	}
}