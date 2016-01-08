<?php
class ServicesCompanyAction extends CAction{
	public function run($id){
		$community = new CCommunity;
		$result = $community->getCompanyListByService($id);
		$title=Service::model()->findByAttributes(array('id'=>$id))->name;
		$this->controller->pageTitle=$title;
		if($result['code']==200){
			$this->controller->bodyCss = 'whitecolor';
			$this->controller->render('servicescompany',array('list'=>$result['data']));
		}

	}
}