<?php
class TestController extends Controller{
	public function actionIndex(){
		// $order=new COrder;
		// $result = $order->update(596);
		// print_r($result);die;
		$date = date('U');
		echo date("Y/m/d",$date+Assist::timestampToMonthTimestamp($date)-86400);
	}
}