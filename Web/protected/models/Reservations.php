<?php
class Reservations extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'reservation';
    }

    public function relations(){
    	return array(
    		'user'=>array(self::BELONGS_TO,'Member','userId','select'=>'nickName'),
            'hub'=>array(self::BELONGS_TO,'Hub','hubId'),
            'room'=>array(self::BELONGS_TO,'Room','conferenceroomId')
    	);
    }

}