<?php
class ShowAction extends CAction{
	public function run($fid, $start = 0, $size = 5){
		$this->controller->bodyCss='messageshow';
        //检查是否已互为好友并将消息全部置为已读
        EasemobHelper::addAFriend($fid);
        EasemobHelper::readAll($fid);

        //在页面上倒序添加到dom中即使得聊天记录按时间顺序正确显示
        $data = EasemobHelper::getAllMessage($fid, $start, $size);
        if(Yii::app()->request->isAjaxRequest){
            // $list = array_map(function($record){return $record->attributes;}, $data['data']);
            // $list = (array)$data['data'];
            // $list = json_decode(CJSON::encode($data['data']), true);
            // $user = $data['user']->attributes;
            echo CJSON::encode(array('code' => 200, 'data' => array(
                'list' => array_reverse($data['data']), 'user' => $data['user']
            )));
        }else{
            $friend = User::model()->findByPk($fid);
            $friendDetail = Yii::app()->db->createCommand('select b.name as companyName,a.title,c.name as locationName from user a left join company b on a.company=b.id left join hub c on c.id=a.location where a.status!=0 and a.id='.$fid)->queryRow();
            $data['friendCompany']=$friendDetail['companyName'];
            $data['friendTitle'] = $friendDetail['title'];
            $data['friendLocation'] = $friendDetail['locationName'];
            $data['friendId'] = $fid;
            $data['fportrait'] = $friend? $friend->portrait : '';
            $this->controller->render('show', $data);
        }
	}
}