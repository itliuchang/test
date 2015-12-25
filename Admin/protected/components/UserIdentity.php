<?php
class UserIdentity extends CUserIdentity{

	const ERROR_NOT_ADMIN = 400;

    public $id;
    public $partner = 5;
	private $config = array();

    public function __construct($config = array(), $partner = 5){
        $this->config = $config;
        $this->partner = $partner;
    }

    public function logout() {
        Yii::app()->user->logout();
    }

    public function authenticate($accessToken = '', $openid = ''){
		try {
			$url = Yii::app()->params['api']['user']['login'];
			$header = array('Content-Type' => 'application/json;charset=UTF-8');
			$data = array('access_token' => $accessToken, 'openid' => $openid, 'authtype'=>$this->partner, 'noregister' => 0);

			$output = Yii::app()->curl->post($url, json_encode($data), array(), $header);
            $value = json_decode($output, true);
            /**
             * {"code":200,"message":"","data":{"account":"o1i0ws4aWP2btgLeqrLhyl4pa7pg","mobile":"","nickName":"喻湘平","portrait":"http://wx.qlogo.cn/mmopen/dXVPQCXysoXlXcpqyCTzVXqXL5F3U3H8tZOfiacPde3fjKjyKVrgOMYicYXN07CWHxJOOWqia6pK3v03j4n73acd23bQPsAicRLz/0","shortID":"","token":"77f5e369-835b-41d9-ada0-5763760cb67ff76012be-b1bb-4802-bc8b-4c33","userId":186901,"userRole":3}}
             */
            if($value['code'] == 200){
            	$this->errorCode = self::ERROR_NONE;
            	$user = $value['data'];
            	$this->id = $user['userId'];
            	$this->username = $user['nickName'];
            	$this->setPersistentStates($user);
            } elseif ($value['code'] == self::ERROR_NOT_DAREN_ROLE) {
            	$this->errorCode = self::ERROR_NOT_DAREN_ROLE;
            } else {
            	$this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
		}catch(CException $e){
			Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
			$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
		}
		return !$this->errorCode;
    }

    public function authenticateAdmin($username, $password){
    	try{
    		$user = User::model()->findByAttributes(array('loginName' => $username));
    		if(!empty($user)){
    			$this->errorCode = self::ERROR_NONE;
    			if($user->password=$password){
    				$this->id = intval($user->id);
    				$this->username = $username;
    				if($user->level == 3) {
    					$this->errorCode = self::ERROR_NOT_ADMIN;
    				} else {
    					$this->setPersistentStates($user);
    				}
    			} else {
    				$this->errorCode = self::ERROR_PASSWORD_INVALID;
    			}
    		}else{
    			$this->errorCode = self::ERROR_USERNAME_INVALID;
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
