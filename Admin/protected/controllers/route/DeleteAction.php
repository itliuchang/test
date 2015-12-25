<?php
class DeleteAction extends CAction{
    public function run(){
    	$id = Yii::app()->request->getParam('id');
        
    	if(Yii::app()->request->isAjaxRequest){
    		$proxy  = new BProduct();
    		$result = $proxy->deleteProduct($id);
    		echo CJSON::encode($result);
    	}
    }
}