<?php
class LogoutAction extends CAction{
	
	public function run(){
		if(!Yii::app()->user->isGuest){
			if(Yii::app()->session['wechat']){
				$wechat = Account::model()->findByAttributes(array('account'=>Yii::app()->session['wechat']['unionid'],'status'=>1));
				$wechat->status=0;
				$wechat->save();
				Yii::app()->session['wechat']=null;
			}
			$_identity = new UserIdentity();
			$_identity->logout();
			$this->controller->redirect('/registered/');
		}
	}

}