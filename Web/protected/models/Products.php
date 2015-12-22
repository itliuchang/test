<?php
class Products extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'product';
    }

    public function relations(){
    	return array(
            'order'=>array(self::HAS_MANY,'Order','productId'),
    	);
    }	
}