<?php
class Company extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'company';
    }

    public function relations(){
    	return array(
    		'companyid'=>array(self::HAS_MANY,'Member','company')
    	);
    }

}