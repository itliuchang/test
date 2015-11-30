<?php
class User extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        // return 'sns_user';
        return '{{user}}';
    }

    /*
    public function relations(){
        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'userRole')
        );
    } */

    public function validatePassword($password){
        return md5($password) === $this->password;
    }
    
    public function getRuleName($userRole) {
    	$name = '';
    	if($userRole == 1) {
    		$name = 'admin';
    	} else if($userRole == 2) {
    		$name = 'daren';
    	} else if($userRole == 3) {
    		$name = 'normal';
    	} 
    	return $name;
    }
 
    private function hashPassword($password, $salt){
        return md5($password . $salt);
    }
}