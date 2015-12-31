<?php
class ChooseEnvironmentAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="Sigin Up";
		$this->controller->render('chooseEnvironment');
	}
}