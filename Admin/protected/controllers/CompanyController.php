<?php
class CompanyController extends Controller{
    public function filters(){
        return array(
           'accessControl',
        );
    }
    
    public function accessRules(){
        return array(
           array('allow',
              'actions' => array('list', 'create', 'edit','editinfo','delete','view'),
              'users' => array('@'),
           ),
           array('deny',
              'users'=>array('*'),
           ),
        );
    }

    public function actions(){
        return array(
          'list' => 'application.controllers.company.ListAction',
          'create' => 'application.controllers.company.CreateAction',
          'edit' => 'application.controllers.company.EditAction',
        	'editinfo' => 'application.controllers.company.EditInfoAction',
          'delete' => 'application.controllers.company.DeleteAction',
        	'view' => 'application.controllers.company.ViewAction',
        );
    }
}