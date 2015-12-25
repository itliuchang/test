<?php
class EditProductAction extends CAction{
    public function run(){
        $name = Yii::app()->request->getParam('name');
        $price = Yii::app()->request->getParam('price');
        $times = Yii::app()->request->getParam('times');
        $number = Yii::app()->request->getParam('number');

    	$data = array(
    		'name' => $name,
    		'price' => $price,
    		'times' => $times,
    		'number' => $number
       	);

       	$proxy = new BProduct();
       	$result = $proxy->createProduct($data);
       	if($result['code']==200){
       		$this->controller->redirect('/route/list');
       	} else {
       		throw new CHttpException($result['code'],$result['message']);
       	}
    }
}