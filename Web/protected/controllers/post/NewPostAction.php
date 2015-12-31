<?php
class NewPostAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="New Post";
		$this->controller->render('newpost');
	}
}