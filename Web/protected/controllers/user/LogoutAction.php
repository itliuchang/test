<?php
class LogoutAction extends CAction{
	
	public function run(){
		if(!Yii::app()->user->isGuest){
			$wechat = Account::model()->findByAttributes(array('account'=>Yii::app()->session['wechat']['unionid'],'status'=>1));
			if(Yii::app()->session['wechat']&&!empty($wechat)){
				$wechat->status=0;
				$wechat->save();
			}
			Yii::app()->session['wechat']=null;
			Yii::log(empty(Yii::app()->session['wechat']), CLogger::LEVEL_ERROR,'sessionwechat');
			$_identity = new UserIdentity();
			$_identity->logout();
			$this->controller->redirect('/registered/');
		}
	}

}