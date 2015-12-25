<?php
class AdminController extends Controller{
	
	public function filters(){
		return array(
				'accessControl',
		);
	}
	
	public function accessRules(){
		return array(
			array('allow',
				'actions' => array('list', 'edit','editadmin','create','delete'),
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}
	
    public function actions(){
        return array(
        	'list' => 'application.controllers.admin.ListAction',
        	'edit' => 'application.controllers.admin.EditAction',
        	'editadmin' => 'application.controllers.admin.EditAdminAction',
        	'create'=>'application.controllers.admin.CreateAction',
        	'delete'=>'application.controllers.admin.DeleteAction'
        );
    }
}