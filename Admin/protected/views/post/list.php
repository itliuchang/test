<p>&nbsp;</p>

<div class='row-fluid'>
	<div class='span12 box bordered-box' style='margin-bottom: 0;'>
		<div class='box-content box-no-padding'>
			<div class="responsive-table">
				<table id='data-table' class='display table table-bordered table-hover table-striped' cellspacing='0' width='100%' style='margin-bottom: 0;'>
					<thead>
						<tr>
							<th>帖子内容</th>
							<th>发帖人</th>
							<th>发帖时间</th>
							<th>喜欢数</th>
							<th>评论数</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<tr align="center"><td colspan='6'>正在加载...</td></tr>
					</tbody
				</table>
			</div>
		</div>
	</div>
</div>

<!-- tools model -->
<div id='modal-tools' class='modal hide fade' role='dialog' tabindex='-1'>
	<div class='modal-body'>
		<h4>确定执行该操作？</h4>
	</div>
	<div class='modal-footer'>
		<button class='btn cancel'>取消</button>
		<button class='btn btn-primary'>确定</button>
	</div>
</div>

<!-- view modal -->
<div id='viewModal' class='modal hide fade' role='dialog' tabindex='-1' style="width:700px">
	<div class='modal-header'>
		<button class='close' data-dismiss='modal' type='button'>&times;</button>
		<h3>订单详情</h3>
	</div>
    <div class='modal-body'>
    </div>
</div>

<!-- tools temp -->
<script id='toolTemplate' type='text/html'>
	<div class='text-left'>
		<a class='btn row-view btn-success btn-mini has-tooltip' _id='{{id}}' title='查看'> <i class='icon-eye-open'></i> </a>
		<a class='btn row-delete btn-danger btn-mini has-tooltip' _id='{{id}}' title='删除'> <i class='icon-trash'></i> </a>
	</div>
</script>

<script id='statusTemplate' type='text/html'>
	{{if status == 1 }}
		<span class='label label-success'>正常</span>
	{{/if}}
</script>

<?php
    $cs = Yii::app()->clientScript;
    $js = <<<STR
        $(function(){        	
        	var _table = $('#data-table').DataTable({
        		'ajax': {
               		'url' :'/post/list'
				},
		        'columns': [
					{'data': 'content', 'sDefaultContent':''},
		            {'data': 'userId', 'sDefaultContent':''},
		            {'data': 'createTime', 'sDefaultContent':''},
		            {'data': 'like_num', 'sDefaultContent':''},
		            {'data': 'comment_num', 'sDefaultContent':''},
		            {'data': 'status', 'sDefaultContent':''},
		            {'data': null},  
		        ],
		        'columnDefs': [
					{
                    	targets: 0,
                    	render: function (a, b, c, d) {
                    		var str = CHelper.stripTags(c.content);
							if(str.length >= 20) {
								return str.substring(0, 20) + '...';
							}
							return str;
                    	}
                    },
                    {
                    	targets: 2,
                    	render: function (a, b, c, d) {
                    		if(c.createTime)
                    			return c.createTime;
                    		return '';
                    	}
                    },
                	{
                    	targets: 5,
                    	render: function (a, b, c, d) {
                    		var data = {status:c.status};
                    		return template('statusTemplate', data);
                    	}
                    },		        
                	{
                    	targets: 6,
                    	render: function (a, b, c, d) {
                    		var data = {id:c.id,status:c.status,level: $('#level').val()};
                    		return template('toolTemplate',data);
                    	}
                    },
                ]
			});

			$('#data-table tbody').on('click','.btn', function(){
				var _this = $(this);
				if(_this.hasClass('row-delete')) {
					$('#modal-tools').attr({_id:_this.attr('_id'), type:'delete'}).modal('show');
				}else if(_this.hasClass('row-view')) {
					$('#viewModal').modal({
						remote: '/activity/view?id='+_this.attr('_id')
					}).on('hidden', function() {
    					$(this).removeData('modal');
					}).on('hidden.bs.modal', function() {
					    $(this).removeData('bs.modal');
					});
				}
			});
			
			$('#modal-tools .btn').click(function(){
				var _m = $('#modal-tools'), _id = _m.attr('_id'), type = _m.attr('type');
				if($(this).hasClass('cancel')) {
					_m.modal('hide');
					return;
				}
				
				if(type == 'delete') {
					CHelper.asynRequest('/post/delete', {id: _id}, {
						before: function(xhr){},
			            success: function(response){
			            	_table.ajax.reload();
			            },
			            failure: function(msg){
			                $.jGrowl('系统异常，请重试');
			            }
					});
				}
				_m.modal('hide')
			});
        });
STR;
    $cs->registerScript('product-list', $js, CClientScript::POS_END);
?>