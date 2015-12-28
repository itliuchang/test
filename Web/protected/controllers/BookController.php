<?php
class BookController extends Controller{

	public function actions(){
		return array(
				'workspacelist' => 'application.controllers.book.WorkspaceListAction',
				'workspaceconfirm' => 'application.controllers.book.WorkspaceConfirmAction',
				'roomlist' => 'application.controllers.book.RoomListAction',
				'roomshow' => 'application.controllers.book.RoomShowAction',
				'myreservations' => 'application.controllers.book.MyReservationsAction',
				'commitroomreservation' => 'application.controllers.book.CommitRoomReservationAction',
				'commitconfirm' => 'application.controllers.book.CommitConfirmAction',
				'cancel' => 'application.controllers.book.CancelAction'
			);
	}
}