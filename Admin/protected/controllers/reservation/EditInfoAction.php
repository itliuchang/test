<?php 
class EditInfoAction extends CAction{

	public function run(){
		$type = Yii::app()->request->getParam('type');
		$user = Yii::app()->request->getParam('user');
		$hub = Yii::app()->request->getParam('hub');
		$resTime = Yii::app()->request->getParam('resTime');
		$endTime = Yii::app()->request->getParam('endTime');
		$room = Yii::app()->request->getParam('room');

		$data = array(
			'type'=>$type,
			'userId'=>$user,
			'hubId'=>$hub,
			'resTime'=>$resTime,
			'endTime'=>$endTime,
			'conferenceroomId'=>$room
		);

		$proxy = new Reservation();
		$result = $proxy->createReservation($data);
		if($result['code']==200){
			$this->controller->redirect('/reservation/list');
		} else {
			throw new CHttpException($result['code'],$result['message']);
		}
	}
}