<?php
class ProfileAction extends CAction{
	public function run($id=null){
		if($id){
			$company = Company::model()->findByAttributes(array('id' => $id));
		}else{
			$company = Company::model()->findByAttributes(array('id' => Yii::app()->user->id));
		}
		$this->controller->render('profile', array(
			'company' => $company,
		));
	}
}