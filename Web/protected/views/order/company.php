<div id="orderDetail">
	<h2 class="title">MEMBERSHIP SUMMARY</h2>
	<h3 class="companydate"><?php echo str_replace('-','/', $date) ?> - <?php echo date('Y/m/d',strtotime($date)+(date('t',strtotime($date))-1)*$months*60*60*24) ?></h3>
	<h3 class="location">Location:Fuxing</h3>
	<div class="content">
		<?php foreach($list as $value): ?>
		<div class="companyopt">
			<h2><?php echo $value['name'] ?></h2>
			<div class="num">X<?php echo $value['num'] ?><p>avaliable</p></div>
			<div class="price"><h3>&yen;<?php echo $value['price'] ?></h3></div>
		</div>
		<?php endforeach; ?>
		<div class="day companytotal">
			<h2>Total</h2>
			<h3 class="price">&yen;<?php echo $totalPrice ?></h3>
		</div>
	</div>
	<div class="agree"><div class="icon hasAgree"></div><p>I have read and understood the <a href="#">Terms & Conditions</a> of naked Hub and hereby agree to abide by them.</p></div>
	<div class="footer">Wechat Pay</div>
</div>
<script type="text/javascript">
    function jsApiCall(){
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsparams ?>,
            function(res){
                WeixinJSBridge.log(res.err_msg);
                // alert(res.err_code+res.err_desc+res.err_msg);
                // alert('支付结果:'+res.err_code+','+res.err_desc+','+res.err_msg);
                if(res.err_msg == 'get_brand_wcpay_request:ok'){
                    //跳转到支付成功页
                    // location.href = location.protocol + '//' + location.host + '/payment/wxpay/result-ok.html';
                    location.href = '/order/success';
                }else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
                    location.href = '/order/cancel';
                }else{ //get_brand_wcpay_request:fail
                    location.href = '/order/error';
                }
            }
        );
    }

    function callpay(){
        if (typeof WeixinJSBridge == "undefined"){
            if(document.addEventListener){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if(document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }
</script>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_js', null ,true);
    $cs->registerScript('order', $js, CClientScript::POS_END);
?>