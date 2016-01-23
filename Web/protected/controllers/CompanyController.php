<?php
class CompanyController extends Controller{
	public function filters(){
        return array(
            'wechat','accessControl','main - updateprofile'
        );
    }

    public function accessRules(){
        return array(
        	array('allow',
                'actions' => array('updateprofile'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('profile'),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
	public function actions(){
		return array(
			'profile' => 'application.controllers.company.ProfileAction',
			'updateprofile' => 'application.controllers.company.UpdateProfileAction',
		);
	}
}