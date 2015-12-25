<?php
class WorkspaceListAction extends CAction{
	public function run(){
		$now = date('Y-m-d',time());
		$date = Yii::app()->request->getParam('date');
		$date = $date==''?$now:$date;
		$proxy = new CHub();
		$result = $proxy->getHubList();

		if(Yii::app()->request->isAjaxRequest){
			$proxy = new CReservation();
			$result = $proxy->getNumber($date);
			if($result['code']==200){
				$data = array(
					'code'=>200,
					'data'=>$result
				);
				echo CJSON::encode($data);
			}
		} else {
			$this->controller->render('workspacelist',array(
				'data' => $result['data'],
				'date' => $date
			));
		}
		
	}
}