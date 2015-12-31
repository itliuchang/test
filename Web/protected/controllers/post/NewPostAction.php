<?php
class NewPostAction extends CAction{
	$this->controller->pageTitle ="New Post";
	public function run(){
		$this->controller->render('newpost');
	}
}