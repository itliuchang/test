<?php 
 class Coding{
 	public static function makeCode($num,$userId,$type,$startDate,$endDate){
 		for($i = 0; $i < $num; $i++){
 			$code = rand(10000000,99999999);
 			if(self::checkCode($code)){
 				$a[] = $code;
	 			$proxy = new Code;
	 			$proxy->code = $code;
	 			$proxy->userId = $userId;
	 			$proxy->type = $type;
	 			$proxy->startDate = $startDate;
	 			$proxy->endDate = $endDate;
	 			$proxy->createTime = date('Y-m-d H:i:s');
	 			$proxy->save();
 			} else {
 				return false;
 			}
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
 }