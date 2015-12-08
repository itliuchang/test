<?php 
class EditAction extends CAction{
	public function run(){
		$id = Yii::app()->request->getParam('id');
		$type = Yii::app()->request->getParam('type');
		$userId = Yii::app()->request->getParam('userId');
		$hub = Yii::app()->request->getParam('hub');
		$resTime = Yii::app()->request->getParam('resTime');
		$endTime = Yii::app()->request->getParam('endTime');
		$room = Yii::app()->request->getParam('room');

		$data = array(
			'type'=>$type,
			'userId'=>$userId,
			'hubId'=>$hub,
			'resTime'=>$resTime,
			'endTime'=>$endTime,
			'conferenceroomId'=>$room
		);

		$proxy = new Reservation();
		$dp = new Hubs();
		if(Yii::app()->request->isAjaxRequest){
			$result = $proxy->updateReservation($data,$id);
			echo CJSON::encode($result);
		} else {
			$result = $proxy->getReservationInfo($id);
			$hub = $dp->getHubList($start,10);
			if($result['code']==200){
				$this->controller->render('edit',array(
					'data'=>$result['data'],
					'hub'=>$hub['data']
				));
			} else {
				throw new CHttpException($result['code'],$result['message']);
				
			}
		}		
	}
}