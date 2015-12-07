<?php
class UserController extends Controller{
	public function actions(){
		return array(
			'login' => 'application.controllers.user.LoginAction',
            'hello' => 'application.controllers.user.HelloAction',
            'updateprofile' => 'application.controllers.user.UpdateProfileAction',
            'profile' => 'application.controllers.user.ProfileAction',
		);
	}
}