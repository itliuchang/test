<?php
class PostShowAction extends CAction{
	public function run($id){
		$post = new CPost;
		$result = $post->getpost($id);
		if($result['code']=200){
			$this->controller->render('postshow',array('data'=>$result['data']));
		}
	}
}