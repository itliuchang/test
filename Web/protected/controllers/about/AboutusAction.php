<?php 
class AboutusAction extends CAction{
	public function run(){
		$this->controller->pageTitle = 'About';
		$this->controller->render('aboutus');
	}
}