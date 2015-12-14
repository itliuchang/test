<?php
class BindAction extends CAction{

	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			try {
				$wechat = Yii::app()->session['wechat'];
				
				$account = new Account();
				$account->id = $wechat['id'];
				$account->userId = Yii::app()->user->id;
				
				$account->save();
				echo CJSON::encode(array('code'=>200, 'message'=> '绑定成功'));
			} catch (CException $e){
    			Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
    			echo CJSON::encode(array('code'=>500, 'message'=> '绑定失败'));
    		}
		}
	}

}