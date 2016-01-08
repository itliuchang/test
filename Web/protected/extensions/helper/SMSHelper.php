<?php
class SMSHelper {
	
	// submail
	static function sendRegistCode($mobile, $code){
		$submail = Yii::app()->params['partner']['submail'];
		$params = array(
				'appid' => $submail['appid'],
				'sign_type' => $submail['sign_type'],
				'signature' => $submail['signature'],
				'project' => $submail['regist_project'],
				'to' => $mobile,
				'vars' => json_encode(array('code' => $code))
		);
		$output = Yii::app()->curl->post($submail['url'], $params);
		return  strpos($output, 'success');
	}
	
	static function sendLoginCode($mobile, $code){
		$submail = Yii::app()->params['partner']['submail'];
		$params = array(
				'appid' => $submail['appid'],
				'sign_type' => $submail['sign_type'],
				'signature' => $submail['signature'],
				'project' => $submail['login_project'],
				'to' => $mobile,
				'vars' => json_encode(array('code' => $code))
		);
		$output = Yii::app()->curl->post($submail['url'], $params);
		return  strpos($output, 'success');
	}
	
	// sms send
	/** 
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
	*/
	
}