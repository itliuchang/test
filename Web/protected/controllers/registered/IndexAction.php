<?php
class IndexAction extends CAction{
	public function run(){
		$this->controller->bodyCss='access';
		$this->controller->render('index');
	}
}