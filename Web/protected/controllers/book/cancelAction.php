<?php
class CancelAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$id = Yii::app()->request->getParam('id');
			$reservation = new CReservation;
			$result = $reservation->cancel($id);
			if($result['code']==200){
				echo CJSON::encode(array(
					'code' => 200,
					'mes' => 'success'
				));
			}else{
				echo CJSON::encode(array(
						'code' => 500,
						'mes' => 'cancel fail'
					));
			}
		}
			
	}
}