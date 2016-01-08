<?php
class AccountAction extends CAction{
	public function run(){
        $this->controller->pageTitle='My Account';

		$order = new COrder;
		$result = $order->getlist(Yii::app()->user->id);
		$this->controller->bodyCss='account';
		if($result['code']==200){
			$this->controller->render('account',array('data'=>$result['data']));
		}else{
			throw new Exception("参数错误", 1);
			
		}
	}
}