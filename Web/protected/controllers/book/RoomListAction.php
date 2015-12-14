<?php
class RoomListAction extends CAction{
	public function run(){
		$room = new MeetingRoom;
		$result = $room->listroom(1);
		$this->controller->render('roomlist',$result);
	}
}