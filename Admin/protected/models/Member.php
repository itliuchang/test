<?php
class Member extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        
        return 'user';
    }

    public function relations(){
        return array(
            'companyid' => array(self::BELONGS_TO, 'Companys', 'company'),
            'usertypeid'=>array(self::BELONGS_TO,'MemberType','userType'),
            'locationid'=>array(self::BELONGS_TO,'Hubs','location'),
            'reservation'=>array(self::HAS_MANY,'Reservations','userId'),
            'order'=>array(self::HAS_MANY,'Products','userId')
        );
    }

}