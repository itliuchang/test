<?php
class ListAction extends CAction{
	public function run(){
	    $this->controller->bodyCss='messagelist';
		$this->controller->render('list');
	}
}