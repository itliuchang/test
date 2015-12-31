<?php
class ProductlistAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="Select Product";
		$this->controller->render('productlist');
	}
}