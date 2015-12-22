<?php
class RoomShowAction extends CAction{
	public function run($id){
		$date = '2015-12-17';
		$userId = Yii::app()->user->id;
		$proxy = new MeetingRoom($date,1000,$id,1);
		$result = $proxy->getInfo();
		$my = $result['data']['my'];
		$other = $result['data']['other'];
		
		$this->controller->render('roomshow',array(
			'data'=>$result['data']['info'],
			'my'=>CJSON::encode($my),
			'other'=>CJSON::encode($other),
			'date'=>$date
		));
	}
}