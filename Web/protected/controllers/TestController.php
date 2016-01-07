<?php
class TestController extends Controller{
	public function actionIndex(){
		$user = new CReservation;
		$result = $user->cancel(302);
		print_r($result);die;
	}
}