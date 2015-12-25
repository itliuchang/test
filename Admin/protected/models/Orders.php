<?php
class Orders extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'order';
    }

    public function relations(){
    	return array(
    		'product'=>array(self::BELONGS_TO,'Products','productId','select'=>'name'),
    		'user'=>array(self::BELONGS_TO,'Member','userId','select'=>'nickName')
    	);
    }

}