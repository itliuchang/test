<?php
/**
 * This is Class for MeetingRoom
 * Create by Leon 2015/12/1
 */
Class MeetingRoom{

	public $date;
	public function __construct() {
		$this->date = date('Y-m-d',time());
	}
	/**
	 * This is method for list
	 * @param  [int] location 1:fuxing
	 * @return [array]{
	 *         code:200,
	 *         mes:'',
	 *         data:{[{
	 *         		roomId:1221,
	 *         		roomName:'',
	 *         		floor:3,
	 *         		seats:8,
	 *         		pic:'http://q.qlogo.cn/qqapp/1104566934/4F54EC3310FD140F55B1BCC91A06C328/100',
	 *         		doneTime:[1,2,3,48],(every part instead half hour)
	 *         	 	},
	 *         ]
	 *         }
	 * }
	 */
	public function listroom($location=1,$date=''){
		$date = $date?:$this->date;
		$data = Room::model()->findAllByAttributes(array('hubId'=>$location));
		if($data){
			return array(
					'code' => '200',
					'mes' => '',
					'data' => $data
				);
		}else{
			return '';
		}
	}

	/**
	 * This is method for getInfo
	 * @param  [int] roomId 
	 * @return [array] {
	 *         code:200,
	 *         mes:'',
	 *         data:{
	 *         		roomId:1221,
	 *         		roomName:'',
	 *         		floor:3,
	 *         		seats:8,
	 *         		pic:'http://q.qlogo.cn/qqapp/1104566934/4F54EC3310FD140F55B1BCC91A06C328/100',
	 *         		doneTime:[1,2,3,48],(every part instead half hour)
	 *         }
	 * }
	 */
	public function getInfo($roomId){

	}

	public function otherSelect($date,$userId,$roomId){
		$date = $date?:$this->date;
		$criteria = new CDbCriteria;
		$criteria->addCondition(array('status=1','type=2','conferenceroomId='.$roomId,'userId!='.$userId));
		$criteria->addSearchCondition('startTime',$date);
		$result = Reservations::model()->findAll($criteria);
		if(!empty($result)){
			$arr = array();
			foreach($result as $list){
				$start = date('H',strtotime($list['startTime']));
				$end = date('H',strtotime($list['endTime']));
				for($i = 0;$i<($end-$start)*2;$i++){
					array_push($arr,($start-9)*2+$i);
				}
			}
			return $arr;
		} else {
			return '';
		}
	}

	public function mySelect($date,$userId,$roomId){
		$date = $date?:$this->date;
		$criteria = new CDbCriteria;
		$criteria->addCondition(array('status=1','type=2','userId='.$userId,'conferenceroomId='.$roomId));
		$criteria->addSearchCondition('startTime',$date);
		$result = Reservations::model()->findAll($criteria);
		if(!empty($result)){
			$arr = array();
			foreach($result as $list){
				$start = date('H',strtotime($list['startTime']));
				$end = date('H',strtotime($list['endTime']));
				for($i = 0;$i<($end-$start)*2;$i++){
					array_push($arr,($start-9)*2+$i);
				}
			}
			return $arr;
		} else {
			return '';
		}
	}
}