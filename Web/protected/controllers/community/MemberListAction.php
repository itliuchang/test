<?php
class MemberListAction extends CAction{
	public function run(){
		$this->controller->bodyCss = 'whitecolor';
		$this->controller->render('memberlist');
	}
}