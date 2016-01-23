<?php
class CodeController extends Controller{
	public function filters(){
        return array(
            'wechat'
        );
    }
	public function actionCheck(){
		if(Yii::app()->request->isAjaxRequest){
			$code = Yii::app()->request->getParam('code');
			$result = Coding::isValidCode($code);
			echo CJSON::encode($result);
		}
	}
}