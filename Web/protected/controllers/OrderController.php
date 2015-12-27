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
		$jsapi = new WxJsPayHelper();
        $openid = $jsapi->GetOpenid();
        $user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
        $date = strtotime($user->deadDate)<strtotime(date('Ymd'))?date('U'):strtotime($user->deadDate);
		$wechat = Yii::app()->params['partner']['wechat'];
		$order = new COrder;
		$orderId = $order->create(array('productId'=>$productType,'userId'=>Yii::app()->user->id,'price'=>$productPrice,'orderTime'=>date('YmdHis')));
		$orderId = $orderId['data']['orderId'];
		$times = Yii::app()->db->createCommand()->setText('select times from product where status!=0 and id='.$productType)->queryRow();
        for($i = 0;$i<$productNum;$i++){
			$rtuorder = $order->createProduct(array('orderId'=>$orderId,'totalTimes'=>$times['times'],'usedTimes'=>0  ,'startDate'=>date('Ymd',$date),'endDate'=>date('Ymd',$date+2505600)));
			$date = $date+2592000;
		}
        $input = new WxPayUnifiedOrder();
        $input->SetBody($productName);
        $input->SetAttach(date('Ymd',$date));
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

	public function actionCreateSession(){
		if(Yii::app()->request->isAjaxRequest){
			try{
				Yii::app()->user->setState('productType',Yii::app()->request->getParam('type'));
				Yii::app()->user->setState('productName' , Yii::app()->request->getParam('name'));
				Yii::app()->user->setState('productNum' , Yii::app()->request->getParam('num'));
				Yii::app()->user->setState('productPrice' , Yii::app()->request->getParam('price'));
			}catch(Exception $e){
				print_r($e);die;
				echo CJSON::encode(array(
				'code' => 500,
				'mes' => 'fail'
			));
				return;
			}
			echo CJSON::encode(array(
				'code' => 200,
				'mes' => 'success'
			));
			
		}
	}
}