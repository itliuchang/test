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
        $input->SetBody('start');
        $input->SetAttach('naked');
        $input->SetOut_trade_no('fsfdfsdfs4');
        $input->SetTotal_fee(1);
        $input->SetTime_start(date('YmdHis'));
        $input->SetTime_expire('20151230091010');
        $input->SetProduct_id('12235413214070556458054');
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