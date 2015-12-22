<?php
class OrderController extends Controller{
	public function actionIndex(){
		if(!Yii::app()->request->isAjaxRequest){
		try{
			$productType = Yii::app()->user->productType;
			$productName = Yii::app()->user->productName;
			$productNum = Yii::app()->user->productNum;
			$productPrice = Yii::app()->user->productPrice;
		}catch(CException $e){
			echo '订单创建失败';die;
		}
		if(Yii::app()->request->getParam('code')){
			$wechat = Yii::app()->params['partner']['wechat'];
			$order = new COrder;
			$orderId = $order->create(array('productId'=>$productType,'userId'=>Yii::app()->user->id,'price'=>$productPrice,'orderTime'=>date('YmdHis')));
			$orderId = $orderId['data']['orderId'];
		};
		$jsapi = new WxJsPayHelper();
        $openid = $jsapi->GetOpenid();
        $input = new WxPayUnifiedOrder();
        $input->SetBody($productName);
        $input->SetAttach($productNum);
        $input->SetOut_trade_no((string)$orderId);
        $input->SetTotal_fee($productPrice*$productNum);
        $input->SetTime_start(date('YmdHis'));
        $input->SetTime_expire(Assist::getOrderExpireTime(time()));
        $input->SetProduct_id($productType);
        $input->SetNotify_url('http://hubapp.livenaked.com' . $wechat['payment']['notify']);
        $input->SetTrade_type('JSAPI');
        $input->SetOpenid($openid);
        $bill = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $jsapi->GetJsApiParameters($bill);
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
	public function actionNotify(){
		Yii::log($GLOBALS['HTTP_RAW_POST_DATA'], CLogger::LEVEL_ERROR, 'heeh');
    	$notify = new WxJSPayNotifyHelper();
        $notify->Handle(false);

	}
}