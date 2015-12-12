<?php
class ChangePasswordAction extends CAction{
	public function run(){
		$this->controller->render('changepassword');
	}
}