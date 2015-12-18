<?php
class OrderController extends Controller{
	public function actionIndex(){

		$productType = Yii::app()->request->getParam('type');
		$productName = Yii::app()->request->getParam('name');
		$productNum = Yii::app()->request->getParam('num');
		$productPrice = Yii::app()->request->getParam('price');
		$jsapi = new WxJsPayHelper();
        $openid = $jsapi->GetOpenid();
        $input = new WxPayUnifiedOrder();
        $input->SetBody('start');
        $input->SetAttach('naked');
        $input->SetOut_trade_no('fsfd3424');
        $input->SetTotal_fee(1);
        $input->SetTime_start(date('YmdHis'));
        $input->SetTime_expire('20151230091010');
        $input->SetProduct_id('12235413214070356458058');
        $input->SetNotify_url(Yii::app()->request->getHostInfo() . $wechat['payment']['notify']);
        $input->SetTrade_type('JSAPI');
        $input->SetOpenid($openid);
        $bill = WxPayApi::unifiedOrder($input);
        try{
            $jsApiParameters = $jsapi->GetJsApiParameters($bill);
       	    Yii::log(print_r($jsApiParameters,1), CLogger::LEVEL_ERROR)
        }catch(Exception $e){
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
        }
		$this->bodyCss='orderDetail';
		$this->render('index',array(
				'type' => $productType,
				'name' => $productName,
				'num' => $productNum,
				'price' => $productPrice,
				'jsparams' => $jsApiParameters,
			));
	}
}