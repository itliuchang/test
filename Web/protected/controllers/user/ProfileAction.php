<?php
class ProfileAction extends CAction{
	public function run(){
		$id = Yii::app()->request->getParam('id');
		if($id) {
			$user = User::model()->findByAttributes(array('id' => $id));
			
		} else {
			$id = Yii::app()->user->id;
			$user = User::model()->findByAttributes(array('id' => $id));
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