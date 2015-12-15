<?php
class SendSMSAction extends CAction{
	
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$mobile = Yii::app()->request->getParam('mobile');
			$type = Yii::app()->request->getParam('type');
			
			$code = rand(1000, 9999);
			if($type === 'login') {
				SMSHelper::sendLoginCode($mobile, $code);
				Yii::app()->session['login_code'.$mobile] = $code;
				echo CJSON::encode(array('code'=>200,'message'=>''));
			} elseif ($type === 'regist') {
				$user = User::model()->findByAttributes(array('mobile' => $mobile));
				if($user) {
					echo CJSON::encode(array('code'=>500,'message'=>'手机号已注册'));
				} else {
					SMSHelper::sendRegistCode($mobile, $code);
					Yii::app()->session['regist_code'.$mobile] = $code;
					echo CJSON::encode(array('code'=>200,'message'=>''));
				}
			}
		}
	}

}