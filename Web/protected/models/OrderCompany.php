<?php
class OrderCompany extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'order_company_product';
    }

}