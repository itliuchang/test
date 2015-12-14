<?php
/**
*Community represents an application module.
*/
class BCommunity{

	
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
	public function getPostList($start,$size){
		$start = 0+$start;
 		$count = Posts::model()->count('status!=0');
 		$criteria = new CDbCriteria;
        $criteria->addCondition('status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $data = Posts::model()->findAll($criteria);
 		return $result=array($count,$data);
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
		$result = Posts::model()->findByAttributes(array('id'=>$id));
 		return $result;
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
		$result = Posts::model()->findByAttributes(array('id'=>$id));
 		$result->status='0';
 		$result->save();
 		return $result;
	}
}