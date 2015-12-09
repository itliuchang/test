<?php
/**
*Reservation represents an application module.
*/
class Reservation{

	/**
	 * This is method for get all reservations list
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			{'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...},
	 *         			{'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...}
	 *         		}
	 * }
	 */
	public function getReservationList($start,$size,$type){
		$start = 0+$start;
 		$criteria = new CDbCriteria;
 		if($type!=''){
        	$criteria->addCondition('type='.$type);
    	}
        $criteria->limit=$size;
        $criteria->offset=$start;
        $criteria->order='t.id DESC';
        $result = Reservations::model()->with('user')->with('hub')->with('room')->findAll($criteria);
 		if($result){
 			$data=array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>$count = Reservations::model()->count(),
 				'data'=>$result
 			);
 		}
 		return $data;
	}

	public function createReservation($data){
		$result = new Reservations;
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

	/**
	 * This is method for get reservations information
	 * @param  string $id 
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...
	 *         		}
	 * }
	 */
	public function getReservationInfo($id){
		$result = Reservations::model()->findByAttributes(array('id'=>$id));
		if($result){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS',
				'data'=>$result
			);
		}
 		return $data;
	}

	public function updateReservation($data,$id){
		$result = Reservations::model()->findByAttributes(array('id'=>$id));
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

	public function confirmReservation($id){
		$result = Reservations::model()->findByAttributes(array('id'=>$id));
 		$result->status='2';
 		if($result->save()){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS'
 			);
 		}
 		return $data;
	}

	/**
	 * This is method for delete reservation from list
	 * @param  string $id 
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function cancelReservation($id){
		$result = Reservations::model()->findByAttributes(array('id'=>$id));
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
