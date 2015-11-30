<?php
class SiteController extends Controller{
	public function filters(){
		return array(
			'accessControl',
		);
	}
	
	public function accessRules(){
		return array(
			// array('deny',
			// 	'actions' => array('index'),
			// 	'users' => array('?'),
			// ),
			array('allow',
				  'actions' => array('error'),
				  'users'=>array('*'),
			),
			array('allow',
				'actions' => array('index'),
				'users' => array('@'),
			),
			array('deny',
				// 'actions' => array('index'),
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex(){
		// echo gettype(Coordinate::model()->findAll());die;
		// print_r(Coordinate::model()->findAll()->count());die;
		// print_r(Coordinate::model()->findOne(array('bb' => 'abc'))->bb);die;
		//Yii::app()->mongodb->abc->insert(array('a' => 1))
		// print_r(iterator_to_array(Yii::app()->mongodb->abc->find()));die;
		// print_r(Yii::app()->mongodb->abc->findOne(array("a" => 1)));die;
		// echo 'Welcome!';
		$this->render('index');
	}
	
	public function actionError(){
		if($error = Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest){
				echo CJSON::encode(array('code'=>$error['code'], 'message'=>$error['message']));
			} else {
				if($error['code'] === CProxy::NOTLOGIN) {
					$this->redirect(array('/login'));
				} else {
					$this->pageTitle = $error['code'] . ' - ' . $this->pageTitle;
					$this->render('error', $error);
				}
			}
		}
	}
}