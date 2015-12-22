<?php
class RoomListAction extends CAction{
	public function run(){
		$date = '2015-12-17';
		// $date = Yii::app()->request->getParam('date');
		$date = $GET['date'];
		var_dump($GET);
		$room = new MeetingRoom($date,1000,'',1);
		var_dump($room);
		$result = $room->listroom();
		foreach ($result['data'] as &$list){
			$list['my'] = CJSON::encode($list['my']);
			$list['other'] = CJSON::encode($list['other']);
		}
		
		$this->controller->render('roomlist',array(
			'data'=>$result['data'],
			'count'=>$result['count']
		));
	}
}