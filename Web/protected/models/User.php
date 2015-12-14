<?php
class User extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function validatePassword($password){
    	return md5($password) === $this->password;
    }
    
    public function tableName(){
        return 'user';
    }

}