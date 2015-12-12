<?php
class IndexAction extends CAction{
	public function run(){
	    $this->controller->bodyCss='messagelist';
		$this->controller->render('index');
	}
}