<p>&nbsp;</p>
<div class='row-fluid box'>
	<div class='span2'>
		<div class='box-content box-statistic'>
			<h3 class='title text-info'><?php echo $count?></h3>
			<small>总产品数</small>
			<div class='text-info icon-inbox align-right'></div>
		</div>
	</div>
	
	<div class='span3'>
		<a href='/route/create'>
			<div class='box-content box-statistic' style="height: 50px;">
				<h4>新建产品</h4>
				<div class='text-error icon-plus align-right'></div>
			</div>
		</a>
	</div>
</div>

<div class='row-fluid'>
	<div class='span12 box bordered-box' style='margin-bottom: 0;'>
		<div class='box-content box-no-padding'>
			<div class="responsive-table">
				<table id='data-table' class='display table table-bordered table-hover table-striped' cellspacing='0' width='100%' style='margin-bottom: 0;'>
					<thead>
						<tr>
							<th>产品ID</th>
							<th>产品名称</th>
							<th>产品价格</th>
							<th>次数</th>
							<th>创建时间</th>
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
<div id='viewModal' class='modal hide fade' role='dialog' tabindex='-1'>
	<div class='modal-header'>
		<button class='close' data-dismiss='modal' type='button'>&times;</button>
		<h3>用户详情</h3>
	</div>
    <div class='modal-body'>
    </div>
</div>

<!-- tools temp -->
<script id='toolTemplate' type='text/html'>
	<div class='text-left'>
		{{if level = 1 }}
			<a class='btn row-edit btn-success btn-mini has-tooltip' _id='{{id}}' title='编辑'> <i class='icon-edit'></i> </a>
			<a class='btn row-delete btn-danger btn-mini has-tooltip' _id='{{id}}' title='删除'> <i class='icon-trash'></i> </a>
		{{/if}}
	</div>
</script>

<script id='statusTemplate' type='text/html'>
	{{if status == 1 }}
		<span class='label label-success'>正常</span>
	{{/if}}
	{{if status == 2 }}
		<span class='label label-info'>不可用</span>
	{{/if}}
</script>

<?php
    $cs = Yii::app()->clientScript;
    $js = <<<STR
        $(function(){        	
        	var _table = $('#data-table').DataTable({
        		'ajax': {
               		'url' :'/route/list'
				},
		        'columns': [
					{'data': 'id', 'sDefaultContent':''},
		            {'data': 'name', 'sDefaultContent':''},
		            {'data': 'price', 'sDefaultContent':''},
		            {'data': 'times', 'sDefaultContent':''},
		            {'data': 'createTime', 'sDefaultContent':''},
		            {'data': 'status', 'sDefaultContent':''},
		            {'data': null},  
		        ],
		        'columnDefs': [
					{
                    	targets: 2,
                    	render: function (a, b, c, d) {
							return c.price+'/月';
                    	}
                    },
					{
                    	targets: 3,
                    	render: function (a, b, c, d) {
                    		return c.times+'次/月';
                    	}
                    },
                    {
                    	targets: 4,
                    	render: function (a, b, c, d) {
                    		if(c.createTime){
                    			return new Date(c.createTime).Format('yyyy-MM-dd hh:mm:ss');
                    		}
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
				if(_this.hasClass('row-edit')) {
					location.href = '/route/edit/'+_this.attr('_id');
				} else if(_this.hasClass('row-delete')) {
					$('#modal-tools').attr({_id:_this.attr('_id'), type:'delete'}).modal('show');
				} else if(_this.hasClass('row-view')) {
					$('#viewModal').modal({
						remote: '/route/view?id='+_this.attr('_id')
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
					CHelper.asynRequest('/route/delete', {id: _id}, {
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