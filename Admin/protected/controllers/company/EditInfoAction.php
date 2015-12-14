<?php 
class EditInfoAction extends CAction{
	public function run(){
		$name = Yii::app()->request->getParam('name');
		$email = Yii::app()->request->getParam('email');
		$phone = Yii::app()->request->getParam('phone');
		$logo = Yii::app()->request->getParam('logo');
		$background = Yii::app()->request->getParam('background');
		$website = Yii::app()->request->getParam('website');
		$location = Yii::app()->request->getParam('location');
		$hub = Yii::app()->request->getParam('hub');
		$service = Yii::app()->request->getParam('service');
		$facebook = Yii::app()->request->getParam('facebook');
		$linkedin = Yii::app()->request->getParam('linkedin');
		$introduction = Yii::app()->request->getParam('introduction');

		$data = array(
			'name'=>$name,
			'email'=>$email,
			'phone'=>$phone,
			'website'=>$website,
			'logo'=>$logo,
			'background'=>$background,
			'location'=>$location,
			'hubId'=>$hub,
			'serviceid'=>$service,
			'facebookid'=>$facebook,
			'linkedinid'=>$linkedin,
			'introduction'=>$introduction,
		);
		$proxy = new BCompany();
		$result = $proxy->createCompany($data);
		if($result['code']==200){
			$this->controller->redirect('/company/list');
		} else {
			throw new CHttpException($result['code'],$result['message']);
		}
	}
}