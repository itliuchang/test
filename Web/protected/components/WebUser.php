<?php
class WebUser extends CWebUser{
	public  $productType = '';
	public  $productName = '';
	public  $productNum = 0;
	public  $productPrice = null;
	public function getIsGuest(){
        $_id = $this->getState('__id');
        return empty($_id);
	}
}