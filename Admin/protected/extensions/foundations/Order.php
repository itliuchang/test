<?php
/**
*CBackEndClass class file.
*
*@author Jun
*create by Jun at 11/29 2015
*/



/**
*Order represents an application module.
*/
class Order{
	/**
	 * This is method for get order list
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			{'id':'',
	 *         			'content':'',
	 *         			'createTime':'',
	 *         			'updateTime':'',
	 *         			...},
	 *         			{'id':'',
	 *         			'content':'',
	 *         			'createTime':'',
	 *         			'updateTime':'',
	 *         			...}
	 *         		}
	 * }
	 */
	public function getOrderList($start,$size){
		$start = 0+$start;
 		$count = Orders::model()->count('status!=0');
 		$criteria = new CDbCriteria();
        $criteria->addCondition('t.status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $result = Orders::model()->with('product')->with('user')->findAll($criteria);
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>$count,
 				'data'=>$result
 			);
 		} else {
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>0,
 				'data'=>''
 			);
 		}
 		return $data;
	}

	/**
	 * This is method for get order information
	 * @param  string $id orderID
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			'id':'',
	 *         			'content':'',
	 *         			'createTime':'',
	 *         			...
	 *         		}
	 * }
	 */
	public function getOrderInfo($id){
		$result = Orders::model()->with('product')->with('user')->findByAttributes(array('id'=>$id));
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'data'=>$result
 			);
 		}
 		return $data;
	}

	public function deleteOrder($id){
		$result = Orders::model()->findByAttributes(array('id'=>$id));
 		$result->status='0';
 		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}

}
