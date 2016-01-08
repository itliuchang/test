<?php
class ProductlistAction extends CAction{
	public function run(){
		$this->controller->pageTitle='Payment';
		$this->controller->render('productlist');
	}
}