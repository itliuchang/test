<?php
class RoomListAction extends CAction{
	public function run($id=''){
		$this->controller->pageTitle ="Rooms";
		$id = $id==''?1:$id;
		$now = date('Y-m-d',time());
		$date = Yii::app()->request->getParam('date');
		$date = $date==''?$now:$date;
		$room = new MeetingRoom($date,Yii::app()->user->id,'',$id);
		
		$result = $room->listroom();
		if($result['data']){
			foreach ($result['data'] as &$list){
				$list['my'] = CJSON::encode($list['my']);
				$list['other'] = CJSON::encode($list['other']);
			}
		}
		
		if(Yii::app()->request->isAjaxRequest){
			$data = array(
				'data'=>$result['data'],
				'code'=>200
			);
			echo CJSON::encode($data);
		} else {
			$proxy = new CHub();
			$hub = $proxy->getHubList();
			$this->controller->render('roomlist',array(
				'data'=>$result['data'],
				'date'=> $date,
				'hub' => $hub['data'],
				'hubid' => $id
			));
		}
	}
}