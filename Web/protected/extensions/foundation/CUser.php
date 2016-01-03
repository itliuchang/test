<?php
class CUser{
	public function like($userId,$postId){
		$like = new Like;
		$like->postId = $postId;
		$like->userId = $userId;
		$like->createTime = date('Y-m-d H:i:s');
		if($like->save()){
			return array(
					'code' => 200,
					'mes' => 'success',
					'data' => array('postId'=>$like->postId,'id'=>$like->id)
				);
		}else{
			return array(
					'code' => 500,
					'mes' => 'fail',
					'data' => ''
				);
		}
	}

}