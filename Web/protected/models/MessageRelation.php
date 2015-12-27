<?php
class MessageRelation extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'messageRelation';
    }

    public function primaryKey(){
        return array('id1', 'id2');
    }
}