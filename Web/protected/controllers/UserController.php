<?php
class UserController extends Controller{
	public function actions(){
		return array(
			'login' => 'application.controllers.user.LoginAction',
			'logout' => 'application.controllers.user.LogoutAction',
			'sendsms' => 'application.controllers.user.SendSMSAction',
			'regist' => 'application.controllers.user.RegistAction',
			'bind' => 'application.controllers.user.BindAction',
			'wechatconnect' => 'application.controllers.user.WechatConnectAction',
            'wechatconnectcallback' => 'application.controllers.user.WechatConnectCallbackAction',
            'profile' => 'application.controllers.user.ProfileAction',
			'edit' => 'application.controllers.user.EditAction',
            'account' => 'application.controllers.user.AccountAction',
			'updateprofile' => 'application.controllers.user.UpdateProfileAction',
            'changepassword' => 'application.controllers.user.ChangePasswordAction'
		);
	}
}