<?php
class UpdateProfileAction extends CAction{
	public function run($id=null){
		$this->controller->pageTitle="Company";
		if(!$id){
			if(Yii::app()->request->isAjaxRequest){
				$id = Yii::app()->request->getParam('id');
				$name = Yii::app()->request->getParam('name');
				$service = Yii::app()->request->getParam('service');
				$result = Company::model()->findByAttributes(array('name'=>$name));
				if($result && $result['ownerId']!=Yii::app()->user->id){
					echo CJSON::encode(array('code'=>400, 'message'=> 'HAVING'));die;
				} else {
					if(!$id){
						$company = new Company;
						$now = date('Y-m-d H:i:s');
						$company->createTime = $now;
						$company->save();
						$companyid = Company::model()->findByAttributes(array('createTime'=>$now));
						for($i = 0;$i<count($service);$i++){
							$proxy = new Service_company;
							$proxy->serviceId = $service[$i];
							$proxy->companyId = $companyid['id'];
							$proxy->save();
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
					$company->phone = Yii::app()->request->getParam('phone');
					$company->website = Yii::app()->request->getParam('website');
					$company->logo = Yii::app()->request->getParam('logo');
					$company->location = User::model()->findByAttributes(array('id'=>Yii::app()->user->id))['location'];
					$company->background = Yii::app()->request->getParam('background');
					$company->introduction = Assist::removeXSS(Yii::app()->request->getParam('introduction'));
					$company->facebookid = Yii::app()->request->getParam('facebookid');
					$company->linkedinid = Yii::app()->request->getParam('linkedinid');
					$company->save();
									
					$user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));					
					$user->status = 3;					
					$user->company = $company->id;
					$user->save();
					//所有公司员工设置公司
					$code = Code::model()->findAllByAttributes(array('userId'=>Yii::app()->user->id,'status'=>1));
					if($code){
						foreach ($code as $list) {
							$user = CodeUsed::model()->findAllByAttributes(array('codeId'=>$list['id']));
							foreach ($user as $value) {
								$item = User::model()->findByAttributes(array('id'=>$value['userId']));
								$item->company = $company->id;
								$item->save();
							}
						}
					}
						
					echo CJSON::encode(array('code'=>200, 'message'=> 'SUCCESS','data'=>array('status'=>$status)));
				}						
			} else {
				$firservice = Service::model()->findAll("parentId is null");
				foreach ($firservice as $key) {
					$a[$key['name']] = Service::model()->findAllByAttributes(array('parentId'=>$key['id']));
					// array_push($a,$key['name']);
				}
				$this->controller->render('updateProfile',array(
					'totalservice' => $a
				));
			}
		} else {
			$id = Yii::app()->request->getParam('id');

			$company = Company::model()->findByAttributes(array('id' => $id));
			$myservice = Service_company::model()->findAllByAttributes(array('companyId' => $company['id'],'status'=>1));
			$user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
			foreach($myservice as $list){
				$array[] = Service::model()->findByAttributes(array('id'=>$list['serviceId']));
			}
			$firservice = Service::model()->findAll("parentId is null");
			foreach ($firservice as $key) {
				$a[$key['name']] = Service::model()->findAllByAttributes(array('parentId'=>$key['id']));
				// array_push($a,$key['name']);
			}
			// var_dump($a);die;
			$this->controller->render('updateProfile', array(
					'company' => $company,
					'status' => $user['status'],
					'myservice' => $array,
					'totalservice' => $a
			));
		}
			
	}
}