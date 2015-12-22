<?php 
class upload{
	private $id;
	private $key;
	private $host;

	public function __construct($id,$key,$domain){
		$this->id = $id;
        $this->key = $key;
        $this->host = $domain;
	}

	public function uploadToken(
		$bucket,
		$expire = 30,
		$dir = 'img/${filename}'
		
	) {
		$end = time() + $expire;
		$expiration = $this->gmt_iso8601($end);
		$condition = array(0=>'content-length-range', 1=>0, 2=>1048576000);
    	$conditions[] = $condition;
    	$start = array(0=>'starts-with', 1=>'$key', 2=>$dir);
    	// $conditions[] = $start; 
    	$arr = array('expiration'=>$expiration,'conditions'=>$conditions);
	   
	    $policy = json_encode($arr);
	    $base64_policy = base64_encode($policy);
	    $string_to_sign = $base64_policy;
	    $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $this->key, true));

	    $response = array();
	    $response['accessid'] = $this->id;
	    $response['host'] = $this->host;
	    $response['policy'] = $base64_policy;
	    $response['signature'] = $signature;
	    $response['expire'] = $end;
	    //这个参数是设置用户上传指定的前缀
	    $response['dir'] = $dir;
	    $data = $response;
	    // return $response;
	    return $this->set_upload_param($data);
	}

	private function gmt_iso8601($time) {
        $dtStr = date("c", $time);
        $mydatetime = new DateTime($dtStr);
        $expiration = $mydatetime->format(DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration."Z";
    }

	public function set_upload_param($response){
		$now = time();
    	
	        $obj = $response;
	        $host = $obj['host'];
	        $policyBase64 = $obj['policy'];
	        $accessid = $obj['accessid'];
	        $signature = $obj['signature'];
	        $expire = $obj['expire'];
	        $key = $obj['dir'];
	        return json_encode($new_multipart_params = array(
	            'key' => $key,
	            'policy'=> $policyBase64,
	            'OSSAccessKeyId'=> $accessid, 
	            'success_action_status' => '200', //让服务端返回200,不然，默认会返回204
	            'signature'=> $signature,
	        ));
		
	    
	}
}