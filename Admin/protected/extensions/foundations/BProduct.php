<?php
/**
*Product represents an application module.
*/
class BProduct{

	/**
	 * This is method for get Product list
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			{'id':'',
	 *         			'content':'',
	 *         			'createTime':'',
	 *         			...},
	 *         			{'id':'',
	 *         			'content':'',
	 *         			'createTime':'',
	 *         			...}
	 *         		}
	 * }
	 */
	public function getProductList($start,$size){
		$start = 0+$start;
 		$criteria = new CDbCriteria;
        $criteria->addCondition('status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $result = Products::model()->findAll($criteria);
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>Products::model()->count('status!=0'),
 				'data'=>$result
 			);
 		} else {
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>Products::model()->count('status!=0'),
 				'data'=>''
 			);
 		}
 		return $data;
	}

	/**
	 * This is method for get Product information
	 * @param  string $id
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
	public function getProductInfo($id){
		$result = Products::model()->findByAttributes(array('id'=>$id));
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'data'=>$result
 			);
 		}
 		return $data;
	}

	public function createProduct($data){
		$result = new Products;
		$result->createTime=date('Y-m-d h:i:s',time());
		foreach($data as $k=> $v){
			$result->$k=$v;
		}
		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}

	/**
	 * This is method for delete Product from list
	 * @param  string $id
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function deleteProduct($id){
		$result = Products::model()->findByAttributes(array('id'=>$id));
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
