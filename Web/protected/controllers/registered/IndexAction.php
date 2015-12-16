<?php
class IndexAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest){
			$this->controller->bodyCss='access';
			$this->controller->render('index');
		}else{
			$this->controller->redirect(Assist::getDefaultURL());
		}
		
	}
}