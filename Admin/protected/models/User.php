<?php
class User extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'admin';
    }

    public function validatePassword($password){
        return md5($password) === $this->password;
    }
 
    private function hashPassword($password, $salt){
        return md5($password . $salt);
    }
}