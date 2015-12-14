<?php
class RoomListAction extends CAction{
	public function run(){
		$room = new MeetingRoom;
		$result = $room->listroom(1);
		$date = '2015-12-14';
		var_dump($room->otherSelect($date,186000,1));die;
		// $this->controller->render('roomlist',$result);
	}
}