<?php
class UpdateProfileAction extends CAction{
	public function run(){
		$this->controller->pageTitle="Profile";
		if(Yii::app()->request->isAjaxRequest){
			$id = Yii::app()->user->id;
			$user = User::model()->findByAttributes(array('id'=>$id));
			$user->nickName = Yii::app()->request->getParam('nickName');
			$user->portrait = Yii::app()->request->getParam('portrait');
			Yii::app()->user->setState('portrait',Yii::app()->request->getParam('portrait'));
			$user->background = Yii::app()->request->getParam('background');
			$user->title = Yii::app()->request->getParam('title');
			$user->website = Yii::app()->request->getParam('website');
			$user->description = Assist::removeXSS(Yii::app()->request->getParam('description'));
			$user->birthday = Yii::app()->request->getParam('birthday');
			$user->gender = Yii::app()->request->getParam('gender');
			$user->location = Yii::app()->request->getParam('hub');
			$skills = preg_replace('/，+/', ',',Yii::app()->request->getParam('skills'));
			$skills = preg_replace('/,+/', ',',$skills);
			$user->skills = trim($skills,',');
			$interests =  preg_replace('/，+/', ',',Yii::app()->request->getParam('interests'));
			$interests =  preg_replace('/,+/', ',',$interests);
			$user->interests = trim($interests,',');
			//$user->wechatid = Yii::app()->request->getParam('wechatid');
			
			$user->facebookid = Yii::app()->request->getParam('facebookid');
			$user->twitterid = Yii::app()->request->getParam('twitterid');
			$user->linkedinid = Yii::app()->request->getParam('linkedinid');
			$user->instagramid = Yii::app()->request->getParam('instagramid');
			$status = Yii::app()->request->getParam('status');
			$havecode = Code::model()->findByAttributes(array('userId'=>$id));
			if($status == 1){
				$user->status = 2;
			} else if($status==21 && $havecode){
				$user->status = 22;
			} else {
				$user->status = 23;
			}
			if($user->save()){
				echo CJSON::encode(array('code'=>200, 'message'=> $user->status));
			}
		} else {
			$id = Yii::app()->user->id;
			$user = User::model()->findByAttributes(array('id' => $id));
			$proxy = new CHub;
			$hub = $proxy->getHubList();
			$this->controller->render('updateProfile', array(
				'user' => $user,
				'hub' => $hub['data']
			));
		}
	}
}