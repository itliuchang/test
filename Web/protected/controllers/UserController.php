<?php
class UserController extends Controller{
	public function filters(){
        return array(
            'wechat','accessControl','main - login,logout,regist,bind,edit,updateprofile,coderegist,companyregist,codeauth'
        );
    }

    public function accessRules(){
        return array(
        	array('allow',
                'actions' => array('login','logout','regist','bind','edit','updateprofile','coderegist','companyregist','codeauth'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('sendsms','profile','account','changepassword','like','liked','sendcomment'),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
	public function actions(){
		return array(
			'login' => 'application.controllers.user.LoginAction',
			'logout' => 'application.controllers.user.LogoutAction',
			'sendsms' => 'application.controllers.user.SendSMSAction',
			'regist' => 'application.controllers.user.RegistAction',
			'bind' => 'application.controllers.user.BindAction',
            'profile' => 'application.controllers.user.ProfileAction',
			'edit' => 'application.controllers.user.EditAction',
            'account' => 'application.controllers.user.AccountAction',
			'updateprofile' => 'application.controllers.user.UpdateProfileAction',
            'changepassword' => 'application.controllers.user.ChangePasswordAction',
            'like' => 'application.controllers.user.LikeAction',
            'liked' => 'application.controllers.user.LikedAction',
            'sendcomment' => 'application.controllers.user.SendCommentAction',
            'coderegist' => 'application.controllers.user.CodeRegistAction',
            'companyregist' => 'application.controllers.user.CompanyRegistAction',
            'codeauth' => 'application.controllers.user.CodeAuthAction'
		);
	}
}