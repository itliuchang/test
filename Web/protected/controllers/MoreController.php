<?php
class MoreController extends Controller{
	public function actionIndex(){
		$this->pageTitle="More";
		$user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
		$this->render('index',array('user'=>$user));
	}
}