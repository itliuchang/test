<?php
class ProfileAction extends CAction{
	public function run($id=null){
		if($id) {
			$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
			$company = Company::model()->findByAttributes(array('ownerId'=>$user['id']));
			$location = Hub::model()->findByAttributes(array('id'=>$company['location']));
		} else {
			$id = Yii::app()->user->id;
			$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
			$cpmpany = Company::model()->findByAttributes(array('ownerId'=>$user['id']));
			$location = Hub::model()->findByAttributes(array('id'=>$company['location']));
		}
		
		$this->controller->render('profile', array(
				'user' => $user,
				'companylocation' => $location['location']
		));
	}
}