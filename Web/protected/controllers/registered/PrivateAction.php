<?php 
class PrivateAction extends CAction{
	public function run(){
		$proxy = new  CHub;
		$result = $proxy->getHubList();
		$type = MemberType::model()->findAll();
		$this->controller->render('private',array(
			'data' => $result['data'],
			'type' => $type
		));
	}
}