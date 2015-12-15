<?php
class UserIdentity extends CUserIdentity{
    
	public $id;

	const ERROR_NO_BIND = 400;
	const ERROR_MOBILE_INVALID = 404;
	const ERROR_CODE_INVALID = 405;

	const ERROR_MAIL_INVALID = 406;
	public function __construct()
    {
       
    }
    public function logout(){
        Yii::app()->user->logout();
    }

    public function registAuth($user = null) {
    	$this->id = $user['id'];
    	$this->username = $user['nickName'];
    	$this->setPersistentStates($user);
    }
    
    public function authWechat($wechat = '', $openid = ''){
    	try{
    		$unionid = $wechat['unionid'];
    		$account = Account::model()->findByAttributes(array('account' => $unionid, 'source' => 1));
    		if(!empty($account)) {
    			if(!empty($account->user)) {
    				$this->id = $account->user['id'];
    				$this->username = $account->user['nickName'];
    				
    				$this->setPersistentStates($account->user);
    			} else {
    				$this->errorCode = self::ERROR_NO_BIND;
    			}
    		} else {
    			$account = new Account();
    			$account->source = 1;
    			$account->account = $wechat['unionid'];
    			$account->subSource = $openid;
    			
    			$account->insert();
    			
    			$wechat['id'] = $account->id;
    			Yii::app()->session['wechat'];
    			
    			$this->errorCode = self::ERROR_NO_BIND;
    		}
    	}catch(CException $e){
    		Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
    		$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
    	}
    	return !$this->errorCode;
    }
    
    public function authMobile($mobile = '', $code = '') {
    	try{
    		$_code = Yii::app()->session['login_code'.$mobile];
    		if ($_code && $_code == $code) {
    			$user = User::model()->findByAttributes(array('mobile' => $mobile));
    			if(!empty($user)){
    				$this->errorCode = self::ERROR_NONE;
    				
    				$this->id = intval($user->id);
    				$this->username = $user['nickName'];
    				$this->setPersistentStates($user);
    			}else{
    				$this->errorCode = self::ERROR_MOBILE_INVALID;
    			}
    		} else {
    			$this->errorCode = self::ERROR_CODE_INVALID;
    		}
    	}catch(CException $e){
    		Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
    		$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
    	}
    	return !$this->errorCode;
    }
    
    public function authMail($email = '', $password = '') {
    	try{
    		$user = User::model()->findByAttributes(array('email' => $email));
    		if(!empty($user)){
    			$this->errorCode = self::ERROR_NONE;
    			if($user->validatePassword($password)){
    				$this->id = intval($user->id);
    				$this->username = $user['nickName'];
    				$this->setPersistentStates($user);
    			} else {
    				$this->errorCode = self::ERROR_PASSWORD_INVALID;
    			}
    		}else{
    			$this->errorCode = self::ERROR_MAIL_INVALID;
    		}
    	}catch(CException $e){
    		Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
    		$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
    	}
    	return !$this->errorCode;
    }
    
    public function getId(){
        return $this->id;
    }
}