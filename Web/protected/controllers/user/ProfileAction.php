<?php
class ProfileAction extends CAction{
	public function run($id=null){
		$this->controller->pageTitle ="Profile";
		if($id) {
			$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
		} else {
			$id = Yii::app()->user->id;
			$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
		}
		
		$this->controller->render('profile', array(
				'user' => $user
		));
	}
}