(function(){
    var paths = [
        '/js/lib/jquery.min.js', '/js/lib/bootstrap/js/bootstrap.js',
        '/js/lib/hammer.min.js', '/js/lib/jquery.hammer.js',
        '/js/lib/template.js', '/js/lib/sprintf.min.js',
        '/js/lib/xss.js', '/js/chelper.js', '/js/lib/jquery.custom.js',
        '/js/lib/lazyload.js','/js/lib/unslider.js','/js/lib/iscroll-lite.min.js',
        '/js/lib/ossupload.full.min.js', '/js/main.js'
    ];

    for(var i = 0,file; file = paths[i++];){
        document.write('<script type="text/javascript" src="'+ file + '"></script>');
    }
})();
