<?php
class IndexAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest){
			$this->controller->bodyCss='access';
			if(!Yii::app()->session['wechat']) {
				$this->redirect('/wechat/wechatconnect');
			}
		}else{
			$this->controller->redirect(Assist::getDefaultURL());
		}
		
	}
}