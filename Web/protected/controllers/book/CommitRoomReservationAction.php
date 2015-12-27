<?php 
class CommitRoomReservationAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$userId = Yii::app()->user->id;
			$id = Yii::app()->request->getParam('id');
			$hubId = Yii::app()->request->getParam('hubId');
			$starts = Yii::app()->request->getParam('starts');
			$hour = Yii::app()->request->getParam('hour');
			$date = Yii::app()->request->getParam('date');
			$startTime = $date.' '.$starts.':00';
			$endTime = strtotime($startTime);
			$endTime = date('Y-m-d H:i:s',$endTime+$hour*60*60);
			
			$data = array(
				'startTime' => $startTime,
				'endTime' => $endTime, 
				'userId' => $userId,
				'hubId' => $hubId,
				'conferenceroomId' => $id,
				'type' => 2
			);
			
			$proxy = new CReservation();
			$result = $proxy->createReservation($data);
			if($result['code']==200){
				echo CJSON::encode($result);
			} else {
				throw new CHttpException($result['code'],$result['message']);
				
			}
			
		}
	}
}