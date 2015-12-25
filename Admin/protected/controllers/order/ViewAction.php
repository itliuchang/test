<?php
class ViewAction extends CAction{
    public function run(){
    	$id = Yii::app()->request->getParam('id');
    	
    	$proxy = new BOrder();
    	$result = $proxy->getOrderInfo($id);
    	if($result['code']==200) {
        	$this->controller->renderPartial('view', array(
        		'id' => $id,
    			'data' => $result['data']
    		));
        } else{
        	throw new CHttpException($result['code'], $result['message']);
        }
    }
}