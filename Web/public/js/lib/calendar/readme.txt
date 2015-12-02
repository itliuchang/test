1.日历控件事通过$('.datepicker').pickadate(options)触发的，options的具体参数可以从 http://amsul.ca/pickadate.js/date/ 网页上看到
2.我在options里增加的一个字段date,里面结构是
month->day->text->{content,className}
是控制日历里可选的天的内容，没有选中的day默认为隐藏
3.936行用于判断当前循环的类是否在setting.data自定义的类中，如不在则td的默认类为picker__day--disabled，即不可用
4.在pick.date.js文件里控制节点生成的语句的位置是在938行，Picker._.node(tagName,content,className)代表生成单个节点，Picker._.group()用于递归生成子元素（不需要修改这个），Picker._.node(tagName,content,className)其中content的位置可以是标签里面内容也可以是子元素Picker._.node(tagName,content,className)，多个子元素直接用“＋”连接
5.$('.datepicker').pickadate(options)里的options对应pick.date.js里的settings对象（从938行可以使用这个对象），即settings.date=options.date
6.targetDate对象里有三个属性year，month，date，分别表示当前本地时间的年月日。
7.最新版是3.5.6
  http://amsul.ca/pickadate.js
  https://github.com/amsul/pickadate.js
  当前用的版本是v3.3.1，从 http://plugins.jquery.com/pickadate/ http://plugins.jquery.com/pickadate/3.3.1/ 下载