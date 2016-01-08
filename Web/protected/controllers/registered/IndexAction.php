<?php
class IndexAction extends CAction{
	public function run(){
		$this->controller->pageTitle='naked HUB';
		if(Yii::app()->user->isGuest){

			$this->controller->bodyCss='access';
			if(!Yii::app()->session['wechat']) {
				$this->controller->redirect('/wechat/wechatconnect');
			}
		}else{
			$this->controller->redirect(Assist::getAccessURL());
		}
		
	}
}