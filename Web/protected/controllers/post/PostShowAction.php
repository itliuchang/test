<?php
class PostShowAction extends CAction{
	$this->controller->pageTitle ="Post";
	public function run(){
		$this->controller->render('postshow');
	}
}