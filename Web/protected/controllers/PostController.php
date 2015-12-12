<?php
class PostController extends Controller{
	public function actions(){
		return array(
			'newlist' => 'application.controllers.post.NewListAction',
			'postshow' => 'application.controllers.post.PostShowAction',
			'newpost' => 'application.controllers.post.NewPostAction'
			);
	}
}