(function(){
    var paths = [
        '/js/lib/jquery.min.js', '/js/lib/bootstrap/js/bootstrap.js',
        '/js/lib/underscore.js', '/js/lib/backbone.js', '/js/lib/base64.js',
        '/js/lib/md5.js', '/js/lib/uuid.js', '/js/lib/template.js', '/js/lib/sprintf.min.js',
        '/js/lib/jquery.animate-colors.js', '/js/lib/xss.js', '/js/chelper.js',
        '/js/lib/jquery.custom.js', '/js/common.js'
    ];
    
    for(var i = 0,file; file = paths[i++];){
        // document.write('<script type="text/javascript" src="'+ file + '?v=1.1.0"></script>');
        document.write('<script type="text/javascript" src="'+ file + '"></script>');
    }
})();