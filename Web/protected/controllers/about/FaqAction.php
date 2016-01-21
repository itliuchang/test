<?php 
class FaqAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="Guide";
		$this->controller->render('faq');
	}
}