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
			$hub = Yii::app()->request->getParam('hub');
			$date = Yii::app()->request->getParam('date');
			if($id){
				$date = date('Ymd',strtotime($date));
				$record = Reservations::model()->findAll('startTime ='.date('Ymd',strtotime($date)).'100000' .' and userId='.Yii::app()->user->id.' and type=1 and status=1');
				$orderid = Order::model()->findAllByAttributes(array('status'=>1,'userId'=>Yii::app()->user->id));
				if($orderid){
					foreach ($orderid as $list){
						$order = OrderProduct::model()->find('endDate>='.$date .' and orderId='.$list['id'].' and startDate<='.$date);
						if($order){break;}
					}
					if($order){
						echo CJSON::encode(array('code'=>200,'data'=>array('num'=>$order['totalTimes']-$order['usedTimes'],'count'=>count($record))));
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