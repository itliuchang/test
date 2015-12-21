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
		if(Yii::app()->user->productCreate == 0){
		$wechat = Yii::app()->params['partner']['wechat'];
		$order = new COrder;
		$orderId = $order->create(array('productId'=>$productType,'userId'=>Yii::app()->user->id,'price'=>$productPrice,'orderTime'=>date('YmdHis')));
		$orderId = $orderId['data']['orderId'];
		Yii::app()->user->setState('productCreate',1);
		$jsapi = new WxJsPayHelper();
        $openid = $jsapi->GetOpenid();
        $input = new WxPayUnifiedOrder();
        $input->SetBody($productName);
        $input->SetOut_trade_no((string)$orderId);
        $input->SetTotal_fee($productPrice*$productNum);
        $input->SetTime_start(date('YmdHis'));
        $input->SetTime_expire(Assist::getOrderExpireTime(time()));
        $input->SetProduct_id($productType);
        $input->SetNotify_url('http://hubapp.livenaked.com' . $wechat['payment']['notify']);
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
	}
	public function actionNotify(){
		Yii::log($GLOBALS['HTTP_RAW_POST_DATA'], CLogger::LEVEL_ERROR, 'heeh');
    	$notify = new WxJSPayNotifyHelper();
        $notify->Handle(false);

	}
}