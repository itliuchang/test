<?php
class ProfileAction extends CAction{
	public function run($id=null){
		if($id){
			$company = Company::model()->findByAttributes(array('id' => $id));
			$service = Service_company::model()->findAllByAttributes(array('companyId'=>$id,'status'=>1));
			if($service){
				foreach($service as $list){
					$servicelist[] = Service::model()->findByAttributes(array('id'=>$list['serviceId']));
				}
				
			}
			$hub = Hub::model()->findByAttributes(array('id'=>$company['location']));
		}else{
			$company = Company::model()->findByAttributes(array('ownerId' => Yii::app()->user->id));
			$service = Service_company::model()->findAllByAttributes(array('companyId'=>$company['id'],'status'=>1));
			if($service){
				foreach($service as $list){
					$servicelist[] = Service::model()->findByAttributes(array('id'=>$list['serviceId']));
				}
				
			}
		}
		$this->controller->render('profile', array(
			'company' => $company,
			'service' =>$servicelist,
			'location' => $hub['location']
		));
	}
}