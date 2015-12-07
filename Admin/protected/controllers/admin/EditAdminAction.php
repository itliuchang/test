<?php
class EditAdminAction extends CAction{
	public function run(){
		$id = Yii::app()->request->getParam('id');
		$name = Yii::app()->request->getParam('name');
		$loginName = Yii::app()->request->getParam('loginName');
		$passowrd = Yii::app()->request->getParam('password');
		$level = Yii::app()->request->getParam('level');
		
		$data = array(
			'name'=>$name,
			'loginName'=>$loginName,
			'password'=>md5($password),
			'level'=>$level,
		);
		$proxy = new Auth();
		
		$result = $proxy->addAdmin($data);
		if ($result){
			$this->controller->redirect('/admin/list');
		} else {
			throw new CHttpException($result['code'],$result['message']);
		}
		
	}
}