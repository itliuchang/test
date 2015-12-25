<?php
class OrderController extends Controller{
    public function filters(){
        return array(
           'accessControl',
        );
    }
    
    public function accessRules(){
        return array(
           array('allow',
              	'actions' => array('list', 'view', 'delete'),
               	'users' => array('@'),
           ),
           array('deny',
              'users'=>array('*'),
           ),
        );
    }

    public function actions(){
        return array(            
          'list' => 'application.controllers.order.ListAction',
          'view' => 'application.controllers.order.ViewAction',
        	'delete' => 'application.controllers.order.DeleteAction',
        );
    }
}