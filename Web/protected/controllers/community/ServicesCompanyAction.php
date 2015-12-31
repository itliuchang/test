<?php
class ServicesCompanyAction extends CAction{
	public function run($id){
		$community = new CCommunity;
		$result = $community->getCompanyListByService($id);
		if($result['code']==200){
			$this->controller->bodyCss = 'whitecolor';
			$this->controller->render('servicescompany',array('list'=>$result['data']));
		}

	}
}