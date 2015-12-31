<?php
class ChangePasswordAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$id = Yii::app()->user->id;
			// $id = 1199;
			$user = User::model()->findByAttributes(array('id'=>$id));
			
			$oldPassword = Yii::app()->request->getParam('oldPassword');
			if($user->validatePassword($oldPassword)){
				$user->password = Yii::app()->request->getParam('password');
					
				$user->save();
				echo CJSON::encode(array('code'=>200, 'message'=> 'SUCCESS'));
			} else {
				echo CJSON::encode(array('code'=>500, 'message'=> '旧密码不正确'));
			}
		} else {
			$this->controller->render('changepassword');
		}
	}
}