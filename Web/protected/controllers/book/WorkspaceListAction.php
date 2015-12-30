<?php
class WorkspaceListAction extends CAction{
	public function run(){
		$now = date('Y-m-d',time());
		$date = Yii::app()->request->getParam('date');
		$date = $date==''?$now:$date;
		$proxy = new CHub();
		$result = $proxy->getHubList();

		if(Yii::app()->request->isAjaxRequest){
			$id = Yii::app()->request->getParam('id');
			if($id){
				$orderid = Order::model()->findAllByAttributes(array('status'=>1,'userId'=>1186));
				if($orderid){
					$now = date('Ymd',time());
					foreach ($orderid as $list){
						$order = OrderProduct::model()->find('endDate>='.$now .' and orderId='.$list['id'].' and startDate<='.$now);
						if($order){break;}
					}
					if($order){
						echo CJSON::encode(array('code'=>200,'data'=>array('num'=>$order['totalTimes']-$order['usedTimes'])));
					} else {
						echo CJSON::encode(array('code'=>200,'data'=>array('num'=>0)));
					}
				} else {
					echo CJSON::encode(array('code'=>200,'data'=>array('num'=>0)));
				}
			} else {
				$proxy = new CReservation();
				$result = $proxy->getNumber($date);
				if($result['code']==200){
					$data = array(
						'code'=>200,
						'data'=>$result
					);
					echo CJSON::encode($data);
				}
			}
			
		} else {
			$this->controller->render('workspacelist',array(
				'data' => $result['data'],
				'date' => $date
			));
		}
		
	}
}