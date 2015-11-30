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
				'actions' => array('list', 'upgrade', 'profile', 'edit'),
				'roles' => array('admin'),
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
        	'profile' => 'application.controllers.user.ProfileAction',
        	'edit' => 'application.controllers.user.EditAction',
        	'upgrade' => 'application.controllers.user.UpgradeAction',
        );
    }
}