<?php
class UEditorController extends Controller{
    public function filters(){
        return array(
           'accessControl',
        );
    }
    
    public function accessRules(){
        return array(
           array('allow',
              'actions' => array('index'),
              'users' => array('@'),
           ),
           array('deny',
              'users'=>array('*'),
           ),
        );
    }

    public function actionIndex() {
    	$action = Yii::app()->request->getParam('action');
    	$size = Yii::app()->request->getParam('size');
    	$start = Yii::app()->request->getParam('start');
    	$callback = Yii::app()->request->getParam('callback');
    	
    	$ueditor = new UEditor($action, $size, $start, $callback);
    	echo $ueditor->executeUEditor();
    }
    
}