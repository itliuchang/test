<?php
class DeleteAction extends CAction{
    public function run(){
		
		$id = Yii::app()->request->getParam('id');

		$proxy = new BAuth();
		$result = $proxy->deleteAdmin($id);
		echo CJSON::encode($result);
		
	}
}