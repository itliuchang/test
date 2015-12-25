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
            'reservation'=>array(self::HAS_MANY,'Reservations','hubId'),
            'hubId' => array(self::HAS_MANY,'User','location'),
        );
    } 

    public function getHUb(){
        $criteria  = new CDbCriteria;
        $criteria->select=array('id');
        return $this->findAll($criteria);
    }

}