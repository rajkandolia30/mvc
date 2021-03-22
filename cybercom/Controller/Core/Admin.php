<?php
namespace Controller\Core;
class Admin{
    protected $request = null;
    protected $message = null;
    protected $url = null;

    public function setMessage(){
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }

    public function getMessage(){
        if(!$this->message){
            $this->setMessage();
        }
        return $this->message;
    }

    public function setRequest(){
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this;
    }
    public function getRequest(){
        if(!$this->request){
            $this->setRequest();
        }
        return $this->request;
    }
    
    public function getUrl($actionName = null, $controllerName = null, $params = [], $resetParams = false ){
        $request = \Mage::getModel('Model\Core\Request');
        $final = $request->getGet();  
        
        if($resetParams){
            $final = [];
        }
        if ($actionName == null){
            $actionName = $request->getGet('a');
        }
        if($controllerName == null){
            $controllerName = $request->getGet('c');
        }
        $final['c'] = $controllerName;
        $final['a'] = $actionName;
        $final = array_merge($final, $params);
        $queryString = http_build_query($final);
        unset($final);        
        return "http://localhost/cybercom/index.php?{$queryString}";
    }

    public function redirect($actionName = null, $controllerName = null, $params = [], $resetParams = false){  
        $url = $this->getUrl($actionName,$controllerName, $params ,$resetParams);
        header("location:{$url}");
        exit(0);
    }

   /* public function setUrl(){
        $this->url = \Mage::getModel('Model\Core\Url');
    }

    public function getUrl(){
        if(!$this->url){
            $this->setUrl();
        }
        return $this->url;
    }*/
}
?>