<?php
class CompanyListAction extends CAction{
	public function run(){
		$companylist = new CCommunity;
		$result = $companylist->getCompanyList();
		if($result['code']==200){
			$this->controller->bodyCss = 'whitecolor';
			$this->controller->render('companylist',array('list'=>$result['data']));
		}
		
	}
}