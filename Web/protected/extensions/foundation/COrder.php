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
		$order = Order::model()->findAllByAttributes(array('userId'=>$userId,'status'=>1));
		$length = count($order);
		$products = array();
		for($i=0;$i<$length;$i++){
			$products[$i]['content'] = OrderProduct::model()->findAllByAttributes(array("orderId"=>$order[$i]['id']));
			$products[$i]['productType'] = $order[$i]['productId'];
			$relate = Order::model()->with('product')->findByAttributes(array("productId"=>$order[$i]['productId']));
			$products[$i]['times'] = $relate['product']['times'];
		}
		print_r($products);die;
	}
}