<?php
class LikeAction extends CAction{
	public function run($id){
		$userId = Yii::app()->user->id;
		if(Yii::app()->request->isAjaxRequest){
			$user = new CUser;
			$result = $user->like($userId,$id);
			echo CJSON::encode($result);
		}
	}
}