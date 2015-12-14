<?php
class EditAction extends CAction{
	public function run(){
		
		$id = Yii::app()->request->getParam('id');
		$name = Yii::app()->request->getParam('name');
		$email = Yii::app()->request->getParam('email');
		$phone = Yii::app()->request->getParam('phone');
		$website = Yii::app()->request->getParam('website');
		$logo = Yii::app()->request->getParam('logo');
		$background = Yii::app()->request->getParam('background');
		$location = Yii::app()->request->getParam('location');
		$hub = Yii::app()->request->getParam('hub');
		$service = Yii::app()->request->getParam('service');
		$facebook = Yii::app()->request->getParam('facebook');
		$linkedin = Yii::app()->request->getParam('linkedin');
		$introduction = Yii::app()->request->getParam('content');

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
		$dp = new BHub();
		$dc = Service::model()->findAll('status!=0');

		if(Yii::app()->request->isAjaxRequest){
			$result = $proxy->updateCompany($data,$id);
			echo CJSON::encode($result);
		} else {
			$result = $proxy->getCompanyInfo($id);
			$hub = $dp->getHubList($start,10);
			
			if($result['code']==200){
				$this->controller->render('edit',array(
					'data'=>$result['data'],
					'hub'=>$hub['data'],
					'service'=>$dc
				));
			} else {
				throw new CHttpException($result['code'],$result['message']);
				
			}
		}
	}
}