<?php
class Order extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'order';
    }

    public function relations(){
    	return array(
    			'product'=>array(self::BELONGS_TO,'Products','productId','select'=>'times'),
    		);
    }
}