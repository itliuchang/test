<?php
class MyReservationsAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="My Reservations";
		$reservation =new CReservation;
		// Yii::app()->user->id = 1187;
		$upcoming = $reservation->getupcomingRes(Yii::app()->user->id);
		$previous = $reservation->getpreRes(Yii::app()->user->id);
		// print_r($upcoming);die;
		if ($upcoming['code']==200&&$previous['code']==200) {
			$this->controller->render('myreservations',array('upcominglist'=>$upcoming['data'],'previouslist'=>$previous['data']));
		}else{
			throw new Exception("Error Processing Request", 1);
			
		}
	}
}