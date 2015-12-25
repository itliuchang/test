<?php
class UserController extends Controller{
	
	public function filters(){
		return array(
				'accessControl',
		);
	}
	
	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array(
						'login', 'logout'
				),
				'users'=>array('*'),
			),
			array('allow',
				'actions' => array('list', 'upgrade', 'admin','create','edit','editinfo','editadmin','view','delete'),
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}
	
    public function actions(){
        return array(
            'login' => 'application.controllers.user.LoginAction',
            'logout' => 'application.controllers.user.LogoutAction',
        	'list' => 'application.controllers.user.ListAction',
        	'create' => 'application.controllers.user.CreateAction',
        	'edit' => 'application.controllers.user.EditAction',
        	'view' => 'application.controllers.user.ViewAction',
        	'delete' => 'application.controllers.user.DeleteAction',
        	'editinfo' => 'application.controllers.user.EditinfoAction'
        );
    }
}