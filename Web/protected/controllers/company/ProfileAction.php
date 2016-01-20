<?php
class ProfileAction extends CAction{
	public function run($id=null,$page=1,$size=2){
		$this->controller->pageTitle="Company";
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
				//取出公司所有成员
				$member = User::model()->findAllByAttributes(array('company'=>$id));
			}else{
				$user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
				$company = Company::model()->findByAttributes(array('id' => $user['company']));
				$service = Service_company::model()->findAllByAttributes(array('companyId'=>$company['id'],'status'=>1));
				if($service){
					foreach($service as $list){
						$servicelist[] = Service::model()->findByAttributes(array('id'=>$list['serviceId']));
					}
					
				}
				$hub = Hub::model()->findByAttributes(array('id'=>$company['location']));
				$post = new CPost;
				$postlist = $post->getCompanyList($company->id,$page,$size);
				$member = User::model()->findAllByAttributes(array('company'=>$user['company']));
			}
			$this->controller->render('profile', array(
				'company' => $company,
				'service' =>$servicelist,
				'location' => $hub['location'],
				'postlist' => $postlist['data'],
				'member' => $member
			));
			}
	}
}