<?php
class UpdateProfileAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$name = Yii::app()->request->getParam('name');
			$result = Company::model()->findByAttributes(array('name'=>$name));
			if($result){
				echo CJSON::encode(array('code'=>400, 'message'=> 'HAVING'));
			} else {
				$id = Yii::app()->request->getParam('id');
							
				if(!$id){
					$company = new Company;
				} else {
					$company = Company::model()->findByAttributes(array('id'=>$id));
				}
				$company->name = $name;
				$company->email = Yii::app()->request->getParam('email');
				$company->website = Yii::app()->request->getParam('website');
				$company->logo = Yii::app()->request->getParam('logo');
				$company->location = User::model()->findByAttributes(array('id'=>Yii::app()->user->id))['location'];
				$company->background = Yii::app()->request->getParam('background');
				$company->introduction = Assist::removeXSS(Yii::app()->request->getParam('introduction'));
				$company->facebookid = Yii::app()->request->getParam('facebookid');
				$company->linkedinid = Yii::app()->request->getParam('linkedinid');
				$company->save();
				
				echo CJSON::encode(array('code'=>200, 'message'=> 'SUCCESS'));
			}
			
		} else {
			$id = Yii::app()->request->getParam('id');
			$company = Company::model()->findByAttributes(array('id' => $id));
			$this->controller->render('updateProfile', array(
					'company' => $company
			));
		}
	}
}