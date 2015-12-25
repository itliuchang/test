<p>&nbsp;</p>

<div class='row-fluid box'>
	<div class='span3'>
		<div class='box-content box-statistic'>
			<h3 class='title text-warning'><?php echo $count ?></h3>
			<small>总预约数</small>
			<div class='text-warning icon-user align-right'></div>
		</div>
	</div>

	<div class='span3'>
		<a href='/reservation/create'>
			<div class='box-content box-statistic' style="height: 50px;">
				<h4>新建预约</h4>
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
							<th>预约类型</th>
							<th>预约人</th>
							<th>所属中心</th>
							<th>预约时间</th>
							<th>结束时间</th>
							<th>创建时间</th>
							<th>会议室名称</th>
							<th>状态</th>
							<th>操作</th>	
						</tr>
					</thead>
					<tbody>
						<tr align="center"><td colspan="6">正在加载...</td></tr>
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

<!-- tools temp -->
<script id='toolTemplate' type='text/html'>
	<div class='text-left'>
		
		{{if status==1 && type==1}}
			<a class='btn row-edit btn-success btn-mini has-tooltip' _id='{{id}}' title='编辑'> <i class='icon-edit'></i> </a>
			<a class='btn row-confirm btn-primary btn-mini has-tooltip' _id='{{id}}' title='预约确认'> <i class='icon-check'></i> </a>
			<a class='btn row-cancel btn-danger btn-mini has-tooltip' _id='{{id}}' title='取消'> <i class='icon-remove'></i> </a>
		{{/if}}
	</div>
</script>

<!-- status  temp -->
<script id='statusTemplate' type='text/html'>
	{{if status == 0 }}
		<span class='label muted-background'>已取消</span>
	{{/if}}
	{{if status == 1 && type==1}}
		<span class='label purple-background'>预约中</span>
	{{/if}}
	{{if status == 2 || type==2}}
		<span class='label label-success'>预约成功</span>
	{{/if}}
	
</script>

<script id='statusFilterTemplate' type='text/html'>
	<select id='status_filter' style='float: right;margin-right: 20px;width: 120px;'>
		<option value=''>全部</option>
		<option value='1'>个人预定</option>
		<option value='2'>会议室预定</option>
	</select>
</script>

<?php
    $cs = Yii::app()->clientScript;
    $js = <<<STR
        $(function(){        	
        	var _table = $('#data-table').DataTable({
        		'ajax': {
               		'url' :'/reservation/list',
               		'data': function (d) {
        				d.type = $('#status_filter').val();
    				}
				},				
				'columns': [
		            {'data': 'type', 'sDefaultContent':''},
					{'data': 'user.nickName', 'sDefaultContent':''},
					{'data': 'hub.name', 'sDefaultContent':''},
		            {'data': 'startTime', 'sDefaultContent':''},
		            {'data': 'endTime', 'sDefaultContent':''},
		            {'data': 'createTime', 'sDefaultContent':''},
		            {'data': 'room.name', 'sDefaultContent':''},
		            {'data': 'status', 'sDefaultContent':''},
		            {'data': null},
		        ],
		        'columnDefs': [
					{
                    	targets: 0,
                    	render: function (a, b, c, d) {
                    		if(c.type==1){
                    			return '个人预定';
                    		}
                    		return '会议室预定';
                    		
                    	}
                    },		        
                	
                    {
                    	targets: 2,
                    	render: function (a, b, c, d) {
                    		return c.hub.name;                    		
                    	}
                    },
					{
                    	targets: 3,
                    	render: function (a, b, c, d) {
							if(c.startTime) {
            	        		return new Date(c.startTime).Format('yyyy-MM-dd hh:mm:ss');
							}
							return '';
                    	}
                    },
                    {
                    	targets: 4,
                    	render: function (a, b, c, d) {
							if(c.type==2) {
            	        		return new Date(c.endTime).Format('yyyy-MM-dd hh:mm:ss');
							}
							return '无';
                    	}
                    },
                    {
                    	targets: 5,
                    	render: function (a, b, c, d) {
							if(c.createTime) {
            	        		return new Date(c.createTime).Format('yyyy-MM-dd hh:mm:ss');
							}
							return '';
                    	}
                    },
                    {
                    	targets: 6,
                    	render: function (a, b, c, d) {
                    		if(c.room){
								return c.room.name;
                    		}
                    		return '';
                    	}
                    },
                    {
                    	targets: 7,
                    	render: function (a, b, c, d) {
                    		var data = {status:c.status,type:c.type};
                    		return template('statusTemplate', data);
                    	}
                    },
                	{
                    	targets: 8,
                    	render: function (a, b, c, d) {
                    		var data = {id:c.id,status:c.status,type:c.type,level: $('#level').val()};
                    		return template('toolTemplate', data);
                    	}
                    }
                ]
			});
			
			
			$('#data-table tbody').on('click','.btn', function(){
				var _this = $(this);
				if(_this.hasClass('row-edit')) {
					location.href = '/reservation/edit/'+_this.attr('_id');
				} else if(_this.hasClass('row-confirm')) {
					$('#modal-tools').attr({_id:_this.attr('_id'), type:'confirm'}).modal('show');
				}else if(_this.hasClass('row-cancel')) {
					$('#modal-tools').attr({_id:_this.attr('_id'), type:'cancel'}).modal('show');
				}else if(_this.hasClass('row-view')) {
					$('#viewModal').modal({
						remote: '/user/view?id='+_this.attr('_id')
					}).on('hidden', function() {
    					$(this).removeData('modal');
					}).on('hidden.bs.modal', function() {
					    $(this).removeData('bs.modal');
					});
				}
			});

			$('#data-table_filter').append(template('statusFilterTemplate', null));
			$('#data-table_filter').on('change', '#status_filter', function(){
				_table.ajax.reload();
			});
			
			$('#modal-tools .btn').click(function(){
				var _m = $('#modal-tools'), _id = _m.attr('_id'), type = _m.attr('type');
				if($(this).hasClass('cancel')) {
					_m.modal('hide');
					return;
				}
				if(type == 'cancel') {
					CHelper.asynRequest('/reservation/cancel', {id: _id}, {
						before: function(xhr){},
			            success: function(response){
			            	_table.ajax.reload();
			            },
			            failure: function(msg){
			                $.jGrowl('系统异常，请重试');
			            }
					});
				} else if(type == 'confirm') {
					CHelper.asynRequest('/reservation/confirm', {id: _id}, {
						before: function(xhr){},
			            success: function(response) {
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
    $cs->registerScript('user-list', $js, CClientScript::POS_END);
?>

