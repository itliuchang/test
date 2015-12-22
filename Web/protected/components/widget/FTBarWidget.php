<?php
class FTBarWidget extends CWidget{
	public $currentTab = '';
	public function run(){
		$this->render('ftbar');
	}
}