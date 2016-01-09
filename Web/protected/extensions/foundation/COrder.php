<?php
class COrder{
	public function create($data=array()){
		$order = new Order;
		$order-> productId =  $data['productId'];
		$order-> userId = $data['userId'];
		$order-> price = $data['price'];
		$order-> orderTime = $data['orderTime'];
		$order-> createTime = $data['orderTime'];
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
		$order = Order::model()->findByAttributes(array('id'=>$id));
		$order->status = 1;
		if($order->save()){
			return array(
					'code' => 200,
					'mes' =>'success'
				);
		}else{
			return array(
					'code' => 500,
					'mes' => 'update fail'
				);
		}	

	}
	public function createProduct($data){
		$orderProduct = new OrderProduct;
		$orderProduct-> orderId = $data['orderId'];
		$orderProduct-> startDate = $data['startDate'];
		$orderProduct-> endDate = $data['endDate'];
		$orderProduct-> totalTimes = $data['totalTimes'];
		$orderProduct-> usedTimes = $data['use'];
		if($orderProduct->save()){
			return array(
					'code' => 200,
					'mes' =>'success'
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
		$result = Yii::app()->db->createCommand()->setText("select a.*,c.name as productName,c.id as productType from order_product a left join `order` b on a.orderId=b.id left join product c on b.productId=c.id where a.status!=0 and b.status!=0 and b.userId=".$userId." and a.endDate> DATE_FORMAT(CURDATE(), '%Y%m%d') order by a.endDate asc")->queryAll();
		return array(
				'code'=>200,
				'mes'=> '',
				'data' => array(
						'list'=> $result,
					)
			);
	}
}