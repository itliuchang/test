<?php
/**
*UserIdentity represents an application module.
*/
class Auth{
	
	/**
	 * This is method for login
	 * @param  string the user input
	 * @param  string the user input
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function login($username,$password){
		echo 'login';
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
	 * This is method for get all admins
	 * @return array[] [description]
	 */
	public function getAdminList($start,$size){
 		$start = 0+$start;
 		$count = User::model()->count('status!=0');
 		$criteria = new CDbCriteria;
        $criteria->addCondition('status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $data = User::model()->findAll($criteria);
 		return $result=array($count,$data);
 	
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
