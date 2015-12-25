<?php
class EditAction extends CAction{
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
		$proxy = new BAuth();
		if(Yii::app()->request->isAjaxRequest){
			$result = $proxy->updateAdmin($data,$id);
			echo CJSON::encode($result);
		} else {
			$result = $proxy->getAdminInfo($id);
			if($result['code']==200){
				$this->controller->render('edit',array(
					'data'=>$result['data']
				));
			} else {
				throw new CHttpException($result['code'],$result['message']);
				
			}
		}
	}
}