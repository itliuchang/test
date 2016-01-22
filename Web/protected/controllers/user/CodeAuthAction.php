<?php
class CodeAuthAction extends CAction{
	public function run($code){
		if(Yii::app()->request->isAjaxRequest){
			$user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
			$result = Coding::isValidCode($code);
			if($result['code']==200&&$user->status>=3){
				$code = Code::model()->findByAttributes(array('code'=>$code));
				$code ->times--;
				$code -> save();
				$codeused = new CodeUsed;
				$codeused ->codeId = $code->id;
				$codeused ->userId = Yii::app()->user->id;
				$codeused ->createTime = date('YmdHis');
				$codeused ->save();
				$user->status=4;
				$user->save();
				$ccode = new CCode;
				$result = $ccode->getproduct($code->code);
				echo CJSON::encode(array('code'=>200,'mes'=>'success','data'=>$result['data']));
			}else{
				echo CJSON::encode(array('code'=>500,'mes'=>'fail'));
			}
		}
	}
}
