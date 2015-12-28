<?php
class RoomShowAction extends CAction{
	public function run($id){
		$now = date('Y-m-d',time());
		$date = Yii::app()->request->getParam('date');
		$date = $date==''?$now:$date;
		$userId = Yii::app()->user->id;
		$proxy = new MeetingRoom($date,$userId,$id,1);
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
				'date'=>$date
			));
		}
	}
}