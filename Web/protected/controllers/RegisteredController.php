<?php
class RegisteredController extends Controller{
	public function init(){
		parent::init();
		Yii::app()->request->enableCsrfValidation = false;
	}
	public function actions(){
		return array(
				'index' => 'application.controllers.registered.IndexAction',
				'basicinfo' => 'application.controllers.registered.BasicInfoAction',
				'productlist' => 'application.controllers.registered.ProductlistAction',
				'chooseenvironment' => 'application.controllers.registered.ChooseEnvironmentAction',
			);
	}
}