<?php
class ChooseEnvironmentAction extends CAction{
	public function run(){
		$this->controller->render('chooseEnvironment');
	}
}