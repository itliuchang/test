<?php
class ProfileAction extends CAction{
	public function run($id=null,$page=1,$size=2){
		if(Yii::app()->request->isAjaxRequest){
			if(!$id){
				$id=$company = Company::model()->findByAttributes(array('ownerId' => Yii::app()->user->id))->id;
			}
			$post = new CPost;
			$result = $post->getCompanyList($id,$page,$size);
			echo CJSON::encode(array(
					'code'=>200,
					'mes'=>'success',
					'data'=>array('list'=>$result['data'])
				));
		}else{
			if($id){
				$company = Company::model()->findByAttributes(array('id' => $id));
				$service = Service_company::model()->findAllByAttributes(array('companyId'=>$id,'status'=>1));
				if($service){
					foreach($service as $list){
						$servicelist[] = Service::model()->findByAttributes(array('id'=>$list['serviceId']));
					}
					
				}
				$hub = Hub::model()->findByAttributes(array('id'=>$company['location']));
				$post = new CPost;
				$postlist = $post->getCompanyList($id,$page,$size);
			}else{
				$company = Company::model()->findByAttributes(array('ownerId' => Yii::app()->user->id));
				$service = Service_company::model()->findAllByAttributes(array('companyId'=>$company['id'],'status'=>1));
				if($service){
					foreach($service as $list){
						$servicelist[] = Service::model()->findByAttributes(array('id'=>$list['serviceId']));
					}
					
				}
				$hub = Hub::model()->findByAttributes(array('id'=>$company['location']));
				$post = new CPost;
				$postlist = $post->getCompanyList($company->id,$page,$size);
			}
			$this->controller->render('profile', array(
				'company' => $company,
				'service' =>$servicelist,
				'location' => $hub['location'],
				'postlist' => $postlist['data']
			));
			}
	}
}