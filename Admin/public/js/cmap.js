(function(exports){
    var CMap = function(id, options){
        var self = this,
            defaultOptions = {
                markerIcon: '/images/marker.png'
            };
        this.options = options = $.extend(defaultOptions, options || {});

        var map = new AMap.Map(id, {
            resizeEnable: options.resizeEnable || false,
            rotateEnable: options.rotateEnable || false,
            // keyboardEnable: false,
            view: new AMap.View2D({
                crs: options.crs || 'EPSG3857',
                zoom: options.zoom || 18
            }),
            lang: options.lang || 'zh_cn'
        });

        //地图类型切换
        map.plugin(['AMap.MapType'], function(){
            var type = new AMap.MapType({defaultType: 0});
            map.addControl(type);
        });

        //添加ToolBar
        map.plugin(['AMap.ToolBar'],function(){
            var toolBar = new AMap.ToolBar();
            map.addControl(toolBar);
        });

        if(options.isGPS){
            //浏览器定位
            map.plugin('AMap.Geolocation', function(){
                var geolocation = new AMap.Geolocation({
                    enableHighAccuracy: true,
                    timeout: 10000,
                    showMarker: true,
                    showCircle: false
                });
                map.addControl(geolocation);

                AMap.event.addListener(geolocation, 'complete', function(data){
                    $('#tip').html(
                        '<div class="info">' +
                        '<div class="title">定位成功</div>' +
                        '<div>经度：' + data.position.getLng() + '</div>' +
                        '<div>纬度：' + data.position.getLat() + '</div>' +
                        '<div>精度：' + data.accuracy + '</div>' +
                        '<div>是否经过偏移：' +  (data.isConverted ? '是' : '否') + '</div>' +
                        '</div>'
                    ).show();
                });

                AMap.event.addListener(geolocation, 'error', function(data){
                    var str = '';
                    switch(data.info){
                        case 'PERMISSION_DENIED': str = '浏览器阻止了定位操作';break;
                        case 'POSITION_UNAVAILBLE': str = '无法获得当前位置';break;
                        case 'TIMEOUT': str = '定位超时';break;
                        default: str = '未知错误';
                    }
                    $('#tip').html(
                        '<div class="error">' +
                        '<div class="title">定位失败</div>' +
                        '<div>' + str + '</div>' +
                        '</div>'
                    ).show();
                });

                geolocation.getCurrentPosition();
                //geolocation.watchPosition();
            });
        }

        //覆盖物集合
        this.coordinates = {};
        //拾取的当前坐标集合，闭合后需要clear
        this.coordinate = {};
        //监听地图的click事件并记录下坐标及marker
        this.clickEventListener = AMap.event.addListener(map,'click',function(e){
            // var marker = new AMap.Marker({map: this, position: e.lnglat}); //this = map
            var id = CHelper.getID(e.lnglat, 'point', 'lnglat'),
                marker = self.addMarker(id, e.lnglat.getLng(), e.lnglat.getLat());
            
            // self.coordinate[id] = {marker: marker, lnglat: e.lnglat};
            // self.coordinate[id] = {marker: marker, point: e.lnglat};
            self.coordinate[id] = marker;
            // 页面业务逻辑处理
            if(typeof options.clickCallBack == 'function') options.clickCallBack(marker);
        });

        this.searchData = {}; //搜索保存的info及marker
        this.map = map;
    };

    CMap.prototype = {
        addPolygon: function(){
            var _this = this,
                id = CHelper.getID(this.coordinate, 'polygon', 'polygon'),
                markers = this.coordinate,
                data = this.getLnglats(true),
                polygon = new AMap.Polygon({
                    path: data, //边界路径
                    strokeColor: '#F77E8E', //线颜色
                    strokeOpacity: 0.2, //线透明度
                    strokeWeight: 2,    //线宽
                    fillColor: '#FCD5DA', //填充色
                    fillOpacity: 0.35, //填充透明度
                    extData: {id: id, markers: markers, type: 'polygon'}
            });
            var center = this.getGravityCenter(polygon);
            polygon.setExtData($.extend({center: center}, polygon.getExtData()));
            polygon.setMap(this.map);
            AMap.event.addListener(polygon, 'click', function(e){
                if(typeof _this.options.overlayClickCallback == 'function')
                    _this.options.overlayClickCallback(this);
            });
            AMap.event.addListener(polygon, 'mouseover', function(e){ //鼠标经过
                if(typeof _this.options.overlayMouseoverCallback == 'function')
                    _this.options.overlayMouseoverCallback(this);
            });
            AMap.event.addListener(polygon, 'mouseout', function(e){ //鼠标移出
                if(typeof _this.options.overlayMouseoutCallback == 'function')
                    _this.options.overlayMouseoutCallback(this);
            });
            // this.coordinates[id] = {polygon: polygon, points: data};
            this.coordinates[id] = polygon;
            return polygon;
        },
        getGravityCenter: function(overlay){
            var _this = this,
                center = this.getGravityCenterCoordinate(overlay),
                id = CHelper.getID(center, 'point', 'lnglat'),
                marker = new AMap.Marker({
                    content: '<div class="marker marker-flg marker-flg-blue"></div>',
                    position: center,
                    clickable: true,
                    visible: true,
                    // raiseOnDrag: true, //开启动画效果
                    extData: {id: id, belongto: overlay.getExtData().id, type: 'gravitycenter'}
            });
            marker.setMap(this.map);
            AMap.event.addListener(marker, 'dragging', function(e){
                if(typeof _this.options.overlayDraggingCallback == 'function')
                    _this.options.overlayDraggingCallback(this);
            });
            AMap.event.addListener(marker, 'dragend', function(e){
                if(typeof _this.options.overlayDragendCallback == 'function')
                    _this.options.overlayDragendCallback(this);
            });
            return marker;
        },
        getGravityCenterCoordinate: function(overlay){
            var type = overlay.getExtData().type,
                center = '';
            switch(type){
                case 'polygon':
                    // center = overlay.getBounds().getCenter();
                    var points = overlay.getPath(),
                        size = points.length,
                        x = y = 0;
                    for(var i = 0; i < size; i++){
                        var point = points[i];
                        x += point.getLat();
                        y += point.getLng();
                    }
                    center = new AMap.LngLat(y/size, x/size);
                    break;
            }
            return center;
        },
        isContains: function(overlay, lnglat){
            var type = overlay.getExtData().type,
                res = false;
            switch(type){
                case 'polygon':
                    res = overlay.contains(lnglat);
                    break;
            }
            return res;
        },
        addMarker: function(id, lng, lat, icon){
            var _this = this,
                info = new AMap.InfoWindow({
                        content: '<h3>未命名标注</h3>  地址：<br/>  备注：',
                        size: new AMap.Size(300, 0),
                        autoMove: true,
                        offset: new AMap.Pixel(0, -30),
                        closeWhenClickMap: true
                }),
                marker = new AMap.Marker({                
                icon: icon || this.options.markerIcon, //new AMap.Icon
                position: new AMap.LngLat(lng, lat),
                clickable: true,
                visible: true,
                extData: {id: id, type: 'marker', info: info}
            });
            marker.setMap(this.map);
            //info窗口的显示与隐藏
            AMap.event.addListener(marker, 'mouseover', function(e){
                if(typeof _this.options.overlayMouseoverCallback == 'function')
                    _this.options.overlayMouseoverCallback(this);
            });
            AMap.event.addListener(marker, 'mouseout', function(e){
                this.getExtData().info.close();
                if(typeof _this.options.overlayMouseoutCallback == 'function')
                    _this.options.overlayMouseoutCallback(this);
            });
            //双击编辑
            AMap.event.addListener(marker, 'dblclick', function(e){
                if(typeof _this.options.overlayDblclickCallback == 'function')
                    _this.options.overlayDblclickCallback(this);
            });
            //单击打开侧边栏
            AMap.event.addListener(marker, 'click', function(e){
                if(typeof _this.options.overlayClickCallback == 'function')
                    _this.options.overlayClickCallback(this);
            });
            return marker;
        },
        getLnglats: function(isClear){
            var lnglats = [];
            // for(var k in this.coordinate) lnglats.push(this.coordinate[k].lnglat);
            for(var k in this.coordinate) lnglats.push(this.coordinate[k].getPosition());
            if(isClear === true) this.coordinate = {};
            return lnglats;
        },
        clear: function(){
            this.coordinates = {};
            this.coordinate = {};
            this.searchData = {};
            this.map.clearMap();
        },
        redraw: function(){
            this.map.clearMap();
            //重绘地图上的标记物(marker、polygon、infoWindow及它们绑定的事件等)
            for(var i in this.coordinate){ //标记
                var marker = this.coordinate[i];
                marker.setMap(this.map);
            }
            for(var i in this.coordinates){ //多边形
                var overlay = this.coordinates[i],
                    // path = overlay.getPath();
                    markers = overlay.getExtData().markers,
                    center = overlay.getExtData().center;
                overlay.setMap(this.map);
                if(center) center.setMap(this.map);
                for(var j in markers){
                    markers[j].setMap(this.map);
                }
            }
            for(var i in this.searchData){ //搜索标记
                var d = this.searchData[i];
                d.marker.setMap(this.map);
            }
        },
        removeOverly: function(overly){
            // marker.hide();
            // this.searchData[marker.getExtData().id]['info'].close();
            var type = overly.getExtData().type;
            switch(type){
                case 'smarker': //搜索marker
                    delete this.searchData[overly.getExtData().id];
                    break;
                case 'marker':
                    delete this.coordinate[overly.getExtData().id];
                    break;
                case 'polygon':
                    delete this.coordinates[overly.getExtData().id];
                    break;
                default:
                    console.info('未知类型:' + type);
            }
            this.redraw();
        },
        panTo: function(lng, lat){
            // this.map.setCenter(new AMap.LngLat(lng ,lat));
            this.map.panTo(new AMap.LngLat(lng ,lat));
        },
        setFitView: function(overlayArr){
            this.map.setFitView(overlayArr);
        },
        queryByCoordinate: function(val, key, target){
            if(key === 13){
                if(val == ''){
                    CHelper.popover(target, 'show', '', '请填写坐标！', 800);
                    return false;
                }
                var coordinate = $.grep(val.split(','), function(n, i){
                    return parseFloat(n) > 0;
                });
                if(coordinate.length !== 2 || !/^\d+?\.\d{6,}$/.test(coordinate[0]) || !/^\d+?\.\d{6,}$/.test(coordinate[1])){
                    CHelper.popover(target, 'show', '', '坐标格式错误！', 800);
                    return false;
                }
                this.panTo(coordinate[0], coordinate[1]);
            }
        },
        query: function(keyword, key, target, result){
            var hints = $(result), hintsDom = hints.get(0),
                cur = hints.data('curSelect'),
                // childNum = hints.children('div.item').length,
                childNum = hintsDom.childNodes.length;
            switch(key){
                case 40: //down
                    if(cur + 1 < childNum){
                        if(hintsDom.childNodes[cur]){
                            hintsDom.childNodes[cur].style.background = '';
                        }
                        hints.data('curSelect', cur + 1);
                        hintsDom.childNodes[cur + 1].style.background = '#CAE1FF';
                        $(target).val(hints.data('tipArr')[cur + 1].name);
                    }
                    break;
                case 38: //up
                    if(cur-1>=0){
                        if(hintsDom.childNodes[cur]){
                            hintsDom.childNodes[cur].style.background = '';
                        }
                        hints.data('curSelect', cur - 1);
                        hintsDom.childNodes[cur - 1].style.background = '#CAE1FF';
                        $(target).val(hints.data('tipArr')[cur - 1].name);
                    }
                    break;
                // case 49: break;//esc
                // case 8: break; //backspace
                // case 46: break; //del
                case 13: //enter
                    if(keyword == ''){
                        CHelper.popover(target, 'show', '', '请输入内容！', 800);
                    }else{
                        if(hints.length > 0 && cur !== -1){
                            mapAutoSelectResult(cur);
                        }
                    }
                    break;
                default:
                    if(keyword == ''){
                        $(result).hide();
                    }else{
                        this.autoSearch(keyword, target, result);
                    }
            }
        },
        autoSearch: function(keyword, target, result){
            //加载输入提示插件
            AMap.service(['AMap.Autocomplete'], function(){
                if(keyword.length > 0){
                    var options = {city: ''}, //城市，默认全国
                        auto = new AMap.Autocomplete(options);

                    //查询成功时返回查询结果
                    auto.search(keyword, function(status, res){
                        map_autocomplete_CallBack(status, res, result);
                    });
                }else{
                    // CHelper.popover(target, 'show', '', '关键词不能为空！', 800);
                }
            });
        },
        searchByKeyword: function(data){
            var _this = this;
            this.map.plugin(["AMap.PlaceSearch"], function(){
                var msearch = new AMap.PlaceSearch();  //构造地点查询类
                //查询成功时的回调函数
                AMap.event.addListener(msearch, 'complete', function(data){
                    //清空地图上的InfoWindow和Marker
                    _this.searchData = {};
                    // _this.clear();
                    _this.redraw();
                    // for(var k in _this.searchData){
                    //     _this.searchData[k]
                    // }
                    // map_placeSearch_CallBack(data);
                    
                    var poiArr = data.poiList.pois;
                    for(var i = 0; i < poiArr.length; i++) _this.addmarkerForSearch(i, poiArr[i]);
                    // _this.map.setFitView();
                    var overlayArr = [];
                    for(var i in _this.searchData) overlayArr.push(_this.searchData[i].marker);
                    _this.map.setFitView(overlayArr);
                    map_search_by_keyword_cb(poiArr);
                });
                msearch.setCity(data.cityCode);
                msearch.search(data.text);
            });
        },
        addmarkerForSearch: function(i, d){ //添加查询结果的marker&infowindow
            var _this = this,
                lngX = d.location.getLng(),
                latY = d.location.getLat(),
                markerOption = {
                    map: this.map,
                    icon: 'http://webapi.amap.com/images/' + (i + 1) + '.png',
                    position: new AMap.LngLat(lngX, latY)
                };
            marker = new AMap.Marker(markerOption);
            // marker.setMap(this.map);
            var id = CHelper.getID(marker, 'point', 'marker');
            marker.setExtData({id: id, type: 'smarker'});
            this.searchData[id] = {marker: marker};

            var infoWindow = new AMap.InfoWindow({
                content: '<h3><font color="#00a6ac">' + (i + 1) + ". " + d.name +
                         '</font></h3>' + this.tipContents(d.type, d.address, d.tel),
                size: new AMap.Size(300, 0),
                autoMove: true,
                offset: new AMap.Pixel(0, -30),
                closeWhenClickMap: true
            });
            this.searchData[id]['info'] = infoWindow;
            AMap.event.addListener(marker, 'mouseover', function(e){
                infoWindow.open(_this.map, this.getPosition());
            });
            AMap.event.addListener(marker, 'click', function(e){
                map_marker_del(this);
            });
        },
        tipContents: function(type, address, tel){ //infowindow显示内容
            if($.isEmptyObject(type) || typeof type == 'undefined'){
                type = '暂无';
            }
            if($.isEmptyObject(address) || typeof address == 'undefined'){
                address = '暂无';
            }
            if($.isEmptyObject(tel) || typeof tel == 'undefined'){
                tel = '暂无';
            }
            var str = '  地址：' + address + '<br />  电话：' + tel + ' <br />  类型：' + type;
            return str;
        }
    };

    exports.CMap = CMap;
})(window);