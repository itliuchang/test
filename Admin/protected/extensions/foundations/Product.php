<?php
/**
*Product represents an application module.
*/
class Product{

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
 		$count = Products::model()->count('status!=0');
 		$criteria = new CDbCriteria;
        $criteria->addCondition('status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $data = Products::model()->with('hub')->findAll();
 		return $result=array($count,$data);
 		
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
		
	}
}
