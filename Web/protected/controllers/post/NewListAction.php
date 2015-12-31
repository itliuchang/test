<?php
class NewListAction extends CAction{
	$this->controller->pageTitle ="naked HUB";
	public function run(){
		$this->controller->bodyCss="newpostlist";
		$this->controller->render('newlist');
	}
}