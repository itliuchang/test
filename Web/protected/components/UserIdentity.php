<?php
class UserIdentity extends CUserIdentity{
    public $id;

    public function logout(){
        Yii::app()->user->logout();
    }

    public function authenticate(){
        try{
            //此处直接查询用户信息登录
            if($value['code'] == 200){
                $this->errorCode = self::ERROR_NONE;
                $user = $value['data'];
                if(empty($user['token'])){
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                }else{
                    $this->id = $user['userId'];
                    $this->username = $user['nickName'];

                    $this->setPersistentStates($user);
                    if(YII_ENV == 'test') Yii::log(print_r($user, true), CLogger::LEVEL_ERROR, 'user.login');
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