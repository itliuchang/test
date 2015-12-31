<?php
class NewListAction extends CAction{
	public function run(){
	    $this->controller->pageTitle ="naked HUB";
		$this->controller->bodyCss="newpostlist";
		$this->controller->render('newlist');
	}
}