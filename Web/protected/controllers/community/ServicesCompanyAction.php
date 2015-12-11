<?php
class ServicesCompanyAction extends CAction{
	public function run(){
		$this->controller->bodyCss = 'whitecolor';
		$this->controller->render('servicescompany');
	}
}