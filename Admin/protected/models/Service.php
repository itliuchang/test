<?php
class Service extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'service';
    }

    public function relations(){
    	return array(
    		'company'=>array(self::HAS_MANY,'Companys','serviceid'),
    	);
    }

}