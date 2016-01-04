<?php
class LikedAction extends CAction{
	public function run($id){
		if(Yii::app()->request->isAjaxRequest){
			$user = new CUser;
			$result = $user->liked($id);
			if($result['code']==200){
				echo CJOSN::encode($result);
			}
		}
		
	}
}