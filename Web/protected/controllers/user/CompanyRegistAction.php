<?php
class CompanyRegistAction extends CAction{

	public function run(){
		if(Yii::app()->request->isAjaxRequest){
			try {
				$name = Yii::app()->request->getParam('name');
				$mobile = Yii::app()->request->getParam('mobile');
				$code = Yii::app()->request->getParam('code');
	
				$email = Yii::app()->request->getParam('email');
				$password = Yii::app()->request->getParam('password');
				$_code = Yii::app()->session['regist_code'.$mobile];
				if ($_code && $_code == $code) {
					$item = Yii::app()->db->createCommand('select * from user where mobile='.$mobile.' and status=0')->queryRow();
					if(!$item){
						$user = new User();
						$user->nickName = $name;
						$user->mobile = $mobile;
						$user->email = $email;
						$user->status = 0;
						if($password) {
							$user->password = md5($password);
						}
						
						$wechat = Yii::app()->session['wechat'];
						if($wechat) {
							// $user->nickName = $wechat['nickname'];
							$user->portrait = $wechat['headimgurl'];
							$user->gender = $wechat['sex'];
						}
						$user->insert();
						//消息系统初始化
						EasemobHelper::initIM($user->id, array('username' => $user->id, 'password' => 'nakedim', 'nickname' => $name));
						
						$user->isBindIM = 1;
						$user->type=3;
						$user->save();
						Yii::app()->session['user'] = $user;
						}else{
							Yii::log(print_r($item,1), CLogger::LEVEL_ERROR,'info');
							Yii::app()->session['user'] = $item;
						}
						//如果用户注册过了，没付款不生成新的用户，读取数据库里的用户信息
						// $identity = new UserIdentity();
						// $identity->registAuth($user);
						
						// $duration = Yii::app()->getComponent('session')->getTimeout();
						// Yii::app()->user->login($identity, $duration);
						echo CJSON::encode(array('code'=>200, 'message'=> 'success'));
				} else {
					echo CJSON::encode(array('code'=>500, 'message'=> '验证码错误'));
				}
			} catch (CException $e){
    			Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
    			echo CJSON::encode(array('code'=>500, 'message'=> '注册失败'));
    		}
		}
	}
}