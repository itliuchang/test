<?php


class BConference{
	
	public function getRoomList($start,$size){
		$start = 0+$start;
 		$count = Room::model()->count('status!=0');
 		$criteria = new CDbCriteria;
        $criteria->addCondition('status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $result = Room::model()->findAll($criteria);
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