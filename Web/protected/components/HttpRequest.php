<?php
class HttpRequest extends CHttpRequest{
    private $_csrfToken;
    public $noCsrfValidationRoutes = array();

    //YII2: Yii::app()->request->enableCsrfValidation = false;
    protected function normalizeRequest(){
        parent::normalizeRequest();
        if($this->enableCsrfValidation){
            $url = Yii::app()->getUrlManager()->parseUrl($this);
            foreach($this->noCsrfValidationRoutes as $route){
                if(strpos($url,$route) === 0){
                    Yii::app()->detachEventHandler('onBeginRequest',array($this,'validateCsrfToken'));
                }
            }
        }
    }

    public function getCsrfToken(){
        if($this->_csrfToken === null){
            $session = Yii::app()->session;
            $csrfToken = $session->itemAt($this->csrfTokenName);
            if(!$csrfToken){
                $csrfToken = sha1(uniqid(mt_rand(),true));
                $session->add($this->csrfTokenName, $csrfToken);
            }
            $this->_csrfToken = $csrfToken;
        }
        return $this->_csrfToken;
    }

    public function validateCsrfToken($event){
        if($this->getIsPostRequest() ||
           $this->getIsPutRequest()  ||
           $this->getIsPatchRequest() ||
           $this->getIsDeleteRequest()
        ){
            $method=$this->getRequestType();
            $userToken = '';
            switch($method){
                case 'POST':
                    $userToken = $this->getPost($this->csrfTokenName);
                    break;
                case 'PUT':
                    $userToken = $this->getPut($this->csrfTokenName);
                    break;
                case 'PATCH':
                    $userToken = $this->getPatch($this->csrfTokenName);
                    break;
                case 'DELETE':
                    $userToken = $this->getDelete($this->csrfTokenName);
            }

            // only validate POST requests
            $session = Yii::app()->session;
            // if($session->contains($this->csrfTokenName) && isset($_POST[$this->csrfTokenName])){
            if(!empty($userToken) && $session->contains($this->csrfTokenName)){
                $tokenFromSession = $session->itemAt($this->csrfTokenName);
                $valid = $tokenFromSession === $userToken;
            }else
                $valid=false;
            if(!$valid)
                throw new CHttpException(400,Yii::t('yii','The CSRF token could not be verified.'));
        }
    }
}