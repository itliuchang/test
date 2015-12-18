<div id="orderDetail">
	<h2 class="title">MEMBERSHIP SUMMARY</h2>
	<div class="content">
		<?php for($i=0,$date=date("U");$i<$num;$i++): ?>
		<div class="month">
			<p class="memberType">Membership</p>
			<h2><?php echo $name ?></h2>
			<p class="date"><?php echo date("Y/m/d",$date) ?>-<?php echo date("Y/m/d",$date+2505600);$date = $date + 2592000;  ?></p>
			<div class="price"><h3>&yen;<?php echo $price ?></h3>/month</div>
		</div>
		<?php endfor; ?>
		<div class="day">
			<h2>Total</h2>
			<h3 class="price">&yen;<?php echo $num*$price ?></h3>
		</div>
	</div>
	<div class="agree"><div class="icon hasAgree"></div><p>I have read and understood the <a href="#">Terms & Conditions</a> of naked Hub and hereby agree to fully abide by them</p></div>
	<a class="footer" href="">Wechat Pay</a>
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
                    location.href = 'http://www.baidu.com';
                }else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
                    location.href = 'http://www.taobao.com';
                }else{ //get_brand_wcpay_request:fail
                    location.href = 'http://www.taobao.com';
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