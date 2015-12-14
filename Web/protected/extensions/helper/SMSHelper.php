<?php
class SMSHelper {
	
	static function sendRegistCode($mobile, $code){
		$sms = Yii::app()->params['partner']['sms'];
		$params = array(
				'userid' => $sms['userid'],
				'account' => $sms['account'],
				'password' => $sms['password'],
				'action' => $sms['action'],
				'mobile' => $mobile,
				'content' => sprintf($sms['regist_tpl'], $code)
		);
		$output = Yii::app()->curl->post($sms['send_url'], $params);
		return  strpos($output, 'Success');
	}
	
	static function sendLoginCode($mobile, $code){
		$sms = Yii::app()->params['partner']['sms'];
		$params = array(
				'userid' => $sms['userid'],
				'account' => $sms['account'],
				'password' => $sms['password'],
				'action' => $sms['action'],
				'mobile' => $mobile,
				'content' => sprintf($sms['login_tpl'], $code)
		);
		$output = Yii::app()->curl->post($sms['send_url'], $params);
		return  strpos($output, 'Success');
	}
	
}