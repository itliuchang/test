<?php
class CreateAction extends CAction{
    public function run(){
        

        $this->controller->pageTitle = '创建产品 - ' . $this->controller->pageTitle;
        $this->controller->render('editProduct');
    }
}