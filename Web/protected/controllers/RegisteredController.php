<?php
class RegisteredController extends Controller{
	public function filters(){
        return array(
            'wechat'
        );
    }
	public function actions(){
		return array(
				'index' => 'application.controllers.registered.IndexAction',
				'basicinfo' => 'application.controllers.registered.BasicInfoAction',
				'productlist' => 'application.controllers.registered.ProductlistAction',
				'chooseenvironment' => 'application.controllers.registered.ChooseEnvironmentAction',
				'access' => 'application.controllers.registered.AccessAction',
				'private' => 'application.controllers.registered.PrivateAction',
				'companyproductlist' => 'application.controllers.registered.companyProductlistAction',
				'codeaccess' => 'application.controllers.registered.CodeAccessAction',
				'companyaccess' => 'application.controllers.registered.CompanyAccessAction',
				'code' => 'application.controllers.registered.CodeAction',
			);
	}
}