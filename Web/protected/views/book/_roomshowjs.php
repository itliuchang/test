$(function(){
	var tmp='';
	for(var i=0;i<14;i++){
		tmp += '<option value='+i*2+'>'+(9+i)+':00</option><option value="'+(i*2+1)+'">'+(9+i)+':30'; 
	}
	$('.starts').append(tmp);
	var option = eval($('.option input[name="other"]').attr("data-other"))
	$('.starts option').each(function(){
		for(var m in option){
			if($(this).val()==option[m])
				$(this).attr({disabled: 'disabled',});
		}
	})
	

	for(var i = 0;i < $('.option').length;i++){
		my = eval($('.option:eq('+i+') input[name="my"]').attr("data-my"));
		if(my=='')
		continue;
		my.forEach(function(v){
			$('.option:eq('+i+') .piece').eq(v).addClass('myselected fix');
		});
	}
		
	for(var i = 0;i < $('.option').length;i++){
		other = eval($('.option:eq('+i+') input[name="other"]').attr("data-other"));
		if(other=='')
		continue;
		other.forEach(function(v){
			$('.option:eq('+i+') .piece').eq(v).addClass('selected');
		});
	}	
	
	var  option = eval($('.option input[name="my"]').attr("data-my"))
	$.each(option,function(){
		$('.starts')
	});

	var selectime = '';
	$('.date').change(function(){
		var date = $(this).val();
		selectime = new Date(date).getTime();
		var id = $('input[name="id"]').val();
		CHelper.asynRequest('/book/roomshow-'+id,{
				"date":date,
			},{
				error:function(xhr,msg){
					console.log(xhr)
				},
				success:function(response){
					// other = response['other']
					var option = eval($('.option input[name="other"]').attr("data-other"));
					$('.starts option').each(function(){
						for(var m in option){
							if($(this).val()==option[m])
								$(this).attr({disabled: false});
						}

						for(var n in response['other']){
							if($(this).val()==response['other'][n])
								$(this).attr({disabled:'disabled'});
						}
					})
					$('.option input[name="other"]').attr("data-other",response['other'])
					$('.option input[name="my"]').attr("data-my",response['my'])
					$('.piece').removeClass('myselected').removeClass('selected fix');
					for(var i = 0;i < $('.option').length;i++){
						my = eval(response['my']);
						if(my=='')
						continue;
						my.forEach(function(v){
							$('.option:eq('+i+') .piece').eq(v).addClass('myselected fix');
						});
					}
		
					for(var i = 0;i < $('.option').length;i++){
						other = eval(response['other']);
						if(other=='')
						continue;
						other.forEach(function(v){
							$('.option:eq('+i+') .piece').eq(v).addClass('selected');
						});
					}
				}
		});
	});

	var last=''

	$('.starts').change(function(){
		var start=$(this).val();		
		$('.times').change(function(){			
			if(last!='')
			last.forEach(function(v){
				$('.option .piece').eq(v).removeClass('myselected')
			});
			var num = start,
			time = $(this).val()
			if(start!=''){
				var length = time/0.5;
				var array=[];
				if(length!=0){
					for(var n=0;n<length;n++){
						array.push(num++);
					}
				} else {
					array=[num]
				}console.log(other);
				var x=eval($('.option input[name="other"]').attr("data-other"));
				var result='';
				for(var b in array){
					for(var a in x){
						if(x[a]===array[b]){
							result='false'
							break;
						} 

					}
				}
				if(result=='false'){
					CHelper.toggleTip('show', '和别人的时间有冲突，请重选', 'error',1800);
				} else{
					array.forEach(function(v){
						$('.option .piece').eq(v).addClass('myselected');
					})
					last=array
				}
			}
		})
	});
	
	$('.submit').hammer().on('tap',function(e){
		e.gesture.srcEvent.preventDefault();
		var starts = $('.starts option:selected').text(),
			id = $('input[name="id"]').val(),
			hubId = $('input[name="hubid"]').val(),
			time = $('.times option:selected').val(),
			date = $('.date').val(),
			start = $('.starts').val();
		if(starts=='无' || time=='' || date==''){
			CHelper.toggleTip('show', '你还没有选择时间', 'warn', 1800);
		}else {
			CHelper.asynRequest('/book/roomshow-'+id,{
				"date":date,
			},{
				error:function(){
					CHelper.toggleTip('show','error','warn',1000);
				},
				success:function(response){
					var num = start;
					if(start!=''){
						var length = time/0.5;
						var array=[];
						if(length!=0){
							for(var n=0;n<length;n++){
								array.push(num++);
							}
						} else {
							array=[num]
						}
						var x=eval(response['other']);
						var result='';
						for(var b in array){
							for(var a in x){
								if(x[a]===array[b]){
									result='false'
									break;
								} 
							}
						}
						if(result=='false'){
							CHelper.toggleTip('show', '时间和别人有冲突', 'error',1800);
							x.forEach(function(v){
								$('.option .piece').eq(v).removeClass('myselected');
							})
						} else {
							CHelper.asynRequest('/book/commitroomreservation',{
									"id":id,
									"starts":starts,
									"hour":time,
									"date":date,
									"hubId":hubId
								},{
									before:function(xhr){
										CHelper.toggleTip('show', '创建预约中..', 'loader');
									},
									error:function(msg){
										CHelper.toggleTip('show', msg , 'error', 1000);
									},
									success:function(){
										CHelper.toggleTip('show','预约成功,2s后跳转','success',2000);
										setInterval(function(){
											location.href = '/more';
										},2000);
									}
								});
						}							
					}
				}
			});			
		}
	});
});