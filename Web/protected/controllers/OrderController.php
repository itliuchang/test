<?php
class OrderController extends Controller{
	public function actionIndex(){

		$productType = Yii::app()->user->productType;
		$productName = Yii::app()->user->productName;
		$productNum = Yii::app()->user->productNum;
		$productPrice = Yii::app()->user->productPrice;
		$jsapi = new WxJsPayHelper();
        $openid = $jsapi->GetOpenid();
        $input = new WxPayUnifiedOrder();
        $input->SetBody($productName);
        $input->SetOut_trade_no((string)rand(100000,9000000));
        $input->SetTotal_fee($productPrice*$productNum*100);
        $input->SetTime_start(date('YmdHis'));
        $input->SetTime_expire('20151230091010');
        $input->SetProduct_id((string)rand(100000,9000000));
        $input->SetNotify_url(Yii::app()->request->getHostInfo() . $wechat['payment']['notify']);
        $input->SetTrade_type('JSAPI');
        $input->SetOpenid($openid);
        $bill = WxPayApi::unifiedOrder($input);
        try{
            $jsApiParameters = $jsapi->GetJsApiParameters($bill);
       	    Yii::log(print_r($jsApiParameters,1), CLogger::LEVEL_ERROR);
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