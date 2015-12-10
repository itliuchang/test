<?php
class DeleteAction extends CAction{
    public function run(){
        $id = Yii::app()->request->getParam('id');
        
		$proxy  = new Order();
		$result = $proxy->deleteOrder($id);
		echo CJSON::encode($result);
    }
}