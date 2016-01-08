<?php
class TestController extends Controller{
	public function actionIndex(){
		/*$user = new CReservation;
		$result = $user->cancel(302);
		print_r($result);die;*/
		print_r(Yii::app()->params['partner']['wechat']);die;
	}
}