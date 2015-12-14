<?php
class MemberType extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'member_type';
    }

    public function relations(){
    	return array(
    		'type'=>array(self::HAS_MANY,'Member','userType')
    	);
    }
}