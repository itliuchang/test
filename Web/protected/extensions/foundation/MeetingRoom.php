<?php
/**
 * This is Class for MeetingRoom
 * Create by Leon 2015/12/1
 */ 
Class MeetingRoom{

	private $date;
	private $userId;
	private $roomId;
	private $location;
	function __construct($date,$userId,$roomId,$location) {
		$this->date = $date;
		$this->userId = $userId;
		$this->roomId = $roomId;
		$this->location = $location;
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
	public function listroom(){
		$data = Room::model()->findAllByAttributes(array('hubId'=>$this->location,'status'=>1));
		$value=array();
		if($data){
			foreach ($data as $list){
				$key = $list['id'];
				$my= self::mySelect($this->date,$this->userId,$list['id'],$this->location);
				$other=self::otherSelect($this->date,$this->userId,$list['id'],$this->location);

				$value[] = array(
					'info'=>$list,
					'my'=>$my,
					'other'=>$other
				);
			}
			return array(
					'code' => '200',
					'mes' => '',
					'data' => $value
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
	public function getInfo(){
		$data = Room::model()->findByAttributes(array('id'=>$this->roomId,'hubId'=>$this->location,'status'=>1));
		if($data){
			$my= self::mySelect($this->date,$this->userId,$this->roomId,$this->location);
			$other=self::otherSelect($this->date,$this->userId,$this->roomId,$this->location);
			$value = array(
				'info'=>$data,
				'my'=>$my,
				'other'=>$other
			);
			return array(
					'code' => '200',
					'mes' => '',
					'data' => $value
				);
		}else{
			return '';
		}
	}

	public function otherSelect($date,$userId,$roomId,$location){
		
		$criteria = new CDbCriteria;
		$criteria->addCondition(array('status=1','type=2','conferenceroomId='.$roomId,'userId!='.$userId,'hubId='.$location));
		$criteria->addSearchCondition('startTime',$date);
		$result = Reservations::model()->findAll($criteria);
		if(!empty($result)){
			$arr = array();
			foreach($result as $list){
				$start = strtotime($list['startTime']);
				$end = strtotime($list['endTime']);
				$length = ($end-$start)/3600;
				for($i = 0;$i<$length*2;$i++){
					array_push($arr,((date('H',$start)-9)+date('i',$start)/60)*2+$i);
				}
			}
			return $arr;
		} else {
			return '';
		}
	}

	public function mySelect($date,$userId,$roomId,$location){
		
		$criteria = new CDbCriteria;
		$criteria->addCondition(array('status=1','type=2','userId='.$userId,'conferenceroomId='.$roomId,'hubId='.$location));
		$criteria->addSearchCondition('startTime',$date);
		$result = Reservations::model()->findAll($criteria);
		if(!empty($result)){
			$arr = array();
			foreach($result as $list){
				$start = strtotime($list['startTime']);
				$end = strtotime($list['endTime']);
				$length = ($end-$start)/3600;
				for($i = 0; $i < $length*2; $i++){
					array_push($arr,((date('H',$start)-9)+date('i',$start)/60)*2+$i);
				}
			}
			return $arr;
		} else {
			return '';
		}
	}
}