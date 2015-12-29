<?php
class UpdateProfileAction extends CAction{
	public function run($id=''){
		if(!$id){
			if(Yii::app()->request->isAjaxRequest){
				$id = Yii::app()->request->getParam('id');
				$name = Yii::app()->request->getParam('name');
				$service = Yii::app()->request->getParam('service');		
				if(!$id){
					$result = Company::model()->findByAttributes(array('name'=>$name));
					if($result){
						echo CJSON::encode(array('code'=>400, 'message'=> 'HAVING'));die;
					} else {
						$company = new Company;
						$company->createTime = date('Y-m-d H:i:s');
						$company->save();
						for($i = 0;$i<count($service);$i++){
							$proxy = new Service_company;
							$proxy->serviceId = $service[$i];
							$proxy->companyId = $company['id'];
							$proxy->save();
						}
					}
				} else {
					$company = Company::model()->findByAttributes(array('id'=>$id));
					$company->updateTime = date('Y-m-d H:i:s');
					$proxy = Service_company::model()->findAllByAttributes(array('companyId'=>$id));
					foreach($proxy as $list){
						$list->status = 0;
						$list->save();
					}
					for($i = 0;$i<count($service);$i++){
						$dp = new Service_company;
						$dp->serviceId = $service[$i];
						$dp->companyId = $company['id'];
						$dp->save();
					}
				}
				$company->name = $name;
				$company->ownerId = Yii::app()->user->id;  // FIXME 
				$company->email = Yii::app()->request->getParam('email');
				$company->website = Yii::app()->request->getParam('website');
				$company->logo = Yii::app()->request->getParam('logo');
				$company->location = User::model()->findByAttributes(array('id'=>Yii::app()->user->id))['location'];
				$company->background = Yii::app()->request->getParam('background');
				$company->introduction = Assist::removeXSS(Yii::app()->request->getParam('introduction'));
				$company->facebookid = Yii::app()->request->getParam('facebookid');
				$company->linkedinid = Yii::app()->request->getParam('linkedinid');
				$company->save();
								
				$user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
				$status = $user['status'];
				$user->status = 3;
				$user->company = $company->id;
				$user->save();			
				echo CJSON::encode(array('code'=>200, 'message'=> 'SUCCESS','data'=>array('status'=>$status)));
			} else {
				$this->controller->render('updateProfile');
			}
		} else {
			$id = Yii::app()->request->getParam('id');
			$company = Company::model()->findByAttributes(array('id' => $id));
			$user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
			$this->controller->render('updateProfile', array(
					'company' => $company,
					'status' => $user['status']
			));
		}
			
	}
}