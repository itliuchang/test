<?php
class DeleteAction extends CAction{
    public function run(){
        $id = Yii::app()->request->getParam('id');

        $proxy = new BCompany();
        $result = $proxy->deleteCompany($id);
        echo CJSON::encode($result);
    }
}