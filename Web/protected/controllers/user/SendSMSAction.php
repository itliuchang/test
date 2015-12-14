<?php
class SendSMSAction extends CAction{
	
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$mobile = Yii::app()->request->getParam('mobile');
			$type = Yii::app()->request->getParam('type');
			
			$code = rand(1000, 9999);
			if($type === 'login') {
				SMSHelper::sendLoginCode($mobile, $code);
				Yii::app()->session['login_code'] = $code;
			} elseif ($type === 'regist') {
				SMSHelper::sendRegistCode($mobile, $code);
				Yii::app()->session['regist_code'] = $code;
			}
		}
	}

}