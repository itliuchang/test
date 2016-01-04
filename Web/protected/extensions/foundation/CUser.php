<?php
class CUser{
	public function like($userId,$postId){
		$like = new Like;
		$like->postId = $postId;
		$like->userId = $userId;
		$like->createTime = date('Y-m-d H:i:s');
		$post = Posts::model()->findByAttributes(array('id'=>$postId));
		$post->like_num++;
		if($like->save()&&$post->save()){
			return array(
					'code' => 200,
					'mes' => 'success',
					'data' => array('postId'=>$like->postId,'id'=>Like::model()->findByattributes(array('createTime'=>$like->createTime))->id)
				);
		}else{
			return array(
					'code' => 500,
					'mes' => 'fail',
					'data' => ''
				);
		}
	}

	public function liked($id){
		$result = Like::model()->findByAttributes(array('id'=>$id));
		$result->status=0;
		$post = Posts::model()->findByAttributes(array('id'=>$result->postId));
		$post->like_num--;
		if($result->save()&&$post->save()){
			echo CJSON::encode(array(
					'code' => 200,
					'mes' => 'success',
					'data' => array('postId'=>$result->postId)
				));
		}
	}

}