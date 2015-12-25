<?php

class CProxy extends CComponent{
    const OK = 200;  //请求成功
    const NOTMODIFY = 302; //数据无变化
    const BADREQUEST = 400; //错误的请求参数
    const NOTLOGIN = 401;  //需要登录
    const NOTRIGHT = 403;  //无权限
    const NOTFOUND = 404;  //找不到
    const SERVERERROR = 500;  //内部错误
    const GATEWAYTIMEOUT = 504; //超时

    public $dataType;

    public function __construct($dataType = 'json'){
        $this->dataType = $dataType;
    }

    private function getResults($output){
        switch(Yii::app()->curl->getStatus()){
            case 404:
                $result = array('code' => self::NOTFOUND, 'msg' => '地址不存在', 'verbose' => $output);
                break;
            default:
                $result = is_array($output)? $output : json_decode($output, true);
        }
        
        if($result && $result['code']===401) {
        	Yii::app()->user->logout();
        	$result = array('code' => self::NOTLOGIN, 'msg' => '登录已失效', 'verbose' => $output);
        }
        
        return $result ?: array('code' => self::BADREQUEST, 'msg' => '参数错误', 'verbose' => $output);
    }

    private function sendRequest($callback){
        try{
            $header = array();
            $result = array('code' => self::NOTFOUND, 'msg' => '');
            if(!Yii::app()->user->isGuest) $header['token'] = Yii::app()->user->token;
            switch($this->dataType){
                case 'json':
                    $header['Content-Type'] = 'application/json;charset=UTF-8';
                    try{
                        $output = $callback($header);
                        $result = $this->getResults($output);
                    }catch(Exception $e){ //The request timeout.
                        $result = array('code' => self::GATEWAYTIMEOUT, 'msg' => '请求超时');
                    }
                    break;
                default:
                    break;
          }
        }catch(Exception $e){
            $result = array('code' => self::SERVERERROR, 'msg' => '内部错误'); //Internal server error.
        }
        return $result;
    }

    public function put($url, $data = '{}', $params = array(), $header = array(), $debug = false){
        return $this->sendRequest(function($h) use($url, $data, $params, $header, $debug){
            $header = array_merge($header, $h);
            //Yii::log(is_string($data), CLogger::LEVEL_ERROR);
            $_data = is_array($data)? json_encode($data) : $data;
            return Yii::app()->curl->put(
                $url, $_data, $params, $header, $debug
            ) ?: array('code' => self::NOTFOUND, 'msg' => '对象未找到'); //Object not found.
        });
    }

    public function post($url, $data = '{}', $params = array(), $header = array(), $debug = false){
        return $this->sendRequest(function($h) use($url, $data, $params, $header, $debug){
            $header = array_merge($header, $h);
            //Yii::log(is_string($data), CLogger::LEVEL_ERROR);
            $_data = is_array($data)? json_encode($data) : $data;
            return Yii::app()->curl->post(
                $url, $_data, $params, $header, $debug
            ) ?: array('code' => self::NOTFOUND, 'msg' => '对象未找到'); //Object not found.
        });
    }
    
    public function get($url, $params = array(), $header = array(), $debug = false){
    	return $this->sendRequest(function($h) use($url, $data, $params, $header, $debug){
    		$header = array_merge($header, $h);
    		//Yii::log(is_string($data), CLogger::LEVEL_ERROR);
    		$_data = is_array($data)? json_encode($data) : $data;
    		return Yii::app()->curl->get(
    				$url, $params, $header, $debug
    		) ?: array('code' => self::NOTFOUND, 'msg' => '对象未找到'); //Object not found.
    	});
    }

    public function deleteinfo($url, $params = array(), $header = array(), $debug = false){
        return $this->sendRequest(function($h) use($url, $data, $params, $header, $debug){
            $header = array_merge($header, $h);
            //Yii::log(is_string($data), CLogger::LEVEL_ERROR);
            $_data = is_array($data)? json_encode($data) : $data;
            return Yii::app()->curl->delete(
                    $url, $params, $header, $debug
            ) ?: array('code' => self::NOTFOUND, 'msg' => '对象未找到'); //Object not found.
        });
    }
}