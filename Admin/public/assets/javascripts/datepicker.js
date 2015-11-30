(function() {
	$(document).ready(function() {	
		 $.fn.datetimepicker.dates['zh-CN'] = {
			   days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
			   daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
			   daysMin: ["日", "一", "二", "三", "四", "五", "六", "日"],
			   months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
			   monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
			   today: "今日",
			   suffix: [],
			   meridiem: ["上午", "下午"],
			   format: "yyyy-mm-dd"
		};
		
		$(".datetimepicker").datetimepicker({
	        autoclose: true,
	        language: 'zh-CN',
		});
        $(".datepicker").datetimepicker({
            pickTime: false,
            autoclose: true,
            language: 'zh-CN',
        });
        $(".timepicker").datetimepicker({
            pickDate: false,
            autoclose: true,
            language: 'zh-CN',
        });		
		
	    $("#daterange").daterangepicker({
	    	ranges: {
	    		"三日游": [new Date(), moment().subtract("days", -3)],
	    		"七天游": [new Date(), moment().subtract("days", -7)],
	    		"蜜月游": [new Date(), moment().subtract("days", -15)]
	    	},
	    	opens: "right",
	    	format: "MM/DD/YYYY",
	    	separator: " - ",
	    	startDate: new Date(),
	    	endDate: moment().subtract("days", -3),
	    	minDate: new Date(),
	    	maxDate: "12/31/2020",
	    	locale: {
	    		applyLabel: "确定",
	    		clearLabel: "取消", 
	    		customRangeLabel: "自定义",
	    		fromLabel: "开始时间",
	    		toLabel: "结束时间",
	    		daysOfWeek: ["日", "一", "二", "三", "四", "五", "六"],
	    		monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	    		firstDay: 1
	    	},
	    	showWeekNumbers: true,
	    	buttonClasses: ["btn-danger"],
	    	dateLimit: {
	            days: 40
	        }
	    }, function(start, end) {
	    	if(start==null)  return;
	    	if(end==null) return;
	    	return $("#daterange").parent().find("input").first().val(start.format("YYYY/MM/DD") + " - " + end.format("YYYY/MM/DD"));
	    });
	});
}).call(this);