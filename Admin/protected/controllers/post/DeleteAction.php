<?php
class DeleteAction extends CAction{
    public function run(){
        $id = Yii::app()->request->getParam('id');

        $proxy = new BCommunity();
        $result = $proxy->deletePost($id);
		echo CJSON::encode($result);        	
    }
}