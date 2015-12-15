<?php
class CreateAction extends CAction{
    public function run(){
        $dp = new Hubs;
        $hub = $dp->getHub();

        $this->controller->render('edit',array(
        	'hub'=>$hub
        ));
    }
}