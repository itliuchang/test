<?php
class ServicesListAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="Community";
		$servicelist = new CCommunity;
		$result = $servicelist->getServiceList();
		if($result['code']==200){
			$this->controller->render('servicelist',array('list'=>$result['data']));
		}
	}
}