<?php
class ProfileAction extends CAction{
	public function run(){
		$id = Yii::app()->request->getParam('id');
		$id=1000;
		if($id) {
			$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
			
		} else {
			$id = Yii::app()->user->id;
			$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
		}
		
		if($user['company']) {
			$company = $user->company;
		}
		$this->controller->render('profile', array(
				'user' => $user,
				'company' => $company
		));
	}
}