<?php
class CompanyListAction extends CAction{
	public function run(){
		$this->controller->bodyCss = 'whitecolor';
		$this->controller->render('companylist');
	}
}