<?php
class MessageController extends Controller{
	public function actions(){
		return array(
				'list' => 'application.controllers.message.ListAction',
				'show' => 'application.controllers.message.ShowAction'
			);
	}
}