<?php
class COrder{
	public function create($data=array()){
		$order = new Order;
		try {
			$order-> productId =  $data['productId'];
			$order-> userId = $data['userId'];
			$order-> price = $data['price'];
			$order-> orderTime = $data['orderTime'];
			$order-> createTime = $data['orderTime'];
			$order-> type = $data['type'];
			$order-> hubId = $data['hubId'];
		} catch (Exception $e) {}
		if($order->save()){
			$result = Order::model()->findByAttributes(array('orderTime'=> $data['orderTime']));
			return array(
					'code' => 200,
					'mes' => 'success',
					'data' => array('orderId' => $result->id)
				);
		}else{
			return array(
					'code' => 500,
					'mes' =>'error'
				);
		}
	}
	public function update($id){
		$transaction = Yii::app()->db->beginTransaction();
		try{
			$order = Order::model()->findByAttributes(array('id'=>$id));
			$order->status = 1;
			$ordercompanyproduct = OrderCompany::model()->findAllByAttributes(array('orderId'=>$id));
			if($ordercompanyproduct){
				foreach ($ordercompanyproduct as &$value) {
					$code = Code::model()->findByAttributes(array('ordercompanyproductId'=>$value->id));
					$code->status=1;
					$value->status=1;
					if(!$value->save()||!$code->save()){
						throw new Exception("Error Processing Request", 1);
					}
				}
			}
			$order->save();
			$transaction->commit();
		}catch(Exception $e){
			$transaction->rollback(); 
			Yii::log('update fail', CLogger::LEVEL_ERROR,'updatedb');
			return array(
					'code' => 500,
					'mes' => 'update fail'
				);
		}
		return array(
				'code' => 200,
				'mes' =>'success'
			);
			

	}
	public function createProduct($data){
		$orderProduct = new OrderProduct;
		$createTime = date('Y-m-d H:i:s');
		$orderProduct-> orderId = $data['orderId'];
		$orderProduct-> startDate = $data['startDate'];
		$orderProduct-> endDate = $data['endDate'];
		$orderProduct-> totalTimes = $data['totalTimes'];
		$orderProduct-> usedTimes = $data['use'];
		$orderProduct-> createTime = $createTime;
		if($orderProduct->save()){
			return array(
					'code' => 200,
					'mes' =>'success',
				);
		}else{
			return array(
					'code' => 500,
					'mes' => 'create fail'
				);
		}	
	}

	public function createCompanyProduct($data){
		$orderProduct = new OrderCompany;
		$createTime = date('Y-m-d H:i:s');
		$orderProduct-> orderId = $data['orderId'];
		$orderProduct-> startDate = $data['startDate'];
		$orderProduct-> endDate = $data['endDate'];
		$orderProduct-> num = $data['num'];
		$orderProduct-> cproductId = $data['cproductId'];
		$orderProduct-> createTime = $createTime;
		$orderProduct-> insert();
		if($orderProduct->save()){
			return array(
					'code' => 200,
					'mes' =>'success',
					'data' => array('id'=>$orderProduct['id'])
				);
		}else{
			return array(
					'code' => 500,
					'mes' => 'create fail'
				);
		}
	}

	public function checkProduct($orderId){
		return OrderProduct::model()->findByAttributes(array('orderId'=>$orderId));
	}

	public function getlist($userId){
		$result = Yii::app()->db->createCommand()->setText("select  d.name productName ,c.startDate,c.endDate,e.name location,a.createTime   from code_used a left join code b on a.codeId=b.id left join order_company_product c on b.ordercompanyproductId=c.id left join product_company d on c.cproductId=d.id left join hub e on d.hubId=e.id  where a.userId=".$userId." and c.`status`!=0 and a.`status`!=0  and b.`status`!=0  and d.`status`!=0  and e.`status`!=0")->queryAll();
		// $resultOpen = Yii::app()->db->createCommand()->setText("select a.id ,a.price as orderPrice,a.orderTime, c.name ,c.price as productPrice from `order` a left join order_product b on a.id=b.orderId left join product c on a.productId=c.id where a.type=1 and a.`status`!=0 and b.`status`!=0 and c.`status`!=0 and  a.userId=".$userId." order by a.orderTime desc ")->queryAll();
		$resultOpen = Yii::app()->db->createCommand()->setText("select a.*,c.name as productName,c.id as productType from order_product a left join `order` b on a.orderId=b.id left join product c on b.productId=c.id where a.status!=0 and b.status!=0 and b.userId=".$userId." and a.endDate> DATE_FORMAT(CURDATE(), '%Y%m%d') order by a.endDate asc")->queryAll();
		$array = [];
		foreach ($result as $value) {
			array_push($array,$value);
		}
		foreach ($resultOpen as $value) {
			array_push($array,$value);
		}
		usort($array,'static::sortByTime');
		return array(
				'code'=>200,
				'mes'=> '',
				'data' => array(
						'list'=> $array,
					)
			);
	}

	static public function sortByTime($a,$b){
		if(strtotime($a['createTime'])<strtotime($b['createTime'])){
			return 1;
		}else{
			return -1;
		}
	}

	public function getOrderlist($userId){
		$result = Yii::app()->db->createCommand()->setText("select a.id orderId,a.createTime, DATE_FORMAT(a.orderTime,'%Y-%m-%d') orderTime,a.price amountPrice,b.startDate startDate,b.endDate endDate,d.location location,c.name productName,b.num num from `order` a left join order_company_product b on a.id=b.orderId left join product_company c on b.cproductId = c.id left join hub d on a.hubId = d.id  where a.type = 2 and a.userId = ".$userId." and a.`status`!=0")->queryAll();
		$resultOpen = Yii::app()->db->createCommand()->setText("select a.id,a.createTime ,a.price as orderPrice,a.orderTime, c.name ,c.price as productPrice from `order` a left join order_product b on a.id=b.orderId left join product c on a.productId=c.id where a.type=1 and a.`status`!=0 and b.`status`!=0 and c.`status`!=0 and  a.userId=".$userId." order by a.orderTime desc ")->queryAll();
		$array = [];
		foreach ($result as $value) {
			array_push($array,$value);
		}
		foreach ($resultOpen as $value) {
			array_push($array,$value);
		}
		usort($array,'static::sortByTime');
		print_r($array);die;
		return array(
				'code'=>200,
				'mes'=>'',
				'data'=>array(
						'list'=>$array,
					)
			);
	}

	public function getCompanyProductlist($startDate,$endDate=''){
		if(!$endDate){
			$endDate = date('Y-m-d',strtotime($startDate)+(date('t',strtotime($startDate))-1)*60*60*24);
		}
		// $result = CompanyProduct::model()->findAll("startDate<='".$startDate."' and endDate >='".$endDate."'");
		$result = Yii::app()->db->createCommand("select * from product_company where startDate<='".$startDate."' and endDate >='".$endDate."'")->queryAll();
		if($result){
			foreach ($result as &$list){
				$num = OrderCompany::model()->findAll("(startDate<='".$startDate."' and endDate<='".$endDate."' or startDate<='".$endDate."' and endDate>='".$endDate."' or startDate>='".$startDate."' and endDate<='".$endDate."' or startDate<='".$startDate."' and endDate>='".$endDate."') and status=1 and cproductId=".$list['id']);
				if($num){
					$count = 0;
					foreach($num as $item){
						$count += $item['num'];
					}
					$list['left'] = $list['num']-$count;
				} else {
					$list['left'] = $list['num'];
				}
						
			}
			return $result;
		} else {
			return '';
		}		
		
	}
}