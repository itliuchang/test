<?php 
class PrivateAction extends CAction{
	public function run(){
		$proxy = new  CHub;
		$result = $proxy->getHubList();
		$type = MemberType::model()->findAll();
		if(Yii::app()->request->isAjaxRequest){
			$name = Yii::app()->request->getParam('name');
			$phone = Yii::app()->request->getParam('phone');
			$email = Yii::app()->request->getParam('email');
			$number = Yii::app()->request->getParam('number');
			$membertype = Yii::app()->request->getParam('membertype');
			$hub = Yii::app()->request->getParam('hub');
			$proxy = new PrivateOrder;
			$proxy->name = $name;
			$proxy->phone = $phone;
			$proxy->email = $email;
			$proxy->number = $number;
			$proxy->membertype = $membertype;
			$proxy->hub = $hub;
			$proxy->save();
			echo CJSON::encode(array('code'=>200,'message'=>'success'));
		} else {
			$this->controller->render('private',array(
				'data' => $result['data'],
				'type' => $type
			));
		}
		
	}
}