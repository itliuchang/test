<?php
Yii::import('application.vendor.emchat.*');
require_once('Easemob.php');

class EasemobHelper extends Easemob{
    private static $_instance;

    protected function __construct($options){
        $emchat = Yii::app()->params['partner']['emchat'];
        $options['client_id'] = $options['client_id'] ?: $emchat['app']['client_id'];
        $options['client_secret'] = $options['client_secret'] ?: $emchat['app']['client_secret'];
        $options['org_name'] = $options['org_name'] ?: $emchat['org']['name'];
        $options['app_name'] = $options['app_name'] ?: $emchat['app']['name'];
        parent::__construct($options);
    }

    public static function getInstance($options = array()){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self($options);
        }
        return self::$_instance;
    }

    //初始化新用户聊天系统
    public static function initIM($uid, $data){
        //注册环信
        self::getInstance()->accreditRegister($data);
        //创建系统消息的帐号
        $mr = new MessageRelation;
        $mr->id1 = $uid;
        $mr->id2 = 0;
        $mr->utime = time();
        $mr->save();
    }

    //查询是否有新消息
    public static function hasNewMessage($uid){
        //是否有新的(离线)消息或一对一的系统通知
        $n = Message::model()->countBySql('select count(*) from message where RecID=:uid and type in(0,1) and status=0', array(':uid' => $uid));
        if($n > 0) return true;
        //是否有新的全局系统消息
        $n = Message::model()->countBySql('select count(*) from message m where senderID=0 and RecID=0 and type=2 and expireTime > :time and status=0 and not exists(select mid from messageLog where mid=m.id and uid=:uid)', array(':time' => time(), ':uid' => $uid));
        return $n > 0;
    }

    //设置某消息的已读状态
    public static function read($id){
        $m = Message::model()->findByPk($id);
        if($m){
            if($m->type == 0 || $m->type == 1){//私聊及系统通知
                $m->status = 1;
                $m->utime = time();
                $m->save();
            }elseif($m->type == 2){//全局系统消息
                // $log = new MessageLog;
                // $log->mid = $m->id;
                // $log->uid = Yii::app()->user->id;
                // $log->ctime = time();
                // $log->save();
                // 有则插入数据否则更新
                MessageLog::model()->dbConnection->createCommand('insert into messageLog values(' . $m->id . ',' . Yii::app()->user->id . ',' . time() . ') ON DUPLICATE KEY UPDATE ctime=' . time())->execute();
            }
            //更新与此发送者的最后聊天记录
            $lastMsg = mb_substr(Assist::removeXSS(Assist::removeEmoji($m->body)), 0, 50, 'utf-8');
            if($m->type == 0){//私聊
                $mr = MessageRelation::model()->findBySql('select * from messageLog where (id1=:senderId and id2=:recId) or (id1=:recId and id2=:senderId)', array(':senderId' => $m->senderID, ':recId' => $m->RecID));
                $senderID = $m->senderID;
                $RecID = $m->RecID;
            }else{//系统消息/通知
                $mr = MessageRelation::model()->findBySql('select * from messageLog where id1=:senderId and id2=0', array(':senderId' => Yii::app()->user->id));
                $senderID = Yii::app()->user->id;
                $RecID = 0;
            }
            if($mr){
                $mr->lastMsg = $lastMsg;
                $mr->utime = time();
                $mr->save();
            }else{
                $mrelation = new MessageRelation;
                $mrelation->id1 = $senderID;
                $mrelation->id2 = $RecID;
                $mrelation->lastMsg = $lastMsg;
                $mrelation->utime = time();
                $mrelation->save();
            }
        }
    }

    //设置当前登录用户与某人所有聊天记录为已读, $senderID=0表示设置与系统的所有聊天记录为已读(含一对一的通知与全局系统消息)
    public static function readAll($senderID){}

    //分页获取当前用户好友列表
    public static function getAll($page, $size){}

    //分磁获取当前用户与某好友的聊天消息列表
    public static function getAllMessage($fid, $page, $size){}

    //创建评论新回复通知
    public static function addCommentReplyNotify($recId, $body, $pid, $cid){
        $m = new Message;
        $m->senderID = Yii::app()->user->id;
        $m->RecID = $recId;
        $m->body = $body; //评论内容
        $m->typeID = $pid . '-' . $cid; //格式: 文章ID-评论ID
        $m->type = 1;
        $m->ctime = $m->utime = time();
        $m->save();
    }

    //创建全局系统消息
    public static function addSystemMessage(){}

    public static function addMessage(){}
}