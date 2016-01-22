<?php
class CReservation{
	public function getupcomingRes($userId,$page=1,$size=10){
		$data = Yii::app()->db->createCommand()->select('a.id,a.type,a.createTime,a.startTime,a.endTime,a.type,c.name roomname,b.name hubname')->from('reservation a')->leftJoin('hub b','a.hubId=b.id')->leftJoin('conferenceRoom c','a.conferenceroomId=c.id')->where('a.status!=0 and a.userId='.$userId.' and a.startTime>'.date('Ymdhms'))->order('createTime desc')->queryAll();
		return array(
				'code'=>200,
				'mes'=>'',
				'data'=> $data
			);
	}
	public function getpreRes($userId,$page=1,$size=10){
		$data = Yii::app()->db->createCommand()->select('a.type,a.createTime,a.startTime,a.endTime,a.type,c.name roomname,b.name hubname')->from('reservation a')->leftJoin('hub b','a.hubId=b.id')->leftJoin('conferenceRoom c','a.conferenceroomId=c.id')->where('a.status!=0  and a.userId='.$userId.' and a.startTime<'.date('Ymdhms'))->order('startTime desc')->queryAll();
		return array(
				'code'=>200,
				'mes'=>'',
				'data'=>$data
			);
	}
	public function cancel($id){
		$result = Reservations::model()->findByAttributes(array('id'=>$id));
		if($result->type==1){
			$order_productID = Yii::app()->db->createCommand("select b.id from reservation a  left join order_product b on b.orderId=a.orderId where DATE_FORMAT(a.startTime, '%Y%m%d' )>=b.startDate and DATE_FORMAT(a.startTime, '%Y%m%d' )<=b.endDate and a.id=".$id)->queryRow();
			$item = OrderProduct::model()->findByAttributes(array('id'=>$order_productID['id']));
			$item->usedTimes--;
			$item->save();
		}
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
				$now = date('Ymd',strtotime(substr($data['startTime'],0,10)));
				foreach ($orderid as $list){
					$dp = OrderProduct::model()->find('endDate>='.$now .' and orderId='.$list['id'].' and startDate<='.$now);
					if($dp){break;}
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

	public function getNumber($date,$hubId=''){
		$date =date('YmdHis',strtotime($date.' 10:00:00'));
		$hub = new Hub();
		$hublist = $hub->getHUb();
		if($hubId){
			$result = Reservations::model()->count('status !=0 and type=1 and startTime='.$date .' and hubId='.$hubId);
		} else {
			$result = array();
			foreach ($hublist as $key) {
				$result []= Reservations::model()->count('status !=0 and type=1 and startTime='.$date .' and hubId='.$key['id']);
			}
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
				'count' => 0
			);
		}
		return $data;
	}
}