<?php
class TestController extends Controller{
	public function actionIndex(){
		// $order=new COrder;
		// $result = $order->update(596);
		// print_r($result);die;
		// $date = date('U');
		// echo date("Y/m/d",$date+Assist::timestampToMonthTimestamp($date)-86400);
		$a = array('nickName'=>'Cecilia');
		$b = array('nickName'=>' Paul Hu');
		if(substr(strtoupper($a['nicName']),0,1)>substr(strtoupper($b['nickName']),0,1)){
			echo 1;
		}else{
			echo -1;
		}
	}
}