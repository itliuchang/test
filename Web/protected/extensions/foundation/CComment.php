<?php
class CComment{
	public function sendcomment($data){
		$user = Yii::app()->db->createCommand('select a.title,a.portrait,a.nickName,b.name as companyName,c.name as location from user a left join company b on a.company=b.id left join hub c on a.location=c.id where a.status!=0 and a.id='.$data['userId'])->queryRow();
		$comment = new Comment;
		$comment->postId = $data['postId'];
		$comment->userId = $data['userId'];
		$comment->content = $data['content'];
		$comment->createTime = $data['createTime'];
		$posterId=Posts::model()->findByAttributes(array('id'=>$data['postId']))->userId;
		$userName = User::model()->findByAttributes(array('id'=>$data['userId']))->nickName;
		if($posterId!=$data['userId']){
			$message = new Message;
			$message->senderID=0;
			$message->RecID=$posterId;
			$message->body=$userName.' 评论了您的帖子';
			$message->data=$data['postId'];
			$message->type=1;
			$message->status=0;
			$message->ctime=date('U');
			$message->save();
		}
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