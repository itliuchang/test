<?php
class BookController extends Controller{
	public function filters(){
        return array(
            'wechat','accessControl','main'
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions' => array('workspacelist','workspaceconfirm','roomlist','roomshow','myreservations','commitroomreservation','commitconfirm','cancel'),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
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