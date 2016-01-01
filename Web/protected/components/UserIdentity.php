<?php
class UserIdentity extends CUserIdentity{
	public $id;
	const ERROR_NO_BIND = 400;
	const ERROR_MOBILE_INVALID = 404;
	const ERROR_CODE_INVALID = 405;
	const ERROR_MAIL_INVALID = 406;
    public function __construct(){
        
    }
    public function logout(){
        Yii::app()->user->logout();
    }

    public function registAuth($user = null) {
    	$this->id = $user['id'];
    	$this->username = $user['nickName'];
        try{
        $this->setPersistentStates($user->attributes);
        }catch(CException $e){
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
        }
    }
    
    public function authWechat($wechat = '', $openid = ''){
    	try{
    		$unionid = $wechat['unionid'];
    		$account = Account::model()->findByAttributes(array('account' => $unionid, 'source' => 1,'status'=>1));
    		if(!empty($account)) {
    			if(!empty($account->userId)) {
    				$this->id = $account->userId;
                    $item = User::model()->findByAttributes(array('id'=>$account->userId));
    				$this->username = $item['nickName'];
    				
    				$this->setPersistentStates($item->attributes);
                    $this->errorCode = self::ERROR_NONE;
    			} else {
    				$this->errorCode = self::ERROR_NO_BIND;
    			}
    		} else {
    			$this->errorCode = self::ERROR_NO_BIND;
    		}
    		$wechat['openid'] = $openid;
    		Yii::app()->session['wechat'] = $wechat;
    	}catch(CException $e){
    		Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
    		$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
    	}
    	return !$this->errorCode;
    }
    
    public function authMobile($mobile = '', $code = '', $bind = 0) {
    	try{
    		$_code = Yii::app()->session['login_code'.$mobile];
    		if ($_code && $_code == $code) {
    			$user = User::model()->find('status!=0 and mobile=:mobile', array(':mobile' => $mobile));
    			if(!empty($user)){
    				$this->errorCode = self::ERROR_NONE;
    				
    				$this->id = intval($user->id);
    				$this->username = $user['nickName'];
    				$this->setPersistentStates($user->attributes);
    				
    				$this->bindWechat($bind, $user);
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
    
    public function authMail($email = '', $password = '', $bind = 0) {
    	try{
    		$user = User::model()->find('status!=0 and email=:email', array(':email' => $email));
    		if(!empty($user)){
    			$this->errorCode = self::ERROR_NONE;
    			if($user->validatePassword($password)){
    				$this->id = intval($user->id);
    				$this->username = $user['nickName'];
    				$this->setPersistentStates($user->attributes);
    				
    				$this->bindWechat($bind, $user);
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
    
    private function bindWechat($bind = 0, $user = array()) {
    	$wechat = Yii::app()->session['wechat'];
    	if($bind == 1 && $wechat) {
    		$account = Account::model()->findByAttributes(array('account' => $wechat['unionid'], 'source' => 1,'status'=>1));
    		if(!$account) {
    			$account = new Account();
    			$account->source = 1;
    			$account->account = $wechat['unionid'];
    			$account->subSource = $wechat['openid'];
                $account->userId = $user->id;
    			$account->insert();
    		}
    	}
    }
    
    public function getId(){
        return $this->id;
    }
}