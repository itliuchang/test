<?php
class ProfileAction extends CAction{
	public function run($id=null,$page=1,$size=2){
		$this->controller->pageTitle="Profile";
		if(Yii::app()->request->isAjaxRequest){
			if(!$id){
				$id = Yii::app()->user->id;
			}
			$post = new CPost;
			$result = $post->getProfileList($id,$page,$size);
			echo CJSON::encode(array(
					'code'=>200,
					'mes'=>'success',
					'data'=>array('list'=>$result['data'])
				));
		}else{
			if($id) {
				$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
				$company = Company::model()->findByAttributes(array('ownerId'=>$user['id']));
				$location = Hub::model()->findByAttributes(array('id'=>$company['location']));
				$post = new CPost;
				$postlist = $post->getProfileList($id);
			} else {
				$id = Yii::app()->user->id;
				$user = User::model()->with('companyid')->findByAttributes(array('id' => $id));
				$company = Company::model()->findByAttributes(array('ownerId'=>$user['id']));
				$location = Hub::model()->findByAttributes(array('id'=>$company['location']));
				$post = new CPost;
				$postlist = $post->getProfileList($id);
			}
			$this->controller->render('profile', array(
					'user' => $user,
					'companylocation' => $location['location'],
					'postlist'=>$postlist['data']
			));
		}
		
	}
}