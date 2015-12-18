<?php 
class CreateAction extends CAction{
	public function run(){
		$proxy = new BAuth();
		$result = $proxy->getUserInfo($id);
		$type = $proxy->getUserType();
		$dp = new Companys;
		$dh = new Hubs;
		$company = $dp->getCompany();
		$hub = $dh->getHub();
		$this->controller->render('edit',array(
			'type'=>$type,
			'company'=>$company,
			'hub'=>$hub
		));
	}
}