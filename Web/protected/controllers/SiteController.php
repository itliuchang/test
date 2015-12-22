<?php
class SiteController extends Controller{
	public function actionIndex(){
		echo 'hehe';
	}
	public function actionError(){
		$this->layout = '//layouts/error';
		if($error = Yii::app()->errorHandler->error){
			// print_r($error);die;
			if(Yii::app()->request->isAjaxRequest){
				// echo $error['message'];
				echo CJSON::encode(array('code' => $error['code'], 'message' => $error['message']));
			}else{
				if($error['code'] == 401){
					$url = Yii::app()->request->getHostInfo() . Yii::app()->request->getUrl();
					//Yii::app()->user->setReturnUrl($url);
					$this->redirect('/logout.html?returnurl=' . urlencode($url));
				}
				$this->pageTitle = $error['code'] . ' - ' . $this->pageTitle;
				$this->render('error', $error);
			}
		}
	}
}