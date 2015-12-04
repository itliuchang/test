<?php
// header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
// header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
// date_default_timezone_set("Asia/chongqing");
// error_reporting(E_ERROR);
// header("Content-Type: text/html; charset=utf-8");

class UEditor extends CComponent {
	
    private $action;
	private $size;
	private $start;
	private $callback;
	private $CONFIG;

    public function __construct($action, $size=0, $start=0, $callback=null) {
        $this->action = $action;
        $this->size = $size;
        $this->start = $start;
        $this->callback = $callback;
    }
    
	public function executeUEditor() {
		$this->CONFIG = json_decode(preg_replace('/\/\*[\s\S]+?\*\//', '', file_get_contents(dirname(__FILE__).'/config.json')), true);
		switch ($this->action) {
		    case 'config':
		        $result =  json_encode($this->CONFIG);
		        break;
		
		    /* 上传图片 */
		    case 'uploadimage':
		    /* 上传涂鸦 */
		    case 'uploadscrawl':
		    /* 上传视频 */
		    case 'uploadvideo':
		    /* 上传文件 */
		    case 'uploadfile':
		        $result = include("action_upload.php");
		        break;
		
		    /* 列出图片 */
		    case 'listimage':
		        $result = include("action_list.php");
		        break;
		    /* 列出文件 */
		    case 'listfile':
		        $result = include("action_list.php");
		        break;
		
		    /* 抓取远程文件 */
		    case 'catchimage':
		        $result = include("action_crawler.php");
		        break;
		
		    default:
		        $result = json_encode(array(
		            'state'=> '请求地址出错'
		        ));
		        break;
		}
		
		/* 输出结果 */
		if (isset($this->callback)) {
		    if (preg_match("/^[\w_]+$/", $this->callback)) {
		        return htmlspecialchars($this->callback) . '(' . $result . ')';
		    } else {
		        return json_encode(array(
		            'state'=> 'callback参数不合法'
		        ));
		    }
		} else {
		    return $result;
		}
	}
}