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

	$('.date').change(function(){
		var date = $(this).val(),
			id = $('input[name="id"]').val(),
			hub = $('input[name="hubid"]').val();
		CHelper.asynRequest('/book/roomshow-'+id,{
				"date":date,
				"hub":hub
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

	var last='',
		start='',
		time='';
	$('.starts').change(function(){
		start=$(this).val();		
		if(last!='')
			last.forEach(function(v){
				$('.option .piece').eq(v).removeClass('myselected')
			});
			var num = start;
			// time = $(this).val()
			if(time!=''){
				var length = time/0.5;
				var array=[];
				if(length!=0){
					for(var n=0;n<length;n++){
						array.push(num++);
					}
				} else {
					array=[num]
				}
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
					CHelper.toggleTip('show', 'Time choice conflict with others', 'error',1800);
				} else{
					array.forEach(function(v){
						$('.option .piece').eq(v).addClass('myselected');
					})
					last=array
				}
			}
	});
	$('.times').change(function(){			
			if(last!='')
			last.forEach(function(v){
				$('.option .piece').eq(v).removeClass('myselected')
			});
			var num = start;
			time = $(this).val();
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
					CHelper.toggleTip('show', 'Time choice conflict with others', 'error',1800);
				} else{
					array.forEach(function(v){
						$('.option .piece').eq(v).addClass('myselected');
					})
					last=array
				}
			}
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
			CHelper.toggleTip('show', 'You should choose time', 'warn', 1800);
		}else {
			CHelper.asynRequest('/book/roomshow-'+id,{
				"date":date,
				"hub":hubId
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
							CHelper.toggleTip('show', 'Time choice conflict with others', 'error',1800);
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
										CHelper.toggleTip('show', 'Creating...', 'loader');
									},
									error:function(msg){
										CHelper.toggleTip('show', msg , 'error', 1000);
									},
									success:function(){
										CHelper.toggleTip('show','SUCCESS','success',2000);
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