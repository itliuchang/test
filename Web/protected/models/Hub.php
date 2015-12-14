<?php
class Hub extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'hub';
    }

    
    public function relations(){
        return array(
            'reservation'=>array(self::HAS_MANY,'Reservations','hubId')
        );
    } 

}