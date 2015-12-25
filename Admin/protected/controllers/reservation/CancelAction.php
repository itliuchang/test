<?php
class CancelAction extends CAction{
    public function run(){
        $id = Yii::app()->request->getParam('id');
        
    	if(Yii::app()->request->isAjaxRequest){
            $proxy = new BReservation();
            $result = $proxy->cancelReservation($id);
            echo CJSON::encode($result);
        }
    }
}