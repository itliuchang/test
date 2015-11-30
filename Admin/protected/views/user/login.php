<link rel="stylesheet" type="text/css" href="/css/login.css" />

<ul class="cb-slideshow">
    <li><span>Image 01</span><div><h3>re·lax·a·tion</h3></div></li>
    <li><span>Image 02</span><div><h3>qui·e·tude</h3></div></li>
    <li><span>Image 03</span><div><h3>use·fu·lne·ss</h3></div></li>
    <li><span>Image 04</span><div><h3>e·qua·nim·i·ty</h3></div></li>
    <li><span>Image 05</span><div><h3>com·po·sure</h3></div></li>
    <li><span>Image 06</span><div><h3>lo·vel·i·ne·ss</h3></div></li>
</ul>

<div class="modal fade" id="loginModal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content"> 
        	<div class="modal-header">
	        	<ul id="loginTab" class="nav nav-tabs">
				   <li><a href="#account" data-toggle="tab">帐号登录</a></li>
				</ul>
			</div>
			<div class='tab-content'>
				<div id='account' class='tab-pane fade active in'>	
		        	<div class="modal-body">
		                <div class="form-group">
		                    <input type="text" class="form-control username" placeholder="用户名">
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control password" placeholder="密码">
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default">登录</button>
		            </div>    
		        </div>
            </div>
        </div>
    </div>
</div>

<script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_js', null ,true);
    $cs->registerScript('login', $js, CClientScript::POS_END);
?>