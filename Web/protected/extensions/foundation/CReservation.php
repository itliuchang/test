<?php
class CReservation{
	public function getupcomingRes($userId,$page=1,$size=10){
		$data = Yii::app()->db->createCommand()->select('a.id,a.type,a.startTime,a.endTime,a.type,c.name roomname,b.name hubname')->from('reservation a')->leftJoin('hub b','a.hubId=b.id')->leftJoin('conferenceRoom c','a.conferenceroomId=c.id')->where('a.status!=0 and a.startTime>'.date('Ymdhms'))->order('startTime desc')->queryAll();
		return array(
				'code'=>200,
				'mes'=>'',
				'data'=> $data
			);
	}
	public function getpreRes($userId,$page=1,$size=10){
		$data = Yii::app()->db->createCommand()->select('a.type,a.startTime,a.endTime,a.type,c.name roomname,b.name hubname')->from('reservation a')->leftJoin('hub b','a.hubId=b.id')->leftJoin('conferenceRoom c','a.conferenceroomId=c.id')->where('a.status!=0 and a.startTime<'.date('Ymdhms'))->order('startTime desc')->queryAll();
		return array(
				'code'=>200,
				'mes'=>'',
				'data'=>$data
			);
	}
	public function cancel($id){
		$result = Reservations::model()->findByAttributes(array('id'=>$id));
			$result->status=0;
			if($result->save()){
				return array(
					'code' => 200,
					'mes' => 'success'
				);
			}else{
				return array(
						'code'=>200,
						'mes'=> 'cancel fail'
					);
			}
	}

	public function createReservation($data){
		$result = new Reservations;
		$result->createTime=date('Y-m-d H:i:s',time());
		foreach($data as $k=> $v){
			$result->$k=$v;
		}
		
		if($data['type']==1){
			$orderid = Order::model()->findAllByAttributes(array('status'=>1,'userId'=>Yii::app()->user->id));
			if($orderid){
				$now = date('Ymd',time());
				foreach ($orderid as $list){
					$dp = OrderProduct::model()->find('endDate>='.$now .' and orderId='.$list['id'].' and startDate<='.$now);
				}
				$dp->usedTimes++;
				$dp->save();
				$result->orderId = $dp['orderId'];
				$result->save();
			}		
		} 
		
		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}

	public function getNumber($date){
		$date =date('YmdHis',strtotime($date));
		$hub = new Hub();
		$hublist = $hub->getHUb();
		$result = array();
		foreach ($hublist as $key) {
			$result []= Yii::app()->db->createCommand()->select('count(*) as num')->from('reservation')->where('status !=0 and type=1 and startTime='.$date .' and hubId='.$key['id'])->queryAll();
		}
		
		if($result){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS',
				'count' => $result
			);
		} else {
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS',
				'count' => ''
			);
		}
		return $data;
	}
}