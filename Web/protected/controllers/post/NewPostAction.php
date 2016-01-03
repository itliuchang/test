<?php
class NewPostAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="New Post";
		if(Yii::app()->request->isAjaxRequest){
			$img = Yii::app()->request->getParam('img');
			$content = CHtml::encode(Assist::removeXSS(Assist::removeEmoji(Yii::app()->request->getParam('content'))));
			$content = preg_replace('/\n/mi', '<br/>', $content);
			$proxy = new Posts;
			$proxy->content = $content;
			$proxy->picture = $img;
			$proxy->userId = Yii::app()->user->id;
			$proxy->createTime = date('Y-m-d H:i:s',time());
			$proxy->save();
			echo CJSON::encode(array('code'=>200,'message'=>'SUCCESS'));
		} else {
			$this->controller->render('newpost');
		}
	}
}