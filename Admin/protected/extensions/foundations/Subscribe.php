<?php
/**
*Subscribe represents an application module.
*/
class Subscribe{

	/**
	 * This is method for get subscribe list
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
	public function getSubscribeList(){
		
	}

	/**
	 * This is method for get subscribe information
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
	public function getSubscribeInfo($id){
		
	}

	/**
	 * This is method for delete subscribe from list
	 * @param  string $id
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function deleteSubscribe($id){
		
	}
}
