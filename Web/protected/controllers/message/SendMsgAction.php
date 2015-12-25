<?php
class SendMsgAction extends CAction{
    public function run($fid){
        if(Yii::app()->request->isAjaxRequest){
            EasemobHelper::addMessage(Yii::app()->user->id, $fid, Yii::app()->request->getParam('content'));
            echo CJSON::encode(array('code' => 200, 'data' => true));
        }else{
            throw new CHttpException('403', '请求格式错误！');
        }
    }
}