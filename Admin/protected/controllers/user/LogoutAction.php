<?php
class LogoutAction extends CAction{
    private $_identity;

    public function run(){
        if(!Yii::app()->user->getIsGuest()){
            $this->_identity = new UserIdentity();
            $this->_identity->logout();
        }
        $this->controller->redirect('/login.html');
    }
}