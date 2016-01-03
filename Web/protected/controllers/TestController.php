<?php
class TestController extends Controller{
	public function actionIndex(){
		$user = new CUser;
		$user->like(1207,2);die;
	}
}