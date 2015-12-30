<?php 
class CommitConfirmAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$date = Yii::app()->request->getParam('date');
			$hubId = Yii::app()->request->getParam('hubId');
			$userId = Yii::app()->user->id;
			$data = array(
				'startTime' => $date.' 10:00:00',
				'hubId' => $hubId,
				'userId' => $userId,
				'type' => 1
			);
			$proxy = new CReservation();
			$num = $proxy->getNumber($date,$hubId);
			if($num['count']<50 ){
				$result = $proxy->createReservation($data);
				echo CJSON::encode(array('code'=>200,'message'=>'success'));
			} else {
				echo CJSON::encode(array('code'=>300,'message'=>'no num'));
			}
		}
	}
}