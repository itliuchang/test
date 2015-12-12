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
}