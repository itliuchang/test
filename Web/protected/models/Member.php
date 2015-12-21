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
            'companyid' => array(self::BELONGS_TO, 'Company', 'company'),
            'usertypeid'=>array(self::BELONGS_TO,'MemberType','userType'),
            'reservation'=>array(self::HAS_MANY,'Reservations','userId')
        );
    }

}