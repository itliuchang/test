<?php
class Hubs extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'hub';
    }

    
    public function relations(){
        return array(
            'reservation'=>array(self::HAS_MANY,'Reservations','hubId'),
            'company'=>array(self::HAS_MANY,'Companys','hubId'),
            'location'=>array(self::HAS_MANY,'Member','location'),
            'room'=>array(self::HAS_MANY,'Room','hubId')
        );
    } 

    public function getHub(){
        $criteria  = new CDbCriteria;
        $criteria->select=array('id','location');
        return $this->findAll($criteria);
    }

}