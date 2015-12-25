<?php
class ShowAction extends CAction{
	public function run($fid, $start = 0, $size = 15){
		$this->controller->bodyCss='messageshow';
        //检查是否已互为好友并将消息全部置为已读
        EasemobHelper::addAFriend($fid);
        EasemobHelper::readAll($fid);

        //在页面上倒序添加到dom中即使得聊天记录按时间顺序正确显示
        $data = EasemobHelper::getAllMessage($fid, $start, $size);
        if(Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array('code' => 200, 'data' => $data));
        }else{
            $this->controller->render('show', $data);
        }
	}
}