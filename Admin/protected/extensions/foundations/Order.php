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
	public function getOrderList(){
		return 'order';
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
		
	}

	/**
	 * This is method for delete order from list
	 * @param  string $id orderID
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function deleteOrder($id){
		
	}
}
