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
              'actions' => array('list', 'create', 'edit','delete', 'editproduct'),
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
        	'delete' => 'application.controllers.route.DeleteAction',
        	'editproduct' => 'application.controllers.route.EditProductAction',
        );
    }
}