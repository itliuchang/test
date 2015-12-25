<?php
class AddFriendAction extends CAction{
    public function run($fid){
        if(Yii::app()->request->isAjaxRequest){
            EasemobHelper::getInstance()->addFriend(Yii::app()->user->id, $fid);
            echo CJSON::encode(array(
                'code' => 200,
                'data' => true
            ));
        }else{
            throw new CHttpException('403', '请求格式错误！');
        }
    }
}