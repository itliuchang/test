<?php 
class CommitConfirmAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$date = Yii::app()->request->getParam('date');
			$hubId = Yii::app()->request->getParam('hubId');
			$userId = Yii::app()->request->getParam('userId');
			$data = array(
				'startTime' => $date.' 00:00:00',
				'hubId' => $hubId,
				'userId' => $userId,
				'type' => 1
			);
			$proxy = new CReservation();
			$result = $proxy->createReservation($data);
			if($result['code']==200){
				echo CJSON::encode($result);
			} else {
				throw new CHttpException('401','error');
				
			}
		}
	}
}