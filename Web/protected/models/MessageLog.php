<?php
class MessageLog extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'messageLog';
    }
}