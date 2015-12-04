<?php

use \ext\qiniu\Auth as QiniuAuth;
use \ext\qiniu\Storage\UploadManager;

/**
 * Created by JetBrains PhpStorm.
 * User: taoqili
 * Date: 12-7-18
 * Time: 上午11: 32
 * UEditor编辑器通用上传类
 */
class Uploader {
    private $fileField; //文件域名
    private $file; //文件上传对象
    private $base64; //文件上传对象
    private $config; //配置信息
    private $oriName; //原始文件名
    private $fullName; //完整文件名,即从当前配置目录开始的URL
    private $fileSize; //文件大小
    private $fileType; //文件类型
    private $stateInfo; //上传状态信息,
    private $stateMap = array( //上传状态映射表，国际化用户需考虑此处数据的国际化
        "SUCCESS", //上传成功标记，在UEditor中内不可改变，否则flash判断会出错
        "文件大小超出 upload_max_filesize 限制",
        "文件大小超出 MAX_FILE_SIZE 限制",
        "文件未被完整上传",
        "没有文件被上传",
        "上传文件为空",
    	"ERROR_QINIU_UPLOAD_ERROR" => "文件上传错误",
    	"ERROR_WRITE_FILE" => "文件写入错误",
        "ERROR_TMP_FILE" => "临时文件错误",
        "ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
        "ERROR_SIZE_EXCEED" => "文件大小超出网站限制",
        "ERROR_TYPE_NOT_ALLOWED" => "文件类型不允许",
        "ERROR_FILE_NOT_FOUND" => "找不到上传文件",
        "ERROR_UNKNOWN" => "未知错误",
        "ERROR_DEAD_LINK" => "链接不可用",
        "ERROR_HTTP_LINK" => "链接不是http链接",
        "ERROR_HTTP_CONTENTTYPE" => "链接contentType不正确"
    );
    
    private $mineType = array(
    		"ai"  =>  "application/postscript",
    		"aif"  =>  "audio/x-aiff",
    		"aifc"  =>  "audio/x-aiff",
    		"aiff"  =>  "audio/x-aiff",
    		"asc"  =>  "text/plain",
    		"au"  =>  "audio/basic",
    		"avi"  =>  "video/x-msvideo",
    		"bcpio"  =>  "application/x-bcpio",
    		"bin"  =>  "application/octet-stream",
    		"c"  =>  "text/plain",
    		"cc"  =>  "text/plain",
    		"py"  =>  "text/plain",
    		"php"  =>  "text/plain",
    		"ccad"  =>  "application/clariscad",
    		"cdf"  =>  "application/x-netcdf",
    		"class"  =>  "application/octet-stream",
    		"cpio"  =>  "application/x-cpio",
    		"cpt"  =>  "application/mac-compactpro",
    		"csh"  =>  "application/x-csh",
    		"css"  =>  "text/css",
    		"dcr"  =>  "application/x-director",
    		"dir"  =>  "application/x-director",
    		"dms"  =>  "application/octet-stream",
    		"doc"  =>  "application/msword",
    		"drw"  =>  "application/drafting",
    		"dvi"  =>  "application/x-dvi",
    		"dwg"  =>  "application/acad",
    		"dxf"  =>  "application/dxf",
    		"dxr"  =>  "application/x-director",
    		"eps"  =>  "application/postscript",
    		"etx"  =>  "text/x-setext",
    		"exe"  =>  "application/octet-stream",
    		"ez"  =>  "application/andrew-inset",
    		"f"  =>  "text/plain",
    		"f90"  =>  "text/plain",
    		"fli"  =>  "video/x-fli",
    		"gif"  =>  "image/gif",
    		"gtar"  =>  "application/x-gtar",
    		"gz"  =>  "application/x-gzip",
    		"h"  =>  "text/plain",
    		"hdf"  =>  "application/x-hdf",
    		"hh"  =>  "text/plain",
    		"hqx"  =>  "application/mac-binhex40",
    		"htm"  =>  "text/html",
    		"html"  =>  "text/html",
    		"ice"  =>  "x-conference/x-cooltalk",
    		"ief"  =>  "image/ief",
    		"iges"  =>  "model/iges",
    		"igs"  =>  "model/iges",
    		"ips"  =>  "application/x-ipscript",
    		"ipx"  =>  "application/x-ipix",
    		"jpe"  =>  "image/jpeg",
    		"jpeg"  =>  "image/jpeg",
    		"jpg"  =>  "image/jpeg",
    		"js"  =>  "application/x-javascript",
    		"kar"  =>  "audio/midi",
    		"latex"  =>  "application/x-latex",
    		"lha"  =>  "application/octet-stream",
    		"lsp"  =>  "application/x-lisp",
    		"lzh"  =>  "application/octet-stream",
    		"m"  =>  "text/plain",
    		"man"  =>  "application/x-troff-man",
    		"me"  =>  "application/x-troff-me",
    		"mesh"  =>  "model/mesh",
    		"mid"  =>  "audio/midi",
    		"midi"  =>  "audio/midi",
    		"mif"  =>  "application/vnd.mif",
    		"mime"  =>  "www/mime",
    		"mov"  =>  "video/quicktime",
    		"movie"  =>  "video/x-sgi-movie",
    		"mp2"  =>  "audio/mpeg",
    		"mp3"  =>  "audio/mpeg",
    		"mpe"  =>  "video/mpeg",
    		"mpeg"  =>  "video/mpeg",
    		"mpg"  =>  "video/mpeg",
    		"mpga"  =>  "audio/mpeg",
    		"ms"  =>  "application/x-troff-ms",
    		"msh"  =>  "model/mesh",
    		"nc"  =>  "application/x-netcdf",
    		"oda"  =>  "application/oda",
    		"pbm"  =>  "image/x-portable-bitmap",
    		"pdb"  =>  "chemical/x-pdb",
    		"pdf"  =>  "application/pdf",
    		"pgm"  =>  "image/x-portable-graymap",
    		"pgn"  =>  "application/x-chess-pgn",
    		"png"  =>  "image/png",
    		"pnm"  =>  "image/x-portable-anymap",
    		"pot"  =>  "application/mspowerpoint",
    		"ppm"  =>  "image/x-portable-pixmap",
    		"pps"  =>  "application/mspowerpoint",
    		"ppt"  =>  "application/mspowerpoint",
    		"ppz"  =>  "application/mspowerpoint",
    		"pre"  =>  "application/x-freelance",
    		"prt"  =>  "application/pro_eng",
    		"ps"  =>  "application/postscript",
    		"qt"  =>  "video/quicktime",
    		"ra"  =>  "audio/x-realaudio",
    		"ram"  =>  "audio/x-pn-realaudio",
    		"ras"  =>  "image/cmu-raster",
    		"rgb"  =>  "image/x-rgb",
    		"rm"  =>  "audio/x-pn-realaudio",
    		"roff"  =>  "application/x-troff",
    		"rpm"  =>  "audio/x-pn-realaudio-plugin",
    		"rtf"  =>  "text/rtf",
    		"rtx"  =>  "text/richtext",
    		"scm"  =>  "application/x-lotusscreencam",
    		"set"  =>  "application/set",
    		"sgm"  =>  "text/sgml",
    		"sgml"  =>  "text/sgml",
    		"sh"  =>  "application/x-sh",
    		"shar"  =>  "application/x-shar",
    		"silo"  =>  "model/mesh",
    		"sit"  =>  "application/x-stuffit",
    		"skd"  =>  "application/x-koan",
    		"skm"  =>  "application/x-koan",
    		"skp"  =>  "application/x-koan",
    		"skt"  =>  "application/x-koan",
    		"smi"  =>  "application/smil",
    		"smil"  =>  "application/smil",
    		"snd"  =>  "audio/basic",
    		"sol"  =>  "application/solids",
    		"spl"  =>  "application/x-futuresplash",
    		"src"  =>  "application/x-wais-source",
    		"step"  =>  "application/STEP",
    		"stl"  =>  "application/SLA",
    		"stp"  =>  "application/STEP",
    		"sv4cpio"  =>  "application/x-sv4cpio",
    		"sv4crc"  =>  "application/x-sv4crc",
    		"swf"  =>  "application/x-shockwave-flash",
    		"t"  =>  "application/x-troff",
    		"tar"  =>  "application/x-tar",
    		"tcl"  =>  "application/x-tcl",
    		"tex"  =>  "application/x-tex",
    		"texi"  =>  "application/x-texinfo",
    		"texinfo"  =>  "application/x-texinfo",
    		"tif"  =>  "image/tiff",
    		"tiff"  =>  "image/tiff",
    		"tr"  =>  "application/x-troff",
    		"tsi"  =>  "audio/TSP-audio",
    		"tsp"  =>  "application/dsptype",
    		"tsv"  =>  "text/tab-separated-values",
    		"txt"  =>  "text/plain",
    		"unv"  =>  "application/i-deas",
    		"ustar"  =>  "application/x-ustar",
    		"vcd"  =>  "application/x-cdlink",
    		"vda"  =>  "application/vda",
    		"viv"  =>  "video/vnd.vivo",
    		"vivo"  =>  "video/vnd.vivo",
    		"vrml"  =>  "model/vrml",
    		"wav"  =>  "audio/x-wav",
    		"wrl"  =>  "model/vrml",
    		"xbm"  =>  "image/x-xbitmap",
    		"xlc"  =>  "application/vnd.ms-excel",
    		"xll"  =>  "application/vnd.ms-excel",
    		"xlm"  =>  "application/vnd.ms-excel",
    		"xls"  =>  "application/vnd.ms-excel",
    		"xlw"  =>  "application/vnd.ms-excel",
    		"xml"  =>  "text/xml",
    		"xpm"  =>  "image/x-xpixmap",
    		"xwd"  =>  "image/x-xwindowdump",
    		"xyz"  =>  "chemical/x-pdb",
    		"zip"  =>  "application/zip"
    );

    /**
     * 构造函数
     * @param string $fileField 表单名称
     * @param array $config 配置项
     * @param bool $base64 是否解析base64编码，可省略。若开启，则$fileField代表的是base64编码的字符串表单名
     */
    public function __construct($fileField, $config, $type = "upload") {
        $this->fileField = $fileField;
        $this->config = $config;
        $this->type = $type;
        if ($type == "remote") {
            $this->saveRemote();
        } else if($type == "base64") {
            $this->upBase64();
        } else {
            $this->upFile();
        }

        $this->stateMap['ERROR_TYPE_NOT_ALLOWED'] = iconv('unicode', 'utf-8', $this->stateMap['ERROR_TYPE_NOT_ALLOWED']);
    }

    /**
     * 上传文件的主处理方法
     * @return mixed
     */
    private function upFile() {
        $file = $this->file = $_FILES[$this->fileField];
        if (!$file) {
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_NOT_FOUND");
            return;
        }
        if ($this->file['error']) {
            $this->stateInfo = $this->getStateInfo($file['error']);
            return;
        } else if (!file_exists($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMP_FILE_NOT_FOUND");
            return;
        } else if (!is_uploaded_file($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMPFILE");
            return;
        }

        $this->oriName = $file['name'];
        $this->fileSize = $file['size'];
        $this->fileType = $this->getFileExt();

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //检查是否不允许的文件格式
        if (!$this->checkType()) {
            $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return;
        }

        $this->uploadQiniu($file['tmp_name'], null, $file['type']);
    }

    /**
     * 处理base64编码的图片上传
     * @return mixed
     */
    private function upBase64() {
        $base64Data = $_POST[$this->fileField];
        $img = base64_decode($base64Data);
        
        $this->oriName = $this->config['oriName'];
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        $this->uploadQiniu(null, $img, $this->get_ext_mime($this->fileType));
    }

    /**
     * 拉取远程图片
     * @return mixed
     */
    private function saveRemote() {
        $imgUrl = htmlspecialchars($this->fileField);
        $imgUrl = str_replace("&amp;", "&", $imgUrl);

        //http开头验证
        if (strpos($imgUrl, "http") !== 0) {
            $this->stateInfo = $this->getStateInfo("ERROR_HTTP_LINK");
            return;
        }
        //获取请求头并检测死链
        $heads = get_headers($imgUrl);
        if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
            $this->stateInfo = $this->getStateInfo("ERROR_DEAD_LINK");
            return;
        }
        //格式验证(扩展名验证和Content-Type验证)
        $fileType = strtolower(strrchr($imgUrl, '.'));
        if (!in_array($fileType, $this->config['allowFiles']) || stristr($heads['Content-Type'], "image")) {
            $this->stateInfo = $this->getStateInfo("ERROR_HTTP_CONTENTTYPE");
            return;
        }

        //打开输出缓冲区并获取远程图片
        ob_start();
        $context = stream_context_create(
            array('http' => array(
                'follow_location' => false // don't follow redirects
            ))
        );
        readfile($imgUrl, false, $context);
        $img = ob_get_contents();
        ob_end_clean();
        preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

        $this->oriName = $m ? $m[1]:"";
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        $this->uploadQiniu(null, $img, $this->get_ext_mime($this->fileType));
    }

    private function uploadQiniu($path, $file, $mime) {
    	$accessKey = Yii::app()->params['partner']['qiniu']['accessKey'];
    	$secretKey = Yii::app()->params['partner']['qiniu']['secretKey'];
    	$bucket = Yii::app()->params['partner']['qiniu']['bucket'];
    	
    	$auth = new QiniuAuth($accessKey, $secretKey);
    	$token = $auth->uploadToken($bucket);
    	$uploadManager = new UploadManager();
    	
    	if($path) {
    		list($ret, $err) = $uploadManager->putFile($token, null, $path, null, $mime);
    	} else {
    		list($ret, $err) = $uploadManager->put($token, null, $file, null, $mime);
    	}
    	if ($err != null) {
    		$this->stateInfo = $this->getStateInfo("ERROR_QINIU_UPLOAD_ERROR");
    		return;
    	}
    	$this->fullName = Yii::app()->params['partner']['qiniu']['domain'].$ret["key"];
    	
    	$data = array(
    			'key' => $ret["key"],
    			'hash' => $ret['hash'],
    			'size' => $this->fileSize,
    			'link' => $this->fullName,
    	);
    	$proxy = new ResourceProxy();
    	$r = $proxy->upload($data);
    	if($r['code'] != 200) {
    		$this->stateInfo = $this->getStateInfo("ERROR_WRITE_FILE");
    		return;
    	}
    	$this->stateInfo = $this->stateMap[0];
    }
    
    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function getStateInfo($errCode) {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    private function getFileExt() {
        return strtolower(strrchr($this->oriName, '.'));
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType() {
        return in_array($this->getFileExt(), $this->config["allowFiles"]);
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function  checkSize() {
        return $this->fileSize <= ($this->config["maxSize"]);
    }

    /**
     * 获取当前上传成功文件的各项信息
     * @return array
     */
    public function getFileInfo() {
        return array(
            "state" => $this->stateInfo,
            "url" => $this->fullName,
            "title" => $this->oriName,
            "original" => $this->oriName,
            "type" => $this->fileType,
            "size" => $this->fileSize
        );
    }
    
    function get_ext_mime($ext){    	
    	$ext = strtolower(substr($ext, 1));
    	return $this->mineType[$ext];
    }

}