<?php
class UserIdentity extends CUserIdentity{
    
	public $id;

	const ERROR_NO_BIND = 400;
	
    public function logout(){
        Yii::app()->user->logout();
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
    			// regist account
    			
    			$this->errorCode = self::ERROR_NO_BIND;
    		}
    	}catch(CException $e){
    		Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
    		$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
    	}
    	return !$this->errorCode;
    }
    
    public function authSMS($mobile = '', $code = '') {
    	
    }
    
    public function authMail($mail = '', $password = '') {
    	
    }
    
    public function getId(){
        return $this->id;
    }
}