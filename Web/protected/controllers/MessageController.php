<?php
class MessageController extends Controller{
    // public function filters(){
    //     return array(
    //         'accessControl',
    //     );
    // }

    // public function accessRules(){
    //     return array(
    //         array('allow',
    //             'actions' => array('index'),
    //             'users' => array('@'),
    //         ),
    //         array('deny',
    //            'users' => array('*'),
    //         ),
    //     );
    // }
    
	public function actions(){
		return array(
				'index' => 'application.controllers.message.IndexAction',
				'show' => 'application.controllers.message.ShowAction'
			);
	}
}