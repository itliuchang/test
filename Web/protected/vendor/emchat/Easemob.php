<?php
/**
 * 环信-服务器端REST API
 * http://docs.easemob.com
 * REST API接口统一限流为30次/秒，超出则返回503。所以聊天发送消息需要用webIM端
 */
class Easemob{
	private $client_id;
	private $client_secret;
	private $org_name;
	private $app_name;
	private $url;
	
	/**
	 * 初始化参数
	 *
	 * @param array $options   
	 * @param $options['client_id']    	
	 * @param $options['client_secret'] 
	 * @param $options['org_name']    	
	 * @param $options['app_name']   		
	 */
	protected function __construct($options){
		$this->client_id = isset($options['client_id'])? $options['client_id'] : '';
		$this->client_secret = isset($options['client_secret'])? $options['client_secret'] : '';
		$this->org_name = isset($options['org_name'])? $options['org_name'] : '';
		$this->app_name = isset($options['app_name'])? $options['app_name'] : '';
		$this->url = 'https://a1.easemob.com/' . $this->org_name . '/' . $this->app_name . '/';
	}

    //http://docs.easemob.com/doku.php?id=start:450errorcode:10restapierrorcode
	private function unpackResult($data){
		$res = json_decode($data['result'], true);
		if(isset($res['error'])){
			Yii::log($data['code'] . ': ' $data['result'], CLogger::LEVEL_ERROR, 'easemob.request');
		}
		return $res;
	}

	/**
	 * 开放注册模式
	 * http://docs.easemob.com/doku.php?id=start:100serverintegration:20users
	 * @param $options['username'] 用户名/环信ID
	 * @param $options['password'] 密码
	 * @param #options['nickname'] 昵称(可选)
	 */
	public function openRegister($options) {
		$url = $this->url . "users";
		$result = $this->postCurl ( $url, $options, $head = 0 );
		return $this->unpackResult($result);
	}
	
	/**
	 * 授权注册模式 || 批量注册
	 *
	 * @param $options['username'] 用户名        	
	 * @param $options['password'] 密码
	 * @param #options['nickname'] 昵称(可选)
	 *        	批量注册传二维数组
	 */
	public function accreditRegister($options) {
		$url = $this->url . "users";
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, $options, $header );
		return $this->unpackResult($result);
	}
	
	/**
	 * 获取指定用户详情
	 *
	 * @param $username 用户名        	
	 */
	public function getUser($username) {
		$url = $this->url . "users/" . $username;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = 'GET' );
		return $this->unpackResult($result);
	}

	/**
	 * 获取批量用户
	 * @param $cursor 游标
	 * @param $limit 返回的大小
	 */
	public function getUsers($cursor = null, $limit = 20){
		if($cursor === ''){
			return array();
		}else{
			$url = $this->url . 'users?';
			$header[] = 'Authorization: Bearer ' . $this->getToken();
			$options = array('limit' => $limit);
			if(!empty($cursor)) $options['cursor'] = $cursor;
			$result = $this->postCurl($url . http_build_query($options), '', $header, 'GET');
			return $this->unpackResult($result);
		}
	}
	
	/**
	 * 重置用户密码
	 *
	 * @param $options['username'] 用户名
	 * @param $options['newpassword'] 新密码        	
	 */
	public function editPassword($options) {
		$url = $this->url . "users/" . $options ['username'] . "/password";
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, $options, $header, $type = 'PUT');
		return $this->unpackResult($result);
	}

	/**
	 * 修改用户昵称
	 * @param $options['username'] 用户名
	 * @param $options['nickname'] 昵称
	 */
	public function editNickname($options){
		$url = $this->url . 'users/' . $options ['username'];
		$header[] = 'Authorization: Bearer ' . $this->getToken();
		$result = $this->postCurl($url, $options, $header, 'PUT');
		return $this->unpackResult($result);
	}
	/**
	 * 删除用户
	 *
	 * @param $username 用户名        	
	 */
	public function deleteUser($username) {
		$url = $this->url . "users/" . $username;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = 'DELETE' );
		return $this->unpackResult($result);
	}
	
	/**
	 * 批量删除用户
	 * 描述：删除某个app下指定数量的环信账号。上述url可一次删除300个用户,数值可以修改 建议这个数值在100-500之间，不要过大
	 *
	 * @param $limit="300" 默认为300条        	
	 * @param $ql 删除条件
	 *        	如ql=order+by+created+desc 按照创建时间来排序(降序)
	 */
	public function batchDeleteUser($limit = "300", $ql = '') {
		$url = $this->url . "users?limit=" . $limit;
		if (! empty ( $ql )) {
			$url = $this->url . "users?ql=" . $ql . "&limit=" . $limit;
		}
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = 'DELETE' );
		return $this->unpackResult($result);
	}
	
	/**
	 * 给一个用户添加一个好友
	 *
	 * @param $owner_username   是要添加好友的用户名
	 * @param $friend_username  是被添加的用户名
	 */
	public function addFriend($owner_username, $friend_username) {
		$url = $this->url . "users/" . $owner_username . "/contacts/users/" . $friend_username;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header );
		return $this->unpackResult($result);
	}
	/**
	 * 删除好友
	 * @param $owner_username   是要添加好友的用户名
	 * @param $friend_username  是被添加的用户名
	 */
	public function deleteFriend($owner_username, $friend_username) {
		$url = $this->url . "users/" . $owner_username . "/contacts/users/" . $friend_username;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "DELETE" );
		return $this->unpackResult($result);
	}
	/**
	 * 查看用户的好友
	 *
	 * @param $owner_username
	 */
	public function showFriend($owner_username) {
		$url = $this->url . "users/" . $owner_username . "/contacts/users/";
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "GET" );
		return $this->unpackResult($result);
	}
	/**
	 * 查看用户的黑名单
	 */
	public function getBlankList($owner_username){
		$url = $this->url . 'users/' . $owner_username . '/blocks/users';
		$header[] = 'Authorization: Bearer ' . $this->getToken();
		$result = $this->postCurl($url, '', $header, 'GET');
		return $this->unpackResult($result);
	}
	/**
	 * 往用户的黑名单中加人
	 * $owner_username 要修改黑名单的用户名
	 * $usernames 需要加入到黑名单中的用户名，数组Request Body ： {“usernames”:[“5cxhactgdj”, “mh2kbjyop1”]}
	 */
	public function addToBlankList($owner_username, $usernames){
		$url = $this->url . 'users/' . $owner_username . '/blocks/users';
		$header[] = 'Authorization: Bearer ' . $this->getToken();
		$result = $this->postCurl($url, array('usernames' => $usernames), $header, 'POST');
		return $this->unpackResult($result);
	}
	/**
	 * 从用户的黑名单中减人
	 */
	public function plusFromBlankList($owner_username, $username){
		$url = $this->url . 'users/' . $owner_username . '/blocks/users/' . $username;
		$header[] = 'Authorization: Bearer ' . $this->getToken();
		$result = $this->postCurl($url, '', $header, 'DELETE');
		return $this->unpackResult($result);
	}

	// +----------------------------------------------------------------------
	// | 聊天相关的方法
	// +----------------------------------------------------------------------
	/**
	 * 查看用户是否在线
	 * @param $username
	 */
	public function isOnline($username) {
		$url = $this->url . "users/" . $username . "/status";
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "GET" );
		return $this->unpackResult($result);
	}
	/**
	 * 获取用户的离线消息数
	 */
	public function offlineMsgCount($username){
		$url = $this->url . 'users/' . $username . '/offline_msg_count';
		$header[] = 'Authorization: Bearer ' . $this->getToken();
		$result = $this->postCurl($url, '', $header, 'GET');
		return $this->unpackResult($result);
	}
	/**
	 * 通过离线消息的id查看用户的该条离线消息状态
	 */
	public function getOfflineMsgStatus($username, $msgid){
		$url = $this->url . 'users/' . $username . '/offline_msg_status/' . $msgid;
		$header[] = 'Authorization: Bearer ' . $this->getToken();
		$result = $this->postCurl($url, '', $header, 'GET');
		return $this->unpackResult($result);
	}
	/**
	 * 发送消息
	 *
	 * @param string $from_user 发送方用户名, 无此字段Server会默认设置为"from":"admin",有from字段但值为空串("")时请求失败
	 * @param array $username array('1','2') 用数组,数组长度建议不大于20, 即使只有一个用户,给用户发送时数组元素是用户名,给群组发送时数组元素是groupid
	 * @param string $target_type 默认为：users 描述：给一个或者多个用户(users)或者群组发送消息(chatgroups)
	 * @param string $content  内容    	
	 * @param array $ext 扩展属性, 由app自己定义.可以没有这个字段，但是如果有，值不能是“ext:null“这种形式，否则出错
	 */
	function sendTxtMsg($from_user = "admin", $username, $content, $target_type = "users", $ext) {
		$option ['target_type'] = $target_type;
		$option ['target'] = $username;
		$option ['msg'] = array('type' => 'txt', 'msg' => $content);
		$option ['from'] = $from_user;
		if(!empty($ext)) $option ['ext'] = $ext;
		$url = $this->url . "messages";
		$header [] = 'Authorization: Bearer ' . $this->getToken();
		$result = $this->postCurl ( $url, $option, $header );
		return $this->unpackResult($result);
	}
	/**
	 * 获取app中所有的群组
	 */
	public function chatGroups() {
		$url = $this->url . "chatgroups";
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "GET" );
		return $this->unpackResult($result);
	}
	/**
	 * 创建群组
	 *
	 * @param $option['groupname'] //群组名称,
	 *        	此属性为必须的
	 * @param $option['desc'] //群组描述,
	 *        	此属性为必须的
	 * @param $option['public'] //是否是公开群,
	 *        	此属性为必须的 true or false
	 * @param $option['approval'] //加入公开群是否需要批准,
	 *        	没有这个属性的话默认是true, 此属性为可选的
	 * @param $option['owner'] //群组的管理员,
	 *        	此属性为必须的
	 * @param $option['members'] //群组成员,此属性为可选的        	
	 */
	public function createGroups($option) {
		$url = $this->url . "chatgroups";
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, $option, $header );
		return $this->unpackResult($result);
	}
	/**
	 * 获取群组详情
	 *
	 * @param
	 *        	$group_id
	 */
	public function chatGroupsDetails($group_id) {
		$url = $this->url . "chatgroups/" . $group_id;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "GET" );
		return $this->unpackResult($result);
	}
	/**
	 * 删除群组
	 *
	 * @param
	 *        	$group_id
	 */
	public function deleteGroups($group_id) {
		$url = $this->url . "chatgroups/" . $group_id;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "DELETE" );
		return $this->unpackResult($result);
	}
	/**
	 * 获取群组成员
	 *
	 * @param
	 *        	$group_id
	 */
	public function groupsUser($group_id) {
		$url = $this->url . "chatgroups/" . $group_id . "/users";
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "GET" );
		return $this->unpackResult($result);
	}
	/**
	 * 群组添加成员
	 *
	 * @param
	 *        	$group_id
	 * @param
	 *        	$username
	 */
	public function addGroupsUser($group_id, $username) {
		$url = $this->url . "chatgroups/" . $group_id . "/users/" . $username;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "POST" );
		return $this->unpackResult($result);
	}
	/**
	 * 群组删除成员
	 *
	 * @param
	 *        	$group_id
	 * @param
	 *        	$username
	 */
	public function delGroupsUser($group_id, $username) {
		$url = $this->url . "chatgroups/" . $group_id . "/users/" . $username;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "DELETE" );
		return $this->unpackResult($result);
	}
	/**
	 * 聊天消息记录
	 *
	 * @param $ql 查询条件如：$ql
	 *        	= "select+*+where+from='" . $uid . "'+or+to='". $uid ."'+order+by+timestamp+desc&limit=" . $limit . $cursor;
	 *        	默认为order by timestamp desc
	 * @param $cursor 分页参数
	 *        	默认为空
	 * @param $limit 条数
	 *        	默认20
	 */
	public function chatRecord($ql = '', $cursor = '', $limit = 20) {
		$ql = ! empty ( $ql ) ? "ql=" . $ql : "order+by+timestamp+desc";
		$cursor = ! empty ( $cursor ) ? "&cursor=" . $cursor : '';
		$url = $this->url . "chatmessages?" . $ql . "&limit=" . $limit . $cursor;
		$access_token = $this->getToken ();
		$header [] = 'Authorization: Bearer ' . $access_token;
		$result = $this->postCurl ( $url, '', $header, $type = "GET " );
		return $this->unpackResult($result);
	}
	/**
	 * 获取Token
	 */
	public function getToken() {
		$file = Yii::app()->runtimePath . '/easemob.json';
		$data = file_exists($file)? json_decode(file_get_contents($file), true) : array();
		if(empty($data) || $data['expire_time'] < time()){
			$option = array(
				'grant_type' => 'client_credentials'
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret
			);
			$url = $this->url . 'token';
			$result = $this->postCurl($url, $option);
			$result = json_decode($result);
			$data = array(
				'access_token' => $result['access_token'],
				'expire_time' => $result['expires_in'] + time () - 200,
				'application' => $result['application']
			);
			file_put_contents($file, json_encode($data));
		}
		return $data['access_token'];
	}
	
	/**
	 * CURL Post
	 */
	private function postCurl($url, $option, $header = 0, $type = 'POST') {
		$curl = curl_init (); // 启动一个CURL会话
		curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE ); // 对认证证书来源的检查
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE ); // 从证书中检查SSL加密算法是否存在
		curl_setopt ( $curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)' ); // 模拟用户使用的浏览器
		if (! empty ( $option )) {
			$options = json_encode ( $option );
			curl_setopt ( $curl, CURLOPT_POSTFIELDS, $options ); // Post提交的数据包
		}
		curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
		curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header ); // 设置HTTP头
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
		curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, $type );
		$result = curl_exec ( $curl ); // 执行操作
		//$res = object_array ( json_decode ( $result ) );
		//$res ['status'] = curl_getinfo ( $curl, CURLINFO_HTTP_CODE );
		//pre ( $res );
		$data = array(
			'code' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
			'result' => $result
		);
		curl_close($curl); // 关闭CURL会话
		return $data;
	}
}