<?php
class TestController extends Controller{
	public function actionIndex(){
		$user = new CPost;
		$user->getpost(1);die;
	}
}