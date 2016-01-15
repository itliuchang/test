<?php
class CodeAccessAction extends CAction{
	public function run($code){
		if(Yii::app()->user->isGuest){
			if(Coding::isValidCode($code)['code']==200){
				$this->controller->render('codebasicInfo',array('code'=>$code));
			}else{
				throw new Exception("code is wrong", 1);
			}
		}else{

		}
	}
}