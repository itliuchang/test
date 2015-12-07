<?php
class WebUser extends CWebUser{
	public function getIsGuest(){
        return empty($this->getState('__id');
	}
}