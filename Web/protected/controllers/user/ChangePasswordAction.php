<?php
class ChangePasswordAction extends CAction{
	public function run(){
        $this->controller->pageTitle='Change Password';
		if(Yii::app()->request->isAjaxRequest){
			$id = Yii::app()->user->id;
			$user = User::model()->findByAttributes(array('id'=>$id));
			
			$oldPassword = Yii::app()->request->getParam('currentpassword');
			if(!empty($oldPassword) && $user->validatePassword($oldPassword)){

				$user->password = md5(Yii::app()->request->getParam('newpassword'));
					
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