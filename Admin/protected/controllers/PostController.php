<?php
class PostController extends Controller{
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
          'list' => 'application.controllers.post.ListAction',
          'create' => 'application.controllers.post.CreateAction',
        	'edit' => 'application.controllers.post.EditAction',
        	'down' => 'application.controllers.post.DownAction',
        	'up' => 'application.controllers.post.UpAction',
        	'delete' => 'application.controllers.post.DeleteAction',
        );
    }
}