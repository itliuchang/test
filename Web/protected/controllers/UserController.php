<?php
class UserController extends Controller{
	// public function filters() {
	// 	return array(
	// 		 'accessRules'
	// 	);
	// }
	// public function accessRules(){
 //        return array(
 //            array('allow',
 //                'actions'=>array(
 //                    'wechatconnect', 'wechatconnectcallback',
 //                ),
 //                'users'=>array('*'),
 //            ),
 //            array('allow',
 //                'actions' => array('login','logout','sendsms','regist','bind','profile','edit','account','updateprofile','changepassword'),
 //                'users' => array('@'),
 //            ),
 //            array('deny',
 //               'users' => array('*'),
 //            ),
 //        );
 //    }
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
            'sendcomment' => 'application.controllers.user.SendCommentAction'
		);
	}
}