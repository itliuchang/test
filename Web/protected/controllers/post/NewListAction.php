<?php
class NewListAction extends CAction{
	public function run(){
		$this->controller->bodyCss="newpostlist";
		$this->controller->render('newlist');
	}
}