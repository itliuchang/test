<?php
class MemberListAction extends CAction{
	public function run(){
		$memeber = new CCommunity;
		$result = $memeber->getMemberList();
		if($result['code']==200){
			$this->controller->bodyCss = 'whitecolor';
			$this->controller->render('memberlist',array('list'=>$result['data']));
		}
	}
}