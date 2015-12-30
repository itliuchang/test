<?php
class ServicesListAction extends CAction{
	public function run(){
		$servicelist = new CCommunity;
		$result = $servicelist->getServiceList();
		print_r($result);die;
		if($result['code']==200){
			$this->controller->render('servicelist',array('list'=>$result['data']));
		}
	}
}