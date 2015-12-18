<?php  
class  EditinfoAction extends CAction{
	public function run(){
		$nickName = Yii::app()->request->getParam('nickName');
		$gender = Yii::app()->request->getParam('gender');
		$birthday = Yii::app()->request->getParam('birthday');
		$mobile = Yii::app()->request->getParam('mobile');
		$email = Yii::app()->request->getParam('email');
		$portrait = Yii::app()->request->getParam('portrait');
		$background = Yii::app()->request->getParam('background');
		$work = Yii::app()->request->getParam('work');
		$userType = Yii::app()->request->getParam('userType');
		$company = Yii::app()->request->getParam('company');
		$role = Yii::app()->request->getParam('role');
		$title = Yii::app()->request->getParam('title');
		$followers = Yii::app()->request->getParam('followers');
		$floor = Yii::app()->request->getParam('floor');
		$location = Yii::app()->request->getParam('location');
		$skills = Yii::app()->request->getParam('skills');
		$interests = Yii::app()->request->getParam('interests');
		$website = Yii::app()->request->getParam('website');
		$wechatid = Yii::app()->request->getParam('wechat');
		$facebook = Yii::app()->request->getParam('facebook');
		$twitter = Yii::app()->request->getParam('twitter');
		$instagram= Yii::app()->request->getParam('instagram');
		$description = Yii::app()->request->getParam('content');
		$linkedin = Yii::app()->request->getParam('linkedin');

		$data = array(
			'nickName'=>$nickName,
			'gender'=>$gender,
			'birthday'=>$birthday,
			'mobile'=>$mobile,
			'email'=>$email,
			'portrait'=>$portrait,
			'background'=>$background,
			'work'=>$work,
			'userType'=>$userType,
			'company'=>$company,
			'role'=>$role,
			'title'=>$title,
			'followers'=>$followers,
			'floor'=>$floor,
			'location'=>$location,
			'skills'=>$skills,
			'interests'=>$interests,
			'website'=>$website,
			'wechatid'=>$wechatid,
			'facebookid'=>$facebook,
			'twitterid'=>$twitter,
			'instagramid'=>$instagram,
			'linkedinid'=>$linkedin,
			'description'=>$description
		);

		$proxy = new BAuth();
		$result = $proxy->createUser($data);
		if($result['code']==200){
			$this->controller->redirect('/user/list');
		} else {
			throw new CHttpException($result['code'],$result['message']);
		}
	}
}