<?php
class OrderController extends Controller{
	public $pageTitle ="Order";
	public function actionIndex(){
		if(!Yii::app()->request->isAjaxRequest){
			if(Yii::app()->user->isGuest){
				$userId = Yii::app()->session['user']['id'];
			}else{
				$userId = Yii::app()->user->id;
			}
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
        $user = User::model()->findByAttributes(array('id'=>$userId));
        $date = strtotime($user->deadDate)<strtotime(date('Ymd'))?date('U'):strtotime($user->deadDate);
		$wechat = Yii::app()->params['partner']['wechat'];
		$order = new COrder;
		$orderId = $order->create(array('productId'=>$productType,'userId'=>$userId,'type'=>1,'price'=>$productPrice,'orderTime'=>date('YmdHis')));
		$orderId = $orderId['data']['orderId'];
		$times = Yii::app()->db->createCommand()->setText('select times from product where status!=0 and id='.$productType)->queryRow();
        for($i = 0;$i<$productNum;$i++){
			$rtuorder = $order->createProduct(array('orderId'=>$orderId,'totalTimes'=>$times['times'],'usedTimes'=>0  ,'startDate'=>date('Ymd',$date),'endDate'=>date('Ymd',$date+Assist::timestampToMonthTimestamp($date)-86400)));
			$date = $date+Assist::timestampToMonthTimestamp($date);
		}
        $input = new WxPayUnifiedOrder();
        $input->SetBody($productName);
        $input->SetAttach(date('Ymd',$date));
        $input->SetOut_trade_no((string)$orderId);
        $input->SetTotal_fee($productPrice*$productPrice/100);
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

	public function actionCompany(){
		try{
			$list = Yii::app()->user->orderlist;
			$date = Yii::app()->user->orderdate;
			$months = Yii::app()->user->ordermonths;
		}catch(Exception $e){
			echo 'fail';die;
		}
		if(Yii::app()->user->isGuest){
			$userId = Yii::app()->session['user']['id'];
		}else{
			$userId = Yii::app()->user->id;
		}
		$wechat = Yii::app()->params['partner']['wechat'];
		$jsapi = new WxJsPayHelper();
        $openid = $jsapi->GetOpenid();
		$this->bodyCss='orderDetail';
		$totalPrice=0;
		foreach($list as &$value){
			$product = CompanyProduct::model()->findByAttributes(array('id'=>$value['id']));
			$value['name']=$product->name;
			$value['price']=$product->price;
			$value['type']=$product->type;
			$totalPrice=$totalPrice+$value['price']*$value['num'];
		}
		$order = new COrder;
		$newOrder = $order->create(array('userId'=>$userId,'type'=>2,'price'=>$totalPrice,'orderTime'=>date('YmdHis'),'hubId'=>1));
		$orderId = $newOrder['data']['orderId'];
		$endDate = date('Y-m-d',strtotime($date)+(date('t',strtotime($date))-1)*$months*60*60*24);
		foreach($list as $v){
			$companyProduct = $order->createCompanyProduct(array('cproductId'=>$v['id'],'startDate'=>$date,'endDate'=>$endDate,'orderId'=>$orderId,'num'=>$v['num']));
			Coding::makeCode(array('userId'=>$userId,'type'=>$v['type'],'startDate'=>$date,'endDate'=>$endDate,'times'=>$v['num'],'ordercompanyProductId'=>$companyProduct['data']['id']));
		}
		$input = new WxPayUnifiedOrder();
        $input->SetBody('Company product');
        // $input->SetAttach(date('Ymd',$date));
        $input->SetOut_trade_no((string)$orderId);
        $input->SetTotal_fee($totalPrice/1000);
        $input->SetTime_start(date('YmdHis'));
        $input->SetTime_expire(Assist::getOrderExpireTime(time()));
        $input->SetProduct_id(1);
        $input->SetNotify_url('http://hubapp.livenaked.com' . $wechat['payment']['notify']);
        $input->SetTrade_type('JSAPI');
        $input->SetOpenid($openid);
        Yii::log(print_r($input->values,1), CLogger::LEVEL_ERROR,'input');
        $bill = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $jsapi->GetJsApiParameters($bill);
		$this->render('company',array('list'=>$list,'date'=>$date,'months'=>$months,'totalPrice'=>$totalPrice,'jsparams' => $jsApiParameters));
	}
	public function actionNotify(){
		Yii::log($GLOBALS['HTTP_RAW_POST_DATA'], CLogger::LEVEL_ERROR, 'heeh');
    	$notify = new WxJSPayNotifyHelper();
        $notify->Handle(false);

	}

	public function actionSuccess(){
		$this->render('ok');
	}
	public function actionCancel(){
		$this->render('cancel');
	}
	public function actionError(){
		$this->render('error');
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

	public function actionCreateCompanySession(){
		 if(Yii::app()->request->isAjaxRequest){
		 	try{
		 		Yii::app()->user->setState('orderlist',Yii::app()->request->getParam('list'));
		 		Yii::app()->user->setState('orderdate',Yii::app()->request->getParam('date'));
		 		Yii::app()->user->setState('ordermonths',Yii::app()->request->getParam('month'));
		 	}catch(Exception $e){
		 		echo CJSON::encode(array(
				'code' => 500,
				'mes' => 'fail'
			));
				return;
		 	}
		 	echo CJSON::encode(array(
				'code' => 200,
				'mes' => 'success',
			));
		 }
	}
}