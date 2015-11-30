<!DOCTYPE html>
<html>
<head>
    <title>YOYO-达人管理后台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />
    
    <link rel="shortcut icon" type="image/ico" href="/images/favicon.ico?v20150821" />
    <link href='/assets/all.css?20150824' media='all' rel='stylesheet' type='text/css' />
    
    <script type="text/javascript">
		var qiniuDomain = '<?php echo Yii::app()->params['partner']['qiniu']['domain'];?>'
    </script>
    
</head>

<body class='contrast-red'>
<header>
    <div class='navbar'>
        <div class='navbar-inner'>
            <div class='container-fluid'>
                <a class='brand' href='/' style='margin-left: 10px'>
                    <i class='yoyo-logo'></i>
                    <span class='hidden-phone'>悠游</span>
                </a>
                <a class='toggle-nav btn pull-left' href='#'>
                    <i class='icon-reorder'></i>
                </a>
                <ul class='nav pull-right'>
                    <!-- 消息通知 --> 
                    <li class='dropdown medium only-icon widget'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <i class='icon-rss'></i>
                            <div class='label'>0</div>
                        </a>
                        <ul class='dropdown-menu'>
                        	<!-- 
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-user text-success'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            	您有一个新订单 <small class='muted'>刚刚</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-inbox text-error'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            	新订单 <small class='muted'>3 分钟前</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-comment text-warning'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            	系统消息 <small class='muted'>1 小时前</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-user text-success'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            	系统通知 <small class='muted'>上周</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                             -->
                            <li class='widget-footer'>
                                <a href='#'>暂无消息</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- 用户信息 -->
                    <li class='dropdown dark user-menu'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <img alt='<?php echo Yii::app()->user->name ?>' height='23' src='<?php echo Yii::app()->user->portrait ?>' width='23' />
                            <span class='user-name hidden-phone'><?php echo Yii::app()->user->name ?></span>
                            <b class='caret'></b>
                        </a>
                        <ul class='dropdown-menu'>
                        	<?php if(2 === 2): ?>
                            <li>
                                <a href='/user/profile'><i class='icon-user'></i>&nbsp;&nbsp;个人资料</a>
                            </li>
                            <li class='divider'></li>
                            <?php endif;?>
                            <li>
                                <a href='/logout.html'><i class='icon-signout'></i>&nbsp;&nbsp;注销</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                
                <!-- 搜索  -->
                <form accept-charset="UTF-8" action="search_results.html" class="navbar-search pull-right hidden-phone" method="get" /><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
                    <button class="btn btn-link icon-search" name="button" type="submit"></button>
                    <input autocomplete="off" class="search-query span2" id="q_header" name="q" placeholder="Search..." type="text" value="" />
                </form>
            </div>
        </div>
    </div>
</header>

<input type='hidden' id='daren-role' value='<?php  ?>'/>
<div id='wrapper'>
	<div id='main-nav-bg'></div>
	<!-- MENU -->
	<nav class='' id='main-nav'>
		<div class='navigation'>
			<ul class='nav nav-stacked'>
				<li class='active'>
				    <a href='/'>
				        <i class='icon-dashboard'></i> <span>主页</span>
				    </a>
				</li>
				<li class=''>
				    <a href='/route/create'>
				        <i class=icon-plus></i> <span>创建产品</span>
				    </a>
				</li>
				<li class=''>
				    <a href='/route/list'>
				        <i class=icon-th></i> <span>产品管理</span>
				    </a>
				</li>				
				<li>
				    <a href='/order/list'>
				        <i class='icon-gift'></i> <span>订单管理</span>
				    </a>
				</li>
				<li>
				    <a href='/note/list'>
				        <i class='icon-book'></i> <span>达人日记</span>
				    </a>
				</li>
				<!-- 
				<li>
				    <a href='/poi/list'>
				        <i class='icon-briefcase'></i> <span>POI管理</span>
				    </a>
				</li>  -->
				<?php if(1 === 1): ?>
					<li>
					    <a href='/daren/list'>
					        <i class='icon-group'></i> <span>达人管理</span>
					    </a>
					</li>
                    <li>
                        <a class='dropdown-collapse ' href='#'>
                            <i class='icon-plane'></i> <span>渠道管理</span> <i class='icon-angle-down angle-down'></i>
                        </a>
                        <ul class='nav nav-stacked'>
                            <li class=''>
                                <a href='/channel/list'>
                                    <i class='icon-comments'></i> <span>渠道列表</span>
                                </a>
                            </li>
                            <li class=''>
                                <a href='/channel/user'>
                                    <i class='icon-envelope'></i> <span>渠道用户</span>
                                </a>
                            </li>
                            <li class=''>
                                <a href='/channel/order'>
                                    <i class='icon-pencil'></i> <span>渠道订单</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href='/activity/list'>
                            <i class='icon-list'></i> <span>活动管理</span>
                        </a>
                    </li>
					<li>
					    <a href='/user/list'>
					        <i class='icon-user'></i> <span>用户管理</span>
					    </a>
					</li>
                    <li>
                        <a href='/category/list'>
                            <i class='icon-user'></i> <span>分类管理</span>
                        </a>
                    </li>
				<?php endif;?>
				<li>
				    <a class='dropdown-collapse ' href='#'>
				        <i class='icon-cogs'></i> <span>系统设置</span> <i class='icon-angle-down angle-down'></i>
				    </a>
				    <ul class='nav nav-stacked'>
				        <li class=''>
				            <a href='#'>
				                <i class='icon-comments'></i> <span>消息</span>
				            </a>
				        </li>
				        <li class=''>
				            <a href='#'>
				                <i class='icon-envelope'></i> <span>地址薄</span>
				            </a>
				        </li>
				        <li class=''>
				            <a href='#'>
				                <i class='icon-pencil'></i> <span>资料修改</span>
				            </a>
				        </li>
				        <li class=''>
				            <a href='#'>
				                <i class='icon-list-alt'></i> <span>待办事项</span>
				            </a>
				        </li>
    				</ul>
				</li>
			</ul>
		</div>
	</nav>
	<!-- MENU END -->

	<!-- CONTENT -->
	<section id='content'>
		<?php echo $content ?>
	</section>
</div>

<!-- ModalBox -->
<div id="prompt" data-toggle="popover" data-container="#prompt" data-placement="top"></div>
      
<div class="modal fade" id="tipModal" role="dialog" data-type="success" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" data-verticalAlign="true">
		<div class="modal-content">
			<div class="modal-body">
				<div class="tip-form">
					<div class="hint">保存成功</div>
					<div class="icon"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--[if lt IE 9]>
<script src='assets/javascripts/html5shiv.js' type='text/javascript'></script>
<![endif]-->
<script src='/assets/all.js?2015082401' type='text/javascript'></script>

<script type="text/javascript" charset="utf-8" src="/library/baidu/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/library/baidu/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/library/baidu/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    $(function(){
       $('.navigation>li').click(function(){
            $('.navigation>ul>li').eq($(this).index()).addClass('active');
       });
    })
</script>

</body>
</html>