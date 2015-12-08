<?php
class ListAction extends CAction{
    public function run(){
        $start = Yii::app()->request->getParam('start');

        $proxy = new Product();
        $result = $proxy->getProductList($start,10);
        $count = $result[0];
    	if(Yii::app()->request->isAjaxRequest){
            $data = array(
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $result[1],
            );
            echo CJSON::encode($data);
        } else {
            $this->controller->render('list',array(
            	'count'=>$count
            ));
        }
    }
}