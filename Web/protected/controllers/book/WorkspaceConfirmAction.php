<?php
class WorkspaceConfirmAction extends CAction{
	$this->controller->pageTitle ="Workspaces";
	public function run($id,$date){
		$date = str_replace('$','-',$date);
		$proxy = new CHub();
		$result = $proxy->getHubInfo($id);
		$this->controller->render('workspaceconfirm',array(
			'data' => $result['data'],
			'date' => $date
		));
	}
}