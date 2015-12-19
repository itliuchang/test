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
}