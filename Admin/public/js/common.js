(function(exports){
    Common = {
        //需要支持级联选择，显示相应的子选项
        getMarktypeOptions: function(current, callback){
            var options = ['<option value="">-请选择-</option>'],
                createOptions = function(data, indent){
                    indent = indent || 0;
                    var indentStr = '';
                    //缩进可以使用padding-left实现,好处是选中后不需要额外处理名字里的空格
                    for(var i = 0; i < indent; i++) indentStr += '&nbsp;&nbsp;';
                    for(var _id in data){
                        var item = data[_id],
                            name = indentStr + item.name;
                        if(current == _id){
                            options.push('<option value="' + _id + '" selected="selected">' + name + '</option>');
                        }else{
                            options.push('<option value="' + _id + '">' + name + '</option>');
                        }
                        if(item['sub']) createOptions(item['sub'], indent + 2);
                    }
                };
            CHelper.asynRequest('/getMarktype.html', null, {
                before: function(xhr){},
                success: function(data){
                    if(typeof callback == 'function'){
                        //optgroup
                        createOptions(data);
                        callback(options.join(''));
                    }
                },
                failure: function(response){},
                refuse: function(response){},
                complete: function(status){},
                error: function(msg){}
            });
        },

        getSiteTypeOptions: function(cur, callback){
            var options = ['<option value="">-请选择-</option>'],
                data = [{id: 1, name: '区域'}, {id: 2, name: '建筑物'}];
            if(typeof callback == 'function'){
                for(var i in data){
                    var d = data[i];
                    if(d.id == cur){
                        options.push('<option value="' + d.id + '" selected="selected">' + d.name + '</option>');
                    }else{
                        options.push('<option value="' + d.id + '">' + d.name + '</option>');
                    }
                }
                callback(options.join(''));
            }
        },

        getDetailTypeOptions: function(cur, callback){
            var options = ['<option value="">-请选择-</option>'],
                data = [{id: 1, name: '自然'}, {id: 2, name: '历史'},
                        {id: 3, name: '人文'}, {id: 4, name: '商业'},
                        {id: 5, name: '生活'}];
            if(typeof callback == 'function'){
                for(var i in data){
                    var d = data[i];
                    if(d.id == cur){
                        options.push('<option value="' + d.id + '" selected="selected">' + d.name + '</option>');
                    }else{
                        options.push('<option value="' + d.id + '">' + d.name + '</option>');
                    }
                }
                callback(options.join(''));
            }
        },

        getParentsiteOptions: function(cur, lnglat, callback){
            var options = ['<option value="">-请选择-</option>'];
            CHelper.asynRequest('/site/parents.html', {lng: lnglat.lng, lat: lnglat.lat}, {
                before: function(xhr){},
                success: function(data){
                    if(typeof callback == 'function'){
                        for(var i in data){
                            var d = data[i];
                            if(cur == d.hashsiteid){
                                options.push('<option value="' + d.hashsiteid + '" selected="selected">' + d.name + '</option>');
                            }else{
                                options.push('<option value="' + d.hashsiteid + '">' + d.name + '</option>');
                            }
                        }
                        callback(options.join(''));
                    }
                },
                failure: function(response){},
                refuse: function(response){},
                complete: function(status){},
                error: function(msg){}
            });
        },

        geocoder: function(city, str, callback){ //北京市海淀区苏州街
            var MGeocoder;
            //加载地理编码插件
            AMap.service(['AMap.Geocoder'], function(){
                MGeocoder = new AMap.Geocoder({
                    city: city || '010', //城市，默认：全国
                    radius: 1000 //范围，默认：500
                });
                //返回地理编码结果
                MGeocoder.getLocation(str, function(status, result){
                    if(status === 'complete' && result.info === 'OK'){
                        if(typeof callback == 'function'){
                            callback(result);
                        }else{
                            console.info(result);
                        }
                    }
                });
            });
        },

        //http://lbs.amap.com/api/javascript-api/reference/search_plugin/#m_AMap.Geocoder
        //http://lbs.amap.com/api/javascript-api/example/p/1602-2/
        dGeocoder: function(lnglat, callback){ //new AMap.LngLat(116.396574,39.992706);
            var MGeocoder;
            AMap.service(['AMap.Geocoder'], function(){
                MGeocoder = new AMap.Geocoder({
                    radius: 1000,
                    extensions: 'all'
                });
                //逆地理编码
                MGeocoder.getAddress(lnglat, function(status, result){
                    if(status === 'complete' && result.info === 'OK'){
                        if(typeof callback == 'function'){
                            callback(result);
                        }else{
                            console.info(result);
                        }
                    }
                });
            });
        },

        getChildPlaceOptions: function(parentid, cur, callback){
            var options = ['<option value="">-请选择-</option>'];
            if($.isEmptyObject(parentid)){
                if(typeof callback == 'function') callback(options.join(''));
            }else{
                CHelper.asynRequest('/getplaces/' + parentid + '.html', null, {
                    before: function(xhr){},
                    success: function(data){
                        if(typeof callback == 'function'){
                            for(var _id in data){
                                var item = data[_id];
                                //id = item['_id']['$id'];
                                //pid = CHelper.isObject(item['pid']) ? item['pid'][$id];
                                if(cur == _id){
                                    options.push('<option value="' + _id + '" selected="selected">' +item.name + '</option>');
                                }else{
                                    options.push('<option value="' + _id + '">' + item.name + '</option>');
                                }
                            }
                            callback(options.join(''));
                        }
                    },
                    failure: function(response){},
                    refuse: function(response){},
                    complete: function(status){},
                    error: function(msg){}
                });
            }
        }
    };
})(window);