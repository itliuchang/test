<?php
class CommunityBarWidget extends CWidget{
	public $currentTab = '';
	public function run(){
		$this->render('communitybar');
	}
}