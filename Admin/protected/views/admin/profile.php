<div class='page-header'>
	<h1 class='pull-left'>
		<i class='icon-user'></i> <span>管理员-资料管理</span>
	</h1>
	<div class='span2 pull-right'>
		<a href='/admin/create'>
			<div class='box-content box-statistic' style="height: 30px;">
				<h4 style="margin-top: 10px">新增管理员</h4>
				<span class='text-error icon-plus align-right'></span>
			</div>
		</a>
	</div>
</div>

<?php require_once 'list.php';?>

<?php
    $cs = Yii::app()->clientScript;
    $js = <<<STR
        $(function(){
			$('#view_daren_info').click(function(){
				var modal = $('#viewModal'), frame = modal.find('.modal-body iframe');
				frame.html('');
				frame.attr('src', 'http://www.yoyoplay.cn/m/daren-'+$(this).attr('_id'));
				modal.modal('show');
			});

			
        });
STR;
    $cs->registerScript('user-profile', $js, CClientScript::POS_END);
?>
