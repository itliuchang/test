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
        $criteria->addCondition('t.status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
 		$result = Posts::model()->findAll($criteria);
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
 				'count'=>$count,
 				'data'=>''
 			);
 		}
 		return $data;	
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
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'data'=>$result
 			);
 		}
 		return $data;
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
 		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}
}