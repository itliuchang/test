<?php
class RouteController extends Controller{
    public function filters(){
        return array(
           'accessControl',
        );
    }
    
    public function accessRules(){
        return array(
           array('allow',
              'actions' => array('list', 'create', 'edit', 'submit', 'down', 'up',
              		'delete', 'editproduct', 'editbase', 'editday', 'deleteday',
              		'createpoi', 'editpoi', 'deletepoi'),
              'users' => array('@'),
           ),
           array('deny',
              'users'=>array('*'),
           ),
        );
    }

    public function actions(){
        return array(
          'list' => 'application.controllers.route.ListAction',
          'create' => 'application.controllers.route.CreateAction',
        	'edit' => 'application.controllers.route.EditAction',
        	'down' => 'application.controllers.route.DownAction',
        	'up' => 'application.controllers.route.UpAction',
        	'delete' => 'application.controllers.route.DeleteAction',
        	'editProduct' => 'application.controllers.route.EditProductAction',
        );
    }
}