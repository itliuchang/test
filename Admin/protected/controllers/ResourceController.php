<?php
class ResourceController extends Controller{
    public function filters(){
        return array(
           'accessControl',
        );
    }
    
    public function accessRules(){
        return array(
           array('allow',
              'actions' => array('get','token'),
              'users' => array('@'),
           ),
           array('allow',
              'actions'=> array('token'),
              'users'=> array('?'),
            ),
           array('deny',
              'users'=>array('*'),
           ),
        );
    }

    public function actions(){
        return array(            
            'get' => 'application.controllers.resource.GetAction',
        	'token' => 'application.controllers.resource.GenerateTokenAction',
        );
    }
}