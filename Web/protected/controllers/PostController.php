<?php
class PostController extends Controller{

	public function filters(){
        return array(
            'accessControl',
        );
    }

    public function accessRules(){
        return array(
            // array('allow',
            //     'actions'=>array(
            //         'wechatquietconnect', 'wechatquietconnectcallback',
            //     ),
            //     'users'=>array('?'),
            // ),
            array('allow',
                'actions'=>array(
                    'postshow','newpost'
                ),
                'users'=>array('*'),
            ),
            array('allow',
                'actions' => array('newlist',),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
	public function actions(){
		return array(
			'newlist' => 'application.controllers.post.NewListAction',
			'postshow' => 'application.controllers.post.PostShowAction',
			'newpost' => 'application.controllers.post.NewPostAction'
			);
	}
}