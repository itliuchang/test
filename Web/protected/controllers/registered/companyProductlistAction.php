<?php
class companyProductlistAction extends CAction{
	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			$date = Yii::app()->request->getParam('date');
			$mouth = Yii::app()->request->getParam('mouth');
			if(!$mouth){
				$date = date('Y-m-d');
			} else{
				$endDate = date('Y-m-d',strtotime($date)+(date('t',strtotime($date))-1)*$mouth*60*60*24);
			}
			
			$proxy = new COrder;
			$result = $proxy->getCompanyProductlist($date,$endDate);
			echo CJSON::encode(array('code'=>200,'data'=>$result));
		} else{
			$this->controller->render('companyproductlist',array('date'=>date('Y-m-d')));
		}
	}
}