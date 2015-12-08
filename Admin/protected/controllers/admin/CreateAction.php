<?php
class CreateAction extends CAction{
    public function run(){
        
        $this->controller->render('edit');
    }
}