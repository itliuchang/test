<?php
class EditAction extends CAction{
    public function run(){
        $id = Yii::app()->request->getParam('id');
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
        if(Yii::app()->request->isAjaxRequest){
        	$result = $proxy->updateProduct($data,$id);
        	echo CJSON::encode($result);
        } else {
        	$result = $proxy->getProductInfo($id);
        	if($result['code']==200){
        		$this->controller->render('editproduct',array(
        			'data'=>$result['data']
        		));
        	} else {
        		throw new CHttpException($result['code'],$result['message']);
        		
        	}
        }
    }
}