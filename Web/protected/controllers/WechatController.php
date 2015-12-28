<?php
class WechatController extends CController{
	public $bodyCss='';
	public function actions(){
		return array(
			'wechatconnect' => 'application.controllers.wechat.WechatConnectAction',
            'wechatconnectcallback' => 'application.controllers.wechat.WechatConnectCallbackAction',
            'index' => 'application.controllers.wechat.IndexAction'		
		);
	}
}