<?php 
class CreateAction extends CAction{
	public function run(){
		$start = Yii::app()->request->getParam('start');

		$proxy = new Conference();
		$dp = new Hubs();
		$result = $proxy->getRoomList($start,10);
		$hub = $dp->getHubList($start,10);
		$this->controller->render('edit',array(
			'room'=>$result['data'][0],
			'hub'=>$hub['data']
		));
	}
}