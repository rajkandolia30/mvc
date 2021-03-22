<?php 
namespace Block\Core;
class Template{
    protected $template = null;
    protected $children = null;
    protected $controller = null;
    protected $request = null;
    protected $url = null;
    protected $adminMessage = null;
    public function __construct(){

    }

    public function setAdminMessage(){
        $this->adminMessage = \Mage::getModel('Model\Admin\Message');
        return $this;
    }
    
    public function getAdminMessage(){
        if(!$this->adminMessage){
            $this->setAdminMessage();
        }
        return $this->adminMessage;
    }

    public function setUrl(){
        $this->url= \Mage::getModel('Model\Core\Url');
        return $this;
    }

    public function getUrl(){
        if(!$this->url){
            $this->setUrl();
        }
        return $this->url;
    }       

    public function setRequest(){
        $this->request=  \Mage::getModel('Model\Core\Request');
        return $this;
    }

    public function getRequest(){
        if(!$this->request){
            $this->setRequest();
        }
        return $this->request;
    }       

    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }

    public function getTemplate(){
        return $this->template;
    }

    public function setChildren(array $children = [] ){
        $this->children = $children;
        return $this;
    }

    public function getChildren(){
        return $this->children;
    }

    public function addChild(\Block\Core\Template $child, $key){
        if(!$key){
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }

    public function getChild($key){
        if(!array_key_exists($key, $this->children)){
            return null;
        }
        return $this->children[$key];
    }

    public function removeChild($key){
        if(array_key_exists($key, $this->children)){
            unset($this->children[$key]);
        }
        return $this;
    }

    public function toHtml(){
        ob_start();
        require_once $this->getTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function baseUrl($subUrl = null){
        return $this->getUrl()->baseUrl($subUrl);
    }
}
?>