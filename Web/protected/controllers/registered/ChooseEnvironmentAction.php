<?php
class ChooseEnvironmentAction extends CAction{
	public function run(){
		$this->controller->pageTitle="Sign Up";
		$this->controller->render('chooseEnvironment');
	}
}