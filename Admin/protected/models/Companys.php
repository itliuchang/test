<?php
class Companys extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'company';
    }

    public function relations(){
    	return array(
    		'companyid'=>array(self::HAS_MANY,'Member','company'),
            'hub'=>array(self::BELONGS_TO,'Hubs','hubId','select'=>'name'),
            'service'=>array(self::BELONGS_TO,'Service','serviceid','select'=>'name')
    	);
    }

    public function getCompany(){
        $criteria  = new CDbCriteria;
        $criteria->select=array('id','name');
        return $this->findAll($criteria);
    }

}