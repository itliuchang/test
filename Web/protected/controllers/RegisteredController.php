<?php
class RegisteredController extends Controller{
	public function actions(){
		return array(
				'index' => 'application.controllers.registered.IndexAction',
				'basicinfo' => 'application.controllers.registered.BasicInfoAction',
				'productlist' => 'application.controllers.registered.ProductlistAction',
			);
	}
}