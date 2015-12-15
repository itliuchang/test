<?php


class BConference{
	
	public function getRoomList($start,$size){
		$start = 0+$start;
 		$count = Room::model()->count('status!=0');
 		$criteria = new CDbCriteria;
        $criteria->addCondition('t.status=1');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $result = Room::model()->with('hub')->findAll($criteria);
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>$count,
 				'data'=>$result
 			);
 		} else {
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>$count,
 				'data'=>''
 			);
 		}
 		return $data;
	}

	public function createRoom($data){
		$result = new Room;
		$result->createTime=date('Y-m-d H:i:s',time());
		foreach($data as $k=> $v){
			$result->$k=$v;
		}
		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}

	public function updateRoom($data,$id){
		$result = Room::model()->findByAttributes(array('id'=>$id));
		$result->updateTime=date('Y-m-d H:i:s',time());
		foreach($data as $k=> $v){
			$result->$k=$v;
		}
		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}

	public function getRoomInfo($id){
		$result = Room::model()->findByAttributes(array('id'=>$id));
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'data'=>$result
 			);
 		}
 		return $data;
	}

	public function deleteRoom($id){
		$result = Room::model()->findByAttributes(array('id'=>$id));
 		$result->status='0';
 		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}
}