<?php
class MyReservationsAction extends CAction{
	public function run(){
		$reservation =new CReservation;
		$upcoming = $reservation->getupcomingRes(1000);
		$previous = $reservation->getpreRes(1000);
		// print_r($upcoming);die;
		if ($upcoming['code']==200&&$previous['code']==200) {
			$this->controller->render('myreservations',array('upcominglist'=>$upcoming['data'],'previouslist'=>$previous['data']));
		}else{
			throw new Exception("Error Processing Request", 1);
			
		}
	}
}