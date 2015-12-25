<?php
class ListAction extends CAction{
    public function run(){
        $start = Yii::app()->request->getParam('start');
        $type = Yii::app()->request->getParam('type');

        $proxy = new BReservation();
        $result = $proxy->getReservationList($start,10,$type);
        $count = $result['count'];
        
    	if(Yii::app()->request->isAjaxRequest){
            $data = array(
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $result['data'],
            );
            echo CJSON::encode($data);
        } else {
            $this->controller->render('list',array(
            	'count'=>$count
            ));
        }
    }
}