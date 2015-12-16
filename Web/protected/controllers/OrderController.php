<?php
class OrderController extends Controller{
	public function actionIndex(){
		$this->bodyCss='orderDetail';
		$this->render('index');
	}
}