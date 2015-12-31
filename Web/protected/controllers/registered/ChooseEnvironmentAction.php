<?php
class ChooseEnvironmentAction extends CAction{
	$this->controller->pageTitle ="Sigin Up";
	public function run(){
		$this->controller->render('chooseEnvironment');
	}
}