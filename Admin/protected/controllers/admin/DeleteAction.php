<?php
class DeleteAction extends CAction{
    public function run(){
		
		$id = Yii::app()->request->getParam('id');

		$proxy = new Auth();
		$result = $proxy->deleteAdmin($id);
		if($result){
			$data=array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
		echo CJSON::encode($data);
		
	}
}