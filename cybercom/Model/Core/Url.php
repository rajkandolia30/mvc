<?php 
namespace Model\Core;
class Url{
    protected $request = null;

 	public function setRequest(){
        $this->request= \Mage::getBlock('Model\Core\Request');
        return $this;
    }

    public function getRequest(){
        if(!$this->request){
            $this->setRequest();
        }
        return $this->request;
    }
    
 	public function getUrl($actionName = null, $controllerName = null, $params = [], $resetParams = false ){
        $request = new \Model\Core\Request();
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

    public function baseUrl($subUrl = null){
        $url = "http://localhost/cybercom/";
        if($subUrl){
            $url .= $subUrl;
        }
        return $url;
    }
 } ?>