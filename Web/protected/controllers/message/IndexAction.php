<?php
class IndexAction extends CAction{
	public function run(){
	    $this->controller->bodyCss='messagelist';
        //检查user->isBindIM如未绑定环信则注册环信并绑定
		$this->controller->render('index');
	}
}