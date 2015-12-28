<?php
class WechatController extends CController{
	public $bodyCss='';
	public $layout = '//layouts/default';
	public function init(){
		$this->pageTitle = Yii::app()->name;
        
		if(isset($_REQUEST['lang'])&&$_REQUEST['lang']!=""){ //通过lang参数识别语言
            Yii::app()->language=$_REQUEST['lang'];
            setcookie('lang',$_REQUEST['lang']);
        }elseif(isset($_COOKIE['lang'])&&$_COOKIE['lang']!=""){ //通过$_COOKIE['lang']识别语言
            Yii::app()->language=$_COOKIE['lang'];
        }else{   //通过系统或浏览器识别语言
            $lang=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            Yii::app()->language=strtolower(str_replace('-', '_', $lang[0]));
        }
	}
	public function actions(){
		return array(
			'wechatconnect' => 'application.controllers.wechat.WechatConnectAction',
            'wechatconnectcallback' => 'application.controllers.wechat.WechatConnectCallbackAction',
            'index' => 'application.controllers.wechat.IndexAction'		
		);
	}
}