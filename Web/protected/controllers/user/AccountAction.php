<?php
class AccountAction extends CAction{
	public function run(){
        $this->controller->pageTitle='My Account';
		$order = new COrder;
		$productlist = $order->getlist(Yii::app()->user->id);
		$orderlist = $order->getOrderlist(Yii::app()->user->id);
		$this->controller->bodyCss='account';
		// print_r($orderlist);die;
		if($productlist['code']==200&&$orderlist['code']==200){
			$this->controller->render('account',array('orderlist'=>$orderlist['data'],'productlist'=>$productlist['data']));
		}else{
			throw new Exception("参数错误", 1);
			
		}
	}
}