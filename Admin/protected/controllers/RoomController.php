<?php
class RoomController extends Controller{
    public function filters(){
        return array(
           'accessControl',
        );
    }
    
    public function accessRules(){
        return array(
           array('allow',
              'actions' => array('list', 'create', 'edit', 'submit', 'down', 'up',
              		'delete'),
              'users' => array('@'),
           ),
           array('deny',
              'users'=>array('*'),
           ),
        );
    }

    public function actions(){
        return array(
          'list' => 'application.controllers.room.ListAction',
          'create' => 'application.controllers.room.CreateAction',
        	'edit' => 'application.controllers.room.EditAction',
        	'delete' => 'application.controllers.room.DeleteAction',
        );
    }
}