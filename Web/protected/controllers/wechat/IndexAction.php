<?php
class IndexAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest){
			$this->controller->bodyCss='access';
			if(Yii::app()->session['wechat']){
				$this->controller->render('index');
			}else{
				$this->controller->redirect('/wechat/wechatconnect');
			}
		}else{
			$this->controller->redirect(Assist::getAccessURL());
		}
		// $this->controller->render('index');
		
	}
}