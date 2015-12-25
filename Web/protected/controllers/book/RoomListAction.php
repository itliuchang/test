<?php
class RoomListAction extends CAction{
	public function run(){
		$now = date('Y-m-d',time());
		$date = Yii::app()->request->getParam('date');
		$date = $date==''?$now:$date;
		$room = new MeetingRoom($date,1000,'',1);
		
		$result = $room->listroom();
		foreach ($result['data'] as &$list){
			$list['my'] = CJSON::encode($list['my']);
			$list['other'] = CJSON::encode($list['other']);
		}
		if(Yii::app()->request->isAjaxRequest){
			$data = array(
				'data'=>$result['data'],
				'code'=>200
			);
			echo CJSON::encode($data);
		} else {
			$this->controller->render('roomlist',array(
				'data'=>$result['data'],
				'count'=>$result['count'],
				'date'=> $date
			));
		}
	}
}