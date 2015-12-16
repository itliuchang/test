<?php
class ReservationController extends Controller{
	
	public function filters(){
		return array(
				'accessControl',
		);
	}
	
	public function accessRules(){
		return array(
			array('allow',
				'actions' => array('list', 'edit','cancel','confirm','create','editinfo'),
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}
	
    public function actions(){
        return array(
        	'list' => 'application.controllers.reservation.ListAction',
        	'create' => 'application.controllers.reservation.CreateAction',
        	'edit' => 'application.controllers.reservation.EditAction',
        	'editinfo' => 'application.controllers.reservation.EditInfoAction',
        	'confirm' => 'application.controllers.reservation.ConfirmAction',
        	'cancel'=>'application.controllers.reservation.CancelAction'
        );
    }
}