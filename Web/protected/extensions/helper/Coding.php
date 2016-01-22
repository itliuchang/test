<?php 
 class Coding{
 	public static function makeCode($data){
		$code = rand(10000000,99999999);
		if(self::checkCode($code)){
			$a[] = $code;
			$proxy = new Code;
			$proxy->code = $code;
			$proxy->userId = $data['userId'];
			$proxy->type = $data['type'];
			$proxy->startDate = $data['startDate'];
			$proxy->endDate = $data['endDate'];
			$proxy->createTime = date('Y-m-d H:i:s');
			$proxy->times = $data['times'];
			$proxy->ordercompanyproductId = $data['ordercompanyProductId'];
			$proxy->save();
		} else {
			return false;
		}
 		return $a;
 	}

 	public static function checkCode($code){
 		$result = Code::model()->findByAttributes(array('code'=>$code));
 		if($result){
 			$code = rand(10000000,99999999);
 			self::checkCode($code);
 			return self::checkCode($code);
 		} else {
 			return true;
 		}
 	}

 	public static function isValidCode($code){
 		$result = Yii::app()->db->createCommand('select * from code where status!=0 and times!=0 and endDate>curdate() and code='."'".$code."'")->queryRow();
 		if($result){
 			return array(
 					'code'=>200,
 					'mes'=>'success',
 					'data'=> array('code'=>$code)
 				);
 		}else{
 			return array(
 					'code'=>500,
 					'mes' => 'fail'
 				);
 		}
 	}

 	//判断改激活码是否被自己用过
 	public static function hasUsedCode($code){
 		$result = Yii::app()->db->createCommand('select * from code_used a left join code b on a.codeId = b.id where b.code ='."'".$code."'".' and a.userId='.Yii::app()->user->id)->queryRow();
 		if($result){
 			//使用过
 			return true;
 		}else{
 			return false;
 		}
 	}
 }