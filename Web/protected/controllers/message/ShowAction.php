<?php
class ShowAction extends CAction{
	public function run(){
		$this->controller->bodyCss='messageshow';
		$this->controller->render('show');
	}
}