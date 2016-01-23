<?php
class MoreController extends Controller{
	 public function filters(){
        return array(
            'wechat','accessControl','main'
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
	public function actionIndex(){
		$this->pageTitle="More";
		$user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
		$this->render('index',array('user'=>$user));
	}
}