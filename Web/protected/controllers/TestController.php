<?php
class TestController extends Controller{
	public function actionIndex(){
		$user = new CPost;
		$result = $user->getCompanyList(64,1,2);
		print_r($result);die;
	}
}