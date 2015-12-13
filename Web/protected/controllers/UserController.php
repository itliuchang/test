<?php
class UserController extends Controller{
	public function actions(){
		return array(
			'login' => 'application.controllers.user.LoginAction',
			'logout' => 'application.controllers.user.LogoutAction',
			'sendsms' => 'application.controllers.user.SendSMSAction',
            'hello' => 'application.controllers.user.HelloAction',
            'updateprofile' => 'application.controllers.user.UpdateProfileAction',
            'profile' => 'application.controllers.user.ProfileAction',
            'account' => 'application.controllers.user.AccountAction',
            'changepassword' => 'application.controllers.user.ChangePasswordAction'
		);
	}
}