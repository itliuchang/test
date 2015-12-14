<?php
class CreateAction extends CAction{
    public function run(){
    	$start = Yii::app()->request->getParam('start');
    	
        $dp = new BHub();
		$dc = Service::model()->findAll('status!=0');

		$hub = $dp->getHubList($start,10);

        $this->controller->render('edit',array(
					'hub'=>$hub['data'],
					'service'=>$dc
				));
    }
}