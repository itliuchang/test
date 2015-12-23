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
    public static function hasNewMessage(){
        //是否有我的新(离线)消息或一对一的系统通知-只有接收者是当前登录用户的才需要置为已读
        $n = Message::model()->countBySql('select count(*) from message where RecID=:uid and type in(0,1) and status=0', array(':uid' => Yii::app()->user->id));
        if($n > 0) return true;
        //是否有新的全局系统消息
        $n = Message::model()->countBySql('select count(*) from message m where senderID=0 and RecID=0 and type=2 and expireTime > :time and status=0 and not exists(select mid from messageLog where mid=m.id and uid=:uid)', array(':time' => time(), ':uid' => Yii::app()->user->id));
        return $n > 0;
    }

    //获取当前登录用户与对方的新/离线消息数
    public static function getNewMessageNum($senderId){
        if($senderId == 0){//获取系统消息
            $n = Message::model()->countBySql('select count(*) from message where senderID=0 and RecID=:uid and type=1 and status=0', array(':uid' => Yii::app()->user->id));
            $n += Message::model()->countBySql('select count(*) from message m where senderID=0 and RecID=0 and type=2 and expireTime > :time and status=0 and not exists(select mid from messageLog where mid=m.id and uid=:uid)', array(':time' => time(), ':uid' => Yii::app()->user->id));
        }else{
            $n = Message::model()->countBySql('select count(*) from message where senderID=:senderId and RecID=:uid and type=0 and status=0', array(':senderId' => $senderId, ':uid' => Yii::app()->user->id));
        }
        return $n;
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
        }
    }

    //设置当前登录用户与某人所有聊天记录为已读, $senderID=0表示设置与系统的所有聊天记录为已读(含一对一的通知与全局系统消息)
    public static function readAll($senderID){
        if($senderID == 0){//使当前登录用户所有的系统消息与通知为已读
            //将一对一的系统通知置为已读
            Message::model()->updateAll(array('status' => 1, 'utime' => time()), 'senderID=0 and RecID=:RecId and type=1 and status=0', array(':RecId' => Yii::app()->user->id));
            //将全局系统消息置为已读
            $messages = Message::model()->findAll('senderID=0 and RecID=0 and type=2 and expireTime > :time and status=0 and not exists(select mid from messageLog where mid=m.id and uid=:uid)', array(':time' => time(), ':uid' => Yii::app()->user->id));
            $sql = '';
            foreach($messages as $message){
                $sql += 'insert into messageLog values(' . $message->id . ',' . Yii::app()->user->id . ',' . time() . ') ON DUPLICATE KEY UPDATE ctime=' . time() . ';';
            }
            if($sql) MessageLog::model()->dbConnection->createCommand($sql)->execute();
        }else{//使用当前用户与此人的私聊全部为已读，自己发送的消息不需要置为已读
            Message::model()->updateAll(array('status' => 1, 'utime' => time()), 'senderID=:senderId and RecID=:RecId and type=0 and status=0', array(':senderId' => $senderID, ':RecId' => Yii::app()->user->id));
        }
    }

    //分页获取当前用户好友列表,在消息列表中ajax添加dom时过滤已在dom存在的项，避免多终端显示消息列表时因有新聊天而导致取列表数据错位的问题
    public static function getAll($page = 1, $size = 15){
        $fields = ' mr.*, u1.nickName as u1name, u1.portrait as u1img, u2.nickName as u2name, u2.portrait as u2img';
        $where = ' from messageRelation mr left join user u1 on mr.id1=u1.id left join user u2 on mr.id2=u2.id where id1=:uid or id2=:uid order by utime desc';
        $count = MessageRelation::model()->countBySql('select count(*) ' . $where, array(':uid' => Yii::app()->user->id));
        $total = ceil($count / $size);
        $start = $page * $size - 1;
        $limit = " limit {$start},{$size}";

        $list = MessageRelation::model()->findAllBySql('select' . $fields . $where . $limit, array(':uid' => Yii::app()->user->id));
        foreach($list as $item){
            if($item['id2'] == 0){
                $item['ncount'] = self::getNewMessageNum(0);
            }else{
                $item['ncount'] = self::getNewMessageNum($item['id1'] != Yii::app()->user->id? $item['id1'] : $item['id2']);
            }
        }
        return $list;
    }

    //分页获取当前用户与某好友的聊天消息列表,使用start而非使用常规分页是为了避免当在聊天窗口有新的聊天记录时获取消息列表错位的问题
    public static function getAllMessage($fid, $start = 0, $size = 15){
        //这里倒序查数据库,在页面中中倒序输出这里的结果,这样上拉聊天记录时消息显示顺序就正确了: 按时间正序排序了
        if($fid == 0){//系统通知与消息
            $sysaccount = Yii::app()->params['partner']['emchat']['sysAccount'];
            $user = array('id' => 0, 'nickName' => $sysaccount['nickName'] ?: $sysaccount['name'], 'portrait' => $sysaccount['portrait']);
            $data = Message::model()->findAllBySql('select * from message where senderID=0 and (RecID=0 or RecID=:RecId) and type in(1,2) order by ctime desc limit :offset, :limit', array(':RecId' => Yii::app()->user->id, ':offset' => $start, ':limit' => $size));
        }else{//私聊
            $user = User::model()->findByPk($fid);
            $data = Message::model()->findAllBySql('select * from message where ((senderID=:senderId and RecID=:RecId) or (senderID=:RecId and RecID=:senderId)) and type=0 order by ctime desc limit :offset, :limit', array(':senderId' => Yii::app()->user->id, ':RecId' => $fid, ':offset' => $start, ':limit' => $size));
        }
        return array('user' => $user, 'data' => $data);
    }

    //更新最后的聊天记录
    public static function updateLastMsg($senderId, $recId, $msg){
        $lastMsg = mb_substr(Assist::removeXSS(Assist::removeEmoji($msg)), 0, 50, 'utf-8');
        if($senderId == 0){//系统消息/通知
            $mr = MessageRelation::model()->findBySql('select * from messageLog where id1=:senderId and id2=0', array(':senderId' => Yii::app()->user->id));
            $senderID = Yii::app()->user->id;
            $RecID = 0;
        }else{//私聊
            $mr = MessageRelation::model()->findBySql('select * from messageLog where (id1=:senderId and id2=:recId) or (id1=:recId and id2=:senderId)', array(':senderId' => $senderId, ':recId' => $recId));
            $senderID = $senderId;
            $RecID = $recId;
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

    //当前用户回复评论时的系统通知
    public static function addCommentReplyNotify($recId, $body, $pid, $cid){
        if($recId == Yii::app()->user->id) return;
        $m = new Message;
        $m->senderID = 0;
        $m->RecID = $recId;
        $m->body = $body; //评论内容
        $m->typeID = $pid . '-' . $cid; //格式: 文章ID-评论ID
        $m->type = 1;
        $m->ctime = $m->utime = time();
        $m->save();
        //更新最后记录
        self::updateLastMsg($m->senderID, $m->RecID, $m->body);
    }

    //创建全局系统消息
    public static function addSystemMessage($body, $expireTime = 0){
        $m = new Message;
        $m->senderID = $m->RecID = 0;
        $m->body = $body;
        $m->type = 2;
        $m->expireTime = $expireTime;
        $m->ctime = $m->utime = time();
        $m->save();
        self::updateLastMsg(0, 0, $m->body);
    }

    //创建与某人的私聊消息
    public static function addMessage($senderId, $recId, $body){
        $m = new Message;
        $m->senderID = $senderId;
        $m->RecID = $recId;
        $m->body = $body;
        $m->type = 0;
        $m->ctime = $m->utime = time();
        $m->save();
        self::updateLastMsg($m->senderID, $m->RecID, $m->body);
    }
}