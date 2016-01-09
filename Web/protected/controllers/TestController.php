<?php
class TestController extends Controller{
	public function actionIndex(){
		$user = new CReservation;
		$result = $user->cancel(322);
		print_r($result);die;
	}
}