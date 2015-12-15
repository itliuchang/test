<?php
class ListAction extends CAction{
    public function run(){
    	$start = Yii::app()->request->getParam('start');

        $proxy = new BConference();
        $result = $proxy->getRoomList($start,10);
        $count = $result['count'];
    	if(Yii::app()->request->isAjaxRequest){
    		$data = array(
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $result['data'],
            );
            echo CJSON::encode($data);
    	} else {
    		$this->controller->render('list');
    	}
        
    }
}