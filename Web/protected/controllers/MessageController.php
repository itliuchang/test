<?php
class MessageController extends Controller{
    public function filters(){
        return array(
            'accessControl',
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions' => array('index', 'show', 'hasnew', 'addfriend'),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
    
	public function actions(){
		return array(
            //消息列表
			'index' => 'application.controllers.message.IndexAction',
            //聊天界面
			'show' => 'application.controllers.message.ShowAction',
            //检查是否有新消息
            'hasnew' => 'application.controllers.message.HasNewAction',
            //点击头像时自动添加对方为好友
            'addfriend' => 'application.controllers.message.AddFriendAction',
		);
	}
}