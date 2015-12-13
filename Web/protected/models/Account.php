<?php
class Account extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'account';
    }

    public function relations(){
        return array(
            'user' => array(self::HAS_ONE, 'User', 'userId', 'select' => array('id', 'nickName', 'portrait'))
        );
    }

}