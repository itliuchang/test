<?php
class NewPostAction extends CAction{
	public function run(){
		$this->controller->render('newpost');
	}
}