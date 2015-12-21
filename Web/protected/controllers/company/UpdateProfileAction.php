<?php
class UpdateProfileAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$company = new Company();
			$company->id = Yii::app()->request->getParam('id');
			$company->name = Yii::app()->request->getParam('name');
			$company->logo = Yii::app()->request->getParam('logo');
			$company->background = Yii::app()->request->getParam('background');
			$company->introduction = Yii::app()->request->getParam('introduction');
				
			//$company->offerings = Yii::app()->request->getParam('offerings');
			//$company->interests = Yii::app()->request->getParam('interests');
			//$company->wechatid = Yii::app()->request->getParam('wechatid');
				
			$company->facebookid = Yii::app()->request->getParam('facebookid');
			$company->twitterid = Yii::app()->request->getParam('twitterid');
			$company->linkedinid = Yii::app()->request->getParam('linkedinid');
			$company->instagramid = Yii::app()->request->getParam('instagramid');
				
			$company->save();
			echo CJSON::encode(array('code'=>200, 'message'=> 'SUCCESS'));
		} else {
			$id = Yii::app()->request->getParam('id');
			$company = Company::model()->findByAttributes(array('id' => $id));
			$this->controller->render('updateProfile', array(
					'company' => $company
			));
		}
	}
}