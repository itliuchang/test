<?php
class ProfileAction extends CAction{
	public function run(){
		$id = Yii::app()->request->getParam('id');
		$company = Company::model()->findByAttributes(array('id' => $id));
		
		$this->controller->render('profile', array(
			'company' => $company
		));
	}
}