<?php
class AccountAction extends CAction{
	public function run(){
		$this->controller->bodyCss='account';
		$this->controller->render('account');
	}
}