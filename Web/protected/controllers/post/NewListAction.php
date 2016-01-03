<?php
class NewListAction extends CAction{
	public function run($page=1,$size=2){
		$post = new CPost;
		$result = $post->getlist($page,$size);
		if(Yii::app()->request->isAjaxRequest){
			echo CJSON::encode(array(
					'code' => 200,
					'mes' => success,
					'data' => array('list'=>$result['data'])
				));
		}else if ($result['code']==200){
			$this->controller->bodyCss="newpostlist";
			$this->controller->render('newlist',array('list'=>$result['data']));
		}
	}
}