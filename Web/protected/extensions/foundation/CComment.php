<?php
class CComment{
	public function sendcomment($data){
		$user = Yii::app()->db->createCommand('select a.title,a.portrait,a.nickName,b.name as companyName,c.name as location from user a left join company b on a.company=b.id left join hub c on a.location=c.id where a.status!=0 and a.id='.$data['userId'])->queryRow();
		$comment = new Comment;
		$comment->postId = $data['postId'];
		$comment->userId = $data['userId'];
		$comment->content = $data['content'];
		$comment->createTime = $data['createTime'];
		$post = Posts::model()->findByAttributes(array('id'=>$data['postId']));
		$post->comment_num++;
		if($comment->save()&&$post->save()){
			return array(
					'code' => 200,
					'mes' => 'success',
					'data' => array('newcomment'=>Comment::model()->findByAttributes(array('createTime'=>$data['createTime'])),'user'=>$user)
				);
		}
	}
}