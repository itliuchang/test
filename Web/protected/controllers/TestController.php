<?php
class TestController extends Controller{
	public function actionIndex(){
		$order=new COrder;
		$result = $order->update(596);
		print_r($result);die;
	}
}