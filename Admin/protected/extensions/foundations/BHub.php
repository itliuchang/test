<?php 

class BHub {

	public function getHubList($start,$size){
		$start = 0+$start;
 		$count = Hubs::model()->count('status!=0');
 		$criteria = new CDbCriteria;
        $criteria->addCondition('status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $result = Hubs::model()->findAll($criteria);
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>$count,
 				'data'=>$result
 			);
 		}
 		return $data;
	}
}