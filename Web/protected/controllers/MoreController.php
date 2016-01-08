<?php
class MoreController extends Controller{
	public function actionIndex(){
		$this->pageTitle="More";
		$this->render('index');
	}
}