<?php
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