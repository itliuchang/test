<?php
Class SendCommentAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$postId = Yii::app()->request->getParam('postId');
			$content = Yii::app()->request->getParam('content');
			$createTime = date('Y-m-d H-i-s');
			$userId = Yii::app()->user->id;
			$comment = new CComment;
			$result = $comment->sendcomment(array(
				'postId'=>$postId,
				'content'=>$content,
				'userId' => $userId,
				'createTime' => $createTime
				));
			echo CJSON::encode($result);	
		}
	}
}