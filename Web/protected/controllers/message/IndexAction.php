<?php
class IndexAction extends CAction{
	public function run($page = 1, $size = 15){
	    $this->controller->bodyCss='messagelist';
        //检查user->isBindIM如未绑定环信则注册环信并绑定
        if(!Yii::app()->user->isBindIM){
            EasemobHelper::initIM(Yii::app()->user->id, array(
                'username' => Yii::app()->user->id, 'password' => 'nakedim',
                'nickname' => Yii::app()->user->nickName
            ));
            Yii::app()->user->isBindIM = 1;
            User::model()->updateByPk(Yii::app()->user->id, array('isBindIM' => 1));
        }

        $data = EasemobHelper::getAll($page, $size);
        if(Yii::app()->request->isAjaxRequest){
            echo CJSON::encode(array('code' => 200, 'data' => $data));
        }else{
            $this->controller->render('index', array('data' => $data));
        }
	}
}