<?php
// [CWebUser::checkAccess()] 连接yii的验证系统。这里用一个简单的角色系统替换[CAuthManager]定义的分级系统
// http://www.yiiframework.com/doc/guide/1.1/en/topics.auth#role-based-access-control
// Yii::app()->user->checkAccess('staff')
class WebUser extends CWebUser{
    public function checkAccess($operation, $params=array()){
        // Not identified => no rights
        if(empty($this->id)) return false;
        $role = $this->getState('userRole');
        // admin role has access to everything
        if($role == 1 || $role == 2) return true;
        // allow access if the operation request is the current user's role
        return is_array($role)? in_array($operation, $role) : $operation === $role;
    }
}