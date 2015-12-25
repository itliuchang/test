<?php
class Room extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'conferenceRoom';
    }

    public function relations(){
    	return array(
    		'reservation'=>array(self::HAS_MANY,'Reservations','conferenceroomId'),
            'hub'=>array(self::BELONGS_TO,'Hubs','hubId','select'=>'name')
    	);
    }

}