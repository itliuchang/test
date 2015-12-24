<?php
class HasNewAction extends CAction{
    public function run(){
        if(Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array(
                'code' => 200,
                'data' => EasemobHelper::hasNewMessage()
            ));
        }else{
            throw new CHttpException('403', '请求格式错误！');
        }
    }
}