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
}