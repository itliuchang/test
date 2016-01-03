<?php
class TestController extends Controller{
	public function actionIndex(){
		$post = new CPost;
		$post->getlist();print_r($post);die;
	}
}