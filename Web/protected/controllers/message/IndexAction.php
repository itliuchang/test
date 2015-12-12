<?php
class IndexAction extends CAction{
	public function run(){
        print_r(EasemobHelper::getInstance()->getUsers());die;
	    $this->controller->bodyCss='messagelist';
		$this->controller->render('index');
	}
}