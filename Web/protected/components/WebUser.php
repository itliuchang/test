<?php
class WebUser extends CWebUser{

	public function getIsGuest(){
		if(empty($this->getState('__id'))){
            return true;
        }
	}
}