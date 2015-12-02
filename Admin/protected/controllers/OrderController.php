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
              	'actions' => array('list', 'create', 'edit', 'view', 'cancel'),
               	'users' => array('@'),
           ),
           array('allow',
           		'actions' => array('refund', 'refunded','refuse'),
           		'roles' => array('admin'),
           ),
           array('deny',
              'users'=>array('*'),
           ),
        );
    }

    public function actions(){
        return array(            
          'list' => 'application.controllers.order.ListAction',
        	'create' => 'application.controllers.order.CreateAction',
        	'edit' => 'application.controllers.order.EditAction',
        	'view' => 'application.controllers.order.ViewAction',
        	'cancel' => 'application.controllers.order.CancelAction',
          'refuse' => 'application.controllers.order.RefuseAction',
        );
    }
}