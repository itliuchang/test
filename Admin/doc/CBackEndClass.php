<?php
/**
*CBackEndClass class file.
*
*@author Jun
*create by Jun at 11/29 2015
*/


/**
*UserIdentity represents an application module.
*/
class UserIdentity{
	
	/**
	 * This is method for login
	 * @param  string the user input
	 * @param  string the user input
	 * @return array[] {
	 *         		'code':2,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function login($username,$password){

	}

	/**
	 * This is method for logout
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function logout(){

	}

	/**
	 * This is method for add administrator
	 * @param $data array[]{
	 *        			'name':'',
	 *        			'authority':'',
	 *        			...
	 * }
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function addAdmin($data){

	}

	/**
	 * This is method for get all users
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			{userId:'',
	 *         			name:'',
	 *         			...},
	 *         			{userId:'',
	 *         			name:'',
	 *         			...}
	 *         		}
	 * } 
	 */
	public function getUserList(){

	}

	/**
	 * This is method for delete user from list
	 * @param  string $id
	 * @return array[] {
	 * 				  'code':200,
	 * 				  'message':'SUCCESS'
	 * 				}
	 */
	public function deleteUser($id){
		
	}

	/**
	 * This is method for get user information
	 * @param  string $id userId
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			'name':'',
	 *         			'mobile':'',
	 *         			...
	 *         		}
	 * }
	 */
	public function getUserInfo($id){
		
	}

	/**
	 * This is method for edit user information and submit
	 * @param  string $id userId
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function editUserInfo($id){
		
	}

}

/**
*Reservation represents an application module.
*/
class Reservation{

	/**
	 * This is method for get all reservations list
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			{'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...},
	 *         			{'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...}
	 *         		}
	 * }
	 */
	public function getReservationList(){
		
	}

	/**
	 * This is method for get reservations information
	 * @param  string $id 
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...
	 *         		}
	 * }
	 */
	public function getReservationInfo($id){
		
	}

	/**
	 * This is method for delete reservation from list
	 * @param  string $id 
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function deleteReservation($id){
		
	}
}

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

/**
*Community represents an application module.
*/
class Community{

	
	/**
	 * This is method for get post list
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
	public function getPostList(){
		
	}

	/**
	 * This is method for get post information
	 * @param  string $id postID
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
	public function getPostInfo($id){
		
	}

	/**
	 * This is method for delete post from list
	 * @param  string $id postID
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function deletePost($id){
		
	}
}