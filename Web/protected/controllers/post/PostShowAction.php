<?php
class PostShowAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="Post";
		$this->controller->render('postshow');
	}
}