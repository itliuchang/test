<?php
class RoomShowAction extends CAction{
	$this->controller->pageTitle ="Rooms";
	public function run($id,$date='',$hub=''){
		// $now = str_replace('$','-',$date);
		if($date){
			$hub = substr($date,-1);
			$date = str_replace('$','-',$date);
			$date = substr($date,0,10);
		} else {
			$hub = Yii::app()->request->getParam('hub');
			$date = Yii::app()->request->getParam('date');
		}
		$userId = Yii::app()->user->id;
		$proxy = new MeetingRoom($date,$userId,$id,$hub);
		$result = $proxy->getInfo();
		$my = $result['data']['my'];
		$other = $result['data']['other'];
		
		if(Yii::app()->request->isAjaxRequest){
			
			$data = array(
				'code' => 200,
				'data'=>array(
					'my' => CJSON::encode($my),
					'other'=>CJSON::encode($other),
				)
				
			);
			echo CJSON::encode($data);
		} else {
			$this->controller->render('roomshow',array(
				'data'=>$result['data']['info'],
				'my'=>CJSON::encode($my),
				'other'=>CJSON::encode($other),
				'date'=>$date,
				'hub' => $hub
			));
		}
	}
}