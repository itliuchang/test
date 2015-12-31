<?php
class IndexAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest){
			$this->controller->bodyCss='access';
			if(!empty(Yii::app()->session['user'])){
				$this->controller->redirect('/registered/productlist');
			}else{
				$this->controller->redirect('/wechat/wechatconnect');
			}
		}else{
			$this->controller->redirect(Assist::getAccessURL());
		}
		// $this->controller->render('index');
		
	}
}